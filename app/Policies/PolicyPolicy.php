<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Policies;

use App\Models\Policy;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PolicyPolicy
{

    protected $permissions = 'admin.policys';
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(sprintf("%s.index", $this->permissions));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Policy $policy): bool
    {
        return $user->can(sprintf("%s.view", $this->permissions));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
       return $user->can(sprintf("%s.create", $this->permissions));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Policy $policy): bool
    {        
        if ($user->can(sprintf("%s.edit", $this->permissions))) {
            return true;
        }
       return $user->can(sprintf("%s.update", $this->permissions));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Policy $policy): bool
    {
        return $user->can(sprintf("%s.delete", $this->permissions));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Policy $policy): bool
    {
        return $user->can(sprintf("%s.restore", $this->permissions));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Policy $policy): bool
    {
        return $user->can(sprintf("%s.forceDelete", $this->permissions));
    }
}
