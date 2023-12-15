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
        Schema::create('events', function (Blueprint $table) {
            $table->comment('События');

            $table->id();
            $table->string('header')->comment('Заголовок');
            $table->text('text')->comment('Текст');

            $table->unsignedBigInteger('creator_id')->comment('Создатель события, Пользователь');
            $table->index('creator_id', 'event_user_idx');
            $table->foreign('creator_id', 'event_user_fk')->on('users')->references('id')->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
