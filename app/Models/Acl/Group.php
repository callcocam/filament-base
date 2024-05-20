<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Models\AbstractModel;

class Group extends AbstractModel
{
    use HasFactory;
    
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
}