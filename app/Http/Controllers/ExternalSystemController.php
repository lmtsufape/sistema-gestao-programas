<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExternalSystem;
use Illuminate\Support\Facades\DB;

class ExternalSystemController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:manage external systems']);
    }

    public function index()
    {
        $tokens = ExternalSystem::pluck('api_token_last4', 'name')->toArray();
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

                ExternalSystem::updateOrCreate(
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
        $system = ExternalSystem::where('name', $name)->firstOrFail();
        $system->update([
            'api_token'       => null,
            'api_token_last4' => null,
            'rotated_at'      => now(),
        ]);

        return redirect()
            ->route('integrations.index')
            ->with('status', "Token do sistema {$name} removido com sucesso!");
    }
}
