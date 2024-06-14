<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('user_id')->nullable();
            $table->ulid('tenant_id')->nullable();
            $table->string('name')->comment('Nome da página');
            $table->string('slug')->unique()->comment('Slug da página');
            $table->string('route')->nullable()->comment('Rota da página');
            $table->string('icon')->nullable()->comment('Icone da página');
            $table->string('layout')->nullable()->comment('Layout da página');
            $table->string('template')->nullable()->comment('Template da página'); 
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->text('description')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
};