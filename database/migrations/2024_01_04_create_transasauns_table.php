<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transasauns', function (Blueprint $table) {
            $table->id('id_transasaun');
            $table->foreignId('id_produtor')->nullable()->constrained('produtors', 'id_produtor');
            $table->foreignId('id_tipu')->constrained('kafe_tipus', 'id_tipu');
            $table->foreignId('id_armajen')->constrained('armajens', 'id_armajen');
            $table->date('data_transasaun');
            $table->enum('tipo', ['produsaun', 'venda', 'transferensia']);
            $table->decimal('kilo', 8, 2);
            $table->decimal('folin_unitariu', 8, 2);
            $table->decimal('total_valor', 10, 2)->virtualAs('kilo * folin_unitariu');
            $table->enum('status', ['pending', 'complete', 'cancel'])->default('pending');
            $table->timestamp('data_registu')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transasauns');
    }
};
