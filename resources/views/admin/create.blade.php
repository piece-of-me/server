@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Добавить событие</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Общие сведения</h3>
                    </div>
                    <div class="card-body">
                        <form id="create-form">
                            <div class="form-group">
                                <label for="header">Название события</label>
                                <input type="text" id="header" class="form-control" name="header" required>
                            </div>
                            <div class="form-group">
                                <label for="text">Описание события</label>
                                <textarea id="text" class="form-control" rows="4" name="text" required></textarea>
                            </div>
                            <div>
                                <a href="{{ route('admin.index') }}" class="btn btn-secondary">Вернуться назад</a>
                                <input type="submit" value="Добавить событие" class="btn btn-success float-right">
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    @include('includes.modal')
    @vite(['resources/js/app.js', 'resources/js/admin.create.js'])
@endsection
