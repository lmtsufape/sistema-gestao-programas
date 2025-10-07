<?php

namespace App\Policies;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlunoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Aluno $aluno)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    public function edit(User $user, Aluno $aluno): bool
    {
        if ($aluno->user_id === $user->id) {
            return true;
        }

        if ($user->hasAnyRole(['coordenador_programas', 'tecnico_programas', 'coordenador_estagios', 'tecnico_estagios', 'administrador'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Aluno $aluno)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Aluno $aluno)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Aluno $aluno)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Aluno $aluno)
    {
        //
    }
}
