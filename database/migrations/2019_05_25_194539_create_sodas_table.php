<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSodasTable extends Migration
{
    /**
     * a. Marca (String), limitado a 30 caracteres
     * b. Litragem (250ml, 600ml, 1l, 1.5l, 2l, 3l) (Select)
     * c. Tipo (Pet, garrafa ou lata) (Select)
     * d. Quantidade (Int) somente números, 0 ou maior.
     * e. Valor da unidade (boleano)
     * 
     * 'brand', 'liters', 'type', 'quantity', 'pricePerUnit'
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sodas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand', 30);
            $table->string('liters', 5);
            $table->string('type', 10);
            $table->integer('quantity');
            $table->float('pricePerUnit');
            $table->timestamps();
            
            $table->unique(['brand', 'liters']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sodas');
    }
}
