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
        Schema::create('cita_medica', function (Blueprint $table) {
            $table->id();
            $table->date("dia");
            $table->unsignedTinyInteger("orden");
            $table->time("hora");
            $table->time("hora_ini")->nullable();
            $table->time("hora_fin")->nullable();
            $table->foreignId("doctor_id")->constrained("doctor")->onDelete("cascade");
            $table->foreignId("consulta_id")->constrained("consulta")->onDelete("cascade");
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_medica');
    }
};
