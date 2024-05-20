<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Models\Acl;

use App\Core\Acl\Concerns\HasPermissions;
use App\Core\Acl\Contracts\IRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AbstractModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends AbstractModel implements IRole
{
    use HasFactory, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];
    // protected $appends = ['active'];

    //  public function getActiveAttribute()
    //  {
    //     return $this->status == 'published';
    //  } 

    /**
     * Roles can belong to many users.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Determine if role has permission flags.
     *
     * @return bool
     */
    public function hasPermissionFlags(): bool
    {
        return !is_null($this->special);
    }

    /**
     * Determine if the requested permission is permitted or denied
     * through a special role flag.
     *
     * @return bool
     */
    public function hasPermissionThroughFlag(): bool
    {
        if ($this->hasPermissionFlags()) { 
            return !($this->special === 'block-access');
        }

        return true;
    }
}
