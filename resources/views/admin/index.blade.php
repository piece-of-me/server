@extends('layouts.admin')
@section('content')
    <div id="event-container" style="display: none;">
        <div class="row">
            <div class="col-12 col-sm-6 pt-3">
                <div id="alert-info" class="alert alert-danger" role="alert">
                    Произошла ошибка во время загрузки информации. Пожалуйста, обновите страницу.
                </div>

                <h3 class="my-3" id="event-header">Название события</h3>
                <p id="event-text">Описание события</p>

                <hr>
                <h4>Дата события</h4>
                <p id="event-date">data</p>

                <hr>
                <h3>Участники</h3>
                <div id="participants">
                    <h5>Участник 1</h5>
                    <h5>Участник 2</h5>
                </div>

                <hr>
                <button id="join-button" type="button" class="btn btn-block btn-primary btn-lg">Принять участие</button>
                <button id="refuse-button" type="button" class="btn btn-block btn-warning btn-lg">
                    Отказаться от участия
                </button>
                <button id="delete-button" type="button" class="btn btn-block btn-danger btn-lg">
                    Удалить событие
                </button>
            </div>
        </div>
    </div>
    @include('includes.modal')
    @vite(['resources/js/app.js', 'resources/js/admin.js'])
@endsection
