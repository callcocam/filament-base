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
        Schema::create('tenants', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('user_id')->nullable();
            $table->ulid('tenant_id')->nullable();
            $table->string('name')->unique()->nullable()->comment('Nome do tenant');
            $table->string('slug')->unique()->nullable()->comment('Slug do tenant');
            $table->string('email')->unique()->nullable()->comment('Email do tenant');
            $table->string('document')->unique()->nullable()->comment('Documento do tenant');
            $table->string('phone')->nullable()->comment('Telefone do tenant');
            $table->string('domain')->unique()->nullable()->comment('Domínio do tenant');
            $table->string('prefix')->unique()->nullable()->comment('Prefixo do tenant');
            $table->string('logo')->nullable()->comment('Logo do tenant');
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
        Schema::dropIfExists('tenants');
    }
};