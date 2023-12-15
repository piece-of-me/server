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
        Schema::create('users_event', function (Blueprint $table) {
            $table->comment('Участники события');

            $table->id();

            $table->unsignedBigInteger('user_id')->comment('Пользователь, id');
            $table->index('user_id', 'users_event_user_idx');
            $table->foreign('user_id', 'users_event_user_fk')->on('users')->references('id')->cascadeOnDelete();

            $table->unsignedBigInteger('event_id')->comment('Событие, id');
            $table->index('event_id', 'users_event_event_idx');
            $table->foreign('event_id', 'users_event_event_fk')->on('events')->references('id')->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_event');
    }
};
