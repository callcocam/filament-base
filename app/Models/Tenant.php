<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Tenant extends AbstractModel
{
    use HasFactory, HasUlids;

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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
