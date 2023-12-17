@extends('layouts.auth')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Регистрация</h3>
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
                        <div class="form-group">
                            <label for="firstname">Имя</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                   placeholder="Введите имя" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Фамилия</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                   placeholder="Введите фамилию" required>
                        </div>
                        <div class="form-group">
                            <label>Дата рождения</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                       data-target="#reservationdate" name="date" id="birthdate">
                                <div class="input-group-append" data-target="#reservationdate"
                                     data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                            <a class="btn btn-primary" href="{{ route('login') }}">
                                Авторизоваться
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
    @vite('resources/js/register.js')
@endsection
