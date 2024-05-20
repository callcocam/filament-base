<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Core\Acl\Concerns;

use App\Models\Acl\Permission;

trait HasRolesAndPermissions
{

    use HasRoles, HasPermissions;
    /**
     * Run through the roles assigned to the permission and
     * checks if the user has any of them assigned.
     *
     * @param Permission $permission
     * @return boolean
     */
    protected function hasPermissionThroughRole($permission): bool
    {
        if ($this->hasRoles()) {
            foreach ($permission->roles as $role) {
                if ($this->roles->contains($role)) {
                    return true;
                }
            }
        } 
        return false;
    }

    protected function hasPermissionThroughRoleFlag(): bool
    {
        if ($this->hasRoles()) {
            return !($this->roles
                ->filter(function ($role) {
                    return !is_null($role->special);
                })
                ->pluck('special')
                ->contains('block-access'));
        }

        return true;
    }
}
