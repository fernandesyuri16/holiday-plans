<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("holiday_plans", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->date("date");
            $table->string("location");
            $table->text("participants");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("holiday_plans");
    }
};
