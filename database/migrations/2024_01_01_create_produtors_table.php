<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produtors', function (Blueprint $table) {
            $table->id('id_produtor');
            $table->string('naran_produtor', 100);
            $table->string('telefone', 15)->nullable();
            $table->string('suku', 50)->nullable();
            $table->timestamp('data_rejistu')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtors');
    }
};
