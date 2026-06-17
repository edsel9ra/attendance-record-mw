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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();

            $table->string('full_name');
            $table->string('id_number');

            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete();

            $table->foreignId('headquarter_id')->nullable()->constrained('headquarters')->nullOnDelete();

            $table->longText('signature');
            $table->dateTime('registered_at');
            $table->timestamps();

            $table->unique(['event_id', 'id_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
