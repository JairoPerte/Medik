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
        Schema::create('consulta_doctor', function (Blueprint $table) {
            $table->string("horario", 40);
            $table->integer("pago", false, true);
            $table->boolean("trabaja");
            $table->string("especialidad", 150);
            $table->foreignId("doctor_id")->constrained("doctor")->onDelete("cascade");
            $table->foreignId("consulta_id")->constrained("consulta")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consulta_doctor');
    }
};
