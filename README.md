# Gerenciamento de programas (com bolsas ou voluntários) ofertados na UFAPE
Para que os relatórios finais sejam salvos na pasta correta (pública), deve-se alterar no env a propriedade FILESYSTEM_DRIVER para 'public', ficando assim: FILESYSTEM_DRIVER=public
Caso não esteja configurado dessa forma, o sistema retornará erro 404 (arquivo não encontrado) ao tentar baixar um relatório.