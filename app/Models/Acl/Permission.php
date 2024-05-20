<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models\Acl;

use App\Core\Acl\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyAlias;

class Permission extends AbstractModel
{
    use HasFactory, HasRoles;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ]; 
   
    protected function slugTo()
    {
        return false;
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}