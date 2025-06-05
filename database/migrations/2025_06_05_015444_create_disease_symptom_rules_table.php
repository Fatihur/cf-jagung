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
        Schema::create('disease_symptom_rules', function (Blueprint $table) {
            $table->id();
            $table->string('code', 15)->unique(); // Kode rule (contoh: R001, R002)
            $table->foreignId('disease_id')->constrained()->onDelete('cascade');
            $table->foreignId('symptom_id')->constrained()->onDelete('cascade');
            $table->decimal('cf_value', 3, 2); // Certainty Factor value between -1.00 and 1.00
            $table->timestamps();

            // Ensure unique combination of disease and symptom
            $table->unique(['disease_id', 'symptom_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disease_symptom_rules');
    }
};
