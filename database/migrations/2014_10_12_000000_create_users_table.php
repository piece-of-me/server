<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->comment('Пользователи');

            $table->id();
            $table->string('login', User::LOGIN_MAX_LENGTH)->unique()->comment('Логин');
            $table->string('password', User::PASSWORD_MAX_LENGTH)->comment('Пароль');
            $table->string('firstname', User::FIO_MAX_LENGTH)->comment('Имя');
            $table->string('lastname', User::FIO_MAX_LENGTH)->comment('Фамилия');
            $table->timestamp('birthdate')->nullable()->comment('Дата рождения');
            $table->timestamp('register_at')->comment('Дата регистрации')->useCurrent();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
