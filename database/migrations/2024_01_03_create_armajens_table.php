<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('armajens', function (Blueprint $table) {
            $table->id('id_armajen');
            $table->string('naran_armajen', 100);
            $table->string('lokalisasaun', 100)->nullable();
            $table->decimal('kapasidade_max', 10, 2);
            $table->decimal('kapasidade_atual', 10, 2)->default(0);
            $table->enum('status', ['ativu', 'inativu'])->default('ativu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('armajens');
    }
};
