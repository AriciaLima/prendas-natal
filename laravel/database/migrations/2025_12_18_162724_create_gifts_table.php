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
    Schema::create('gifts', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('expected_value', 8, 2);
        $table->decimal('spent_value', 8, 2)->nullable();
        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('gifts');
}
};
