<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class ActivityPolicy
{
    protected $permissions = 'admin.acl.groups.activities';

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Activity $model): bool
    {
        return $user->can($this->permissions);
    }


}
