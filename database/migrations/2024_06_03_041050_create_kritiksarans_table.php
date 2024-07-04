<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kritiksarans', function (Blueprint $table) {
            $table->id();
            $table->string('kritiksaran');
            $table->timestamps();
            $table->string('k_nim', 9)->nullable();;

            $table->foreign('k_nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kritiksarans');
    }
    
};
