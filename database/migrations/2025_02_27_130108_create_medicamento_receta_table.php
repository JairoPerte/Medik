<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medicamento_receta', function (Blueprint $table) {
            $table->unsignedSmallInteger("cantidad");
            $table->string("horario", 100);
            $table->foreignId("medicamento_id")->constrained("medicamento")->onDelete("cascade");
            $table->foreignId("receta_id")->constrained("receta")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamento_receta');
    }
};
