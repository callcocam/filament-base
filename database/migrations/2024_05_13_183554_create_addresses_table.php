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
        Schema::create('addresses', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('user_id')->nullable();
            $table->ulid('tenant_id')->nullable();
            $table->string('name')->nullable()->comment('Nome do endereço');
            $table->string('slug')->nullable()->comment('Slug do endereço');
            $table->string('zip')->nullable()->comment('CEP');
            $table->string('city')->nullable()->comment('Cidade');
            $table->string('state')->nullable()->comment('Estado');
            $table->string('country')->nullable()->comment('País');
            $table->string('street')->nullable()->comment('Rua');
            $table->string('district')->nullable()->comment('Bairro');
            $table->string('number')->nullable()->comment('Número');
            $table->string('complement')->nullable()->comment('Complemento');
            $table->string('reference')->nullable()->comment('Referência');
            $table->string('latitude')->nullable()->comment('Latitude');
            $table->string('longitude')->nullable()->comment('Longitude');
            $table->nullableUlidMorphs('addressable');
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
        Schema::dropIfExists('addresses');
    }
};
