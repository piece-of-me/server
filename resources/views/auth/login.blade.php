@extends('layouts.auth')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Авторизация</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="auth-form">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="login">Логин</label>
                            <input type="text" class="form-control" id="login" name="login"
                                   placeholder="Введите логин" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Введите пароль" required>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Войти</button>
                            <a class="btn btn-primary" href="{{ route('register.index') }}">
                                Зарегистрироваться
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
    @vite('resources/js/login.js')
@endsection
