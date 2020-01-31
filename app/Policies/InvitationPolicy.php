<?php

namespace App\Policies;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any invitations.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the invitation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return mixed
     */
    public function view(User $user, Invitation $invitation)
    {
        //
    }

    /**
     * Determine whether the user can create invitations.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the invitation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return mixed
     */
    public function update(User $user, Invitation $invitation)
    {
        //
    }

    /**
     * Determine whether the user can delete the invitation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return mixed
     */
    public function delete(User $user, Invitation $invitation)
    {
        return $user->id == $invitation->sender_id;
    }

    public function resend(User $user, Invitation $invitation)
    {
        return $user->id == $invitation->sender_id;
    }


    public function respond(User $user, Invitation $invitation)
    {
        return $user->email == $invitation->recipient_email;
    }

    

    /**
     * Determine whether the user can restore the invitation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return mixed
     */
    public function restore(User $user, Invitation $invitation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the invitation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return mixed
     */
    public function forceDelete(User $user, Invitation $invitation)
    {
        //
    }
}
