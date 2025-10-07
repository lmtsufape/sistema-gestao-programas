document.addEventListener("DOMContentLoaded", function () {
    console.log("Inicializando sistema de notificações...");

    // Verificar se as dependências foram carregadas
    if (typeof Pusher === "undefined") {
        console.error("Pusher não foi carregado via CDN");
        return;
    }

    if (typeof Echo === "undefined") {
        console.error("Laravel Echo não foi carregado via CDN");
        return;
    }

    // Configurar Echo com Pusher
    try {
        window.Echo = new Echo({
            broadcaster: "pusher",
            key: window.pusherKey, // Isso será substituído pelo Blade
            cluster: window.pusherCluster,
            forceTLS: true,
            encrypted: true,
            authEndpoint: "/broadcasting/auth",
            auth: {
                headers: {
                    "X-CSRF-TOKEN":
                        document.querySelector('meta[name="csrf-token"]')
                            ?.content || "",
                },
            },
        });

        console.log("Echo inicializado com sucesso");
    } catch (error) {
        console.error("Erro ao inicializar Echo:", error);
        return;
    }

    // Ativar logs apenas em desenvolvimento
    try {
        if (
            window.location.hostname === "localhost" ||
            window.location.hostname === "127.0.0.1"
        ) {
            window.Echo.connector.pusher.logToConsole = true;
            console.log("Logs do Pusher ativados (modo desenvolvimento)");
        }
    } catch (e) {
        console.warn("Não foi possível ativar logs do Pusher:", e.message);
    }

    // Obter ID do usuário e CSRF token
    const userId = document.querySelector('meta[name="user-id"]')?.content;

    if (!userId || userId === "") {
        console.warn(
            "ID do usuário não encontrado ou usuário não autenticado."
        );
    } else {
        console.log("Configurando canal privado para usuário:", userId);

        // Canal privado do usuário
        window.Echo.private(`App.Models.User.${userId}`)
            .notification((notification) => {
                console.log("📬 Notificação privada recebida:", notification);

                // Disparar evento Livewire se disponível
                if (typeof Livewire !== "undefined") {
                    Livewire.emit("atualizarNotificacoes");
                }

                // Opcional: Mostrar notificação na UI
                mostrarNotificacao(notification);
            })
            .subscribed(() => {
                console.log("✅ Conectado ao canal privado do usuário");
            })
            .error((error) => {
                console.error("❌ Erro no canal privado:", error);
            });
    }

    // Canal privado de programas
    console.log("Configurando canal privado de programas...");

    window.Echo.private("programas-channel")
        .listen(".RelatorioEnviado", (event) => {
            console.log("📊 Notificação de programa recebida:", event);

            if (typeof Livewire !== "undefined") {
                Livewire.emit("atualizarNotificacoes");
            }

            // Opcional: Mostrar notificação na UI
            mostrarNotificacaoPrograma(event);
        })
        .subscribed(() => {
            console.log("✅ Conectado ao canal de programas");
        })
        .error((error) => {
            console.error("❌ Erro no canal de programas:", error);
        });

    // Monitorar erros de conexão
    window.Echo.connector.pusher.connection.bind("error", (error) => {
        console.error("🔌 Erro de conexão Pusher:", error);
    });

    window.Echo.connector.pusher.connection.bind("connected", () => {
        console.log("🔗 Conectado ao Pusher");
    });

    window.Echo.connector.pusher.connection.bind("disconnected", () => {
        console.warn("🔌 Desconectado do Pusher");
    });

    // Função auxiliar para mostrar notificações na UI
    function mostrarNotificacao(notification) {
        // Verificar se o navegador suporta notificações
        if (!("Notification" in window)) {
            console.log("Este navegador não suporta notificações desktop");
            return;
        }

        // Verificar permissão para notificações
        if (Notification.permission === "granted") {
            criarNotificacao(notification);
        } else if (Notification.permission !== "denied") {
            Notification.requestPermission().then((permission) => {
                if (permission === "granted") {
                    criarNotificacao(notification);
                }
            });
        }
    }

    function criarNotificacao(notification) {
        const titulo = notification.titulo || "Nova Notificação";
        const mensagem =
            notification.mensagem || "Você tem uma nova notificação";

        new Notification(titulo, {
            body: mensagem,
            icon: "/icon.png", // Altere para o caminho do seu ícone
        });
    }

    function mostrarNotificacaoPrograma(event) {
        // Personalize conforme a estrutura do seu evento
        const titulo = "Novo Relatório";
        const mensagem = event.mensagem || "Um novo relatório foi enviado";

        // Usar Toast ou alerta customizado se preferir
        if (typeof Toast !== "undefined") {
            Toast.success(mensagem);
        } else {
            console.log(`🔔 ${titulo}: ${mensagem}`);
        }
    }
});
