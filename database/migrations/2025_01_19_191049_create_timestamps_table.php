<?php

use App\Enums\TimestampTypeEnum;
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
        Schema::create('timestamps', function (Blueprint $table) {
            $table->id();
            $table->enum('type', allowed: array_column(TimestampTypeEnum::cases(), 'value'));
            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timestamps');
    }
};
