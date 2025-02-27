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
        Schema::create('admin_centro', function (Blueprint $table) {
            $table->string("horario", 40);
            $table->integer("sueldo", false, true);
            $table->boolean("trabaja");
            $table->foreignId("admin_id")->constrained("administrador")->onDelete("cascade");
            $table->foreignId("centro_id")->constrained("centro_medico")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_centro');
    }
};
