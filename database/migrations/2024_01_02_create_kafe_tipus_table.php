<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kafe_tipus', function (Blueprint $table) {
            $table->id('id_tipu');
            $table->string('naran_tipu', 50)->unique();
            $table->text('deskrisaun')->nullable();
            $table->decimal('folin_base', 10, 2);
            $table->enum('kategoria', ['Premium', 'Standard', 'Economy'])->default('Standard');
            $table->enum('status', ['ativu', 'inativu'])->default('ativu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kafe_tipus');
    }
};
