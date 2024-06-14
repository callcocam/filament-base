<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       
        //$userID = User::where('email', 'admin@sistema.com')->first();
        $tenantId = Tenant::first()->id;
        return [
            'tenant_id' => $tenantId,
           //'user_id' => $userID ? $userID->id : null, 
            'user_id' => User::all()->random()->id,
            //            
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}