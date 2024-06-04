<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Core\Landlord\BelongsToTenants;
use App\Models\AbstractModel;

class Policy extends AbstractModel
{
    use HasFactory, BelongsToTenants;
    
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