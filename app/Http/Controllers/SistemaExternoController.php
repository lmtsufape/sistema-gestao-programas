<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SistemaExterno;
use Illuminate\Support\Facades\DB;

class SistemaExternoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:manage external systems']);
    }

    public function index()
    {
        $tokens = SistemaExterno::select('name', 'api_token_last4', 'rotated_at', 'last_used_at')
            ->get()
            ->mapWithKeys(function ($system) {
                return [
                    $system->name => [
                        'last_chars' => $system->api_token_last4,
                        'rotated_at' => $system->rotated_at,
                        'last_used_at' => $system->last_used_at,
                    ]
                ];
            })->toArray();
            
        $systems = ['Certifica'];

        return view('integrations.tokens', compact('tokens', 'systems'));
    }

    public function upsert(Request $request)
    {
        $data = $request->validate([
            'systems'   => 'required|array',
            'systems.*' => 'nullable|string|max:4096', // token pode ser vazio (não altera)
        ]);

        DB::transaction(function () use ($data) {
            foreach ($data['systems'] as $name => $token) {
                // ignora se veio vazio -> não altera token
                if (empty($token)) {
                    continue;
                }

                SistemaExterno::updateOrCreate(
                    ['name' => $name],
                    [
                        'api_token'       => $token, // criptografado pelo cast no model
                        'api_token_last4' => substr($token, -4),
                        'rotated_at'      => now(),
                    ]
                );
            }
        });

        return redirect()
            ->route('integrations.index')
            ->with('status', 'Tokens atualizados com sucesso!');
    }

    public function destroy(string $name)
    {
        $system = SistemaExterno::where('name', $name)->firstOrFail();
        $system->update([
            'api_token'       => null,
            'api_token_last4' => null,
            'rotated_at'      => now(),
            'last_used_at'    => null,
        ]);

        return redirect()
            ->route('integrations.index')
            ->with('status', "Token do sistema {$name} removido com sucesso!");
    }
}
