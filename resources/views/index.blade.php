@extends('layout')

@section('main-content')
    <div class="pb-3">
        <div class="float-start">
            <h4>Список задач</h4>
        </div>
        <div class="float-end">
            <a href="{{ route('task.create') }}" class="btn btn-info">
                <i class="fa fa-plus-circle"></i> Создать задачу
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="card card-body bg-light p-4 mb-3 col-lg-6 col-sm-12">
        <h4>Фильтр</h4>
        <form action="{{ route('index') }}" method="get">
            <div class="mb-3 row">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="description" class="col-form-label ">Статус</label>
                    <select name="status" id="status" class="form-control ">
                        <option value=""></option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status['value'] }}"
                                @if ($_GET && $_GET['status'] && $_GET['status'] === $status['value']) @selected(true) @endif>{{ $status['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="date" class="col-form-label"> Дата создания</label>
                    <input type="date" class="form-control " id="date" name="date"
                        value="{{ $date = $_GET && $_GET['date'] ? $_GET['date'] : '' }}">
                </div>
            </div>
            <button type="submit" class="btn btn-success col-auto"><i class="fa fa-filter"></i> Фильтр</button>
        </form>
    </div>

    @foreach ($tasks as $task)
        <div class="card mt-3">
            <div class="card-header">
                @if ($task->status === 'Todo')
                    {{ $task->title }}
                @else
                    <del>{{ $task->title }}</del>
                @endif

                <span class="badge rounded-pill bg-warning text-dark">
                    {{ $task->created_at->toDateString() }}
                </span>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <div class="float-start">
                        @if ($task->status === 'Todo')
                            {{ $task->description }}
                        @else
                            <del>{{ $task->description }}</del>
                        @endif
                        <br>
                        <span
                            class="badge rounded-pill {{ $task->status === 'Todo' ? 'bg-info text-dark' : 'bg-success text-light' }} ">
                            {{ $task->status }}
                        </span>
                        <small>Обновлен - {{ $task->updated_at->toDateString() }}</small>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-info">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('task.destroy', $task->id) }}" style="display: inline" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    @endforeach

    @if (count($tasks) === 0)
        <div class="alert alert-danger p-2">
            Задач нет. Создайте задачу
            <br><br>
            <a href="{{ route('task.create') }}" class="btn btn-info btn-sm">
                <i class="fa fa-plus-circle"></i> Создать задачу
            </a>
        </div>
    @else
        <div class="float-end my-3">
            <a href="{{ route('task.create') }}" class="btn btn-info">
                <i class="fa fa-plus-circle"></i> Создать задачу
            </a>
        </div>
    @endif
@endsection
