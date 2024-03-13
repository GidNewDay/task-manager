@extends('layout')

@section('main-content')
    <div>
        <div class="float-start">
            <h4 class="pb-3">Редактировать задачу <span class="badge bg-info">{{ $task->title }}</span></h4>
        </div>
        <div class="float-end">
            <a href="{{ route('index') }}" class="btn btn-info">
                <i class="fa fa-arrow-left"></i> Все задачи
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="card card-body bg-light p-4">
        <form action="{{ route('task.update', $task->id) }}" method="POST">
            @csrf
            @method("PUT")

            <div class="mb-3">
                <label for="title" class="form-label"> Название</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea type="text" class="form-control" id="description" name="description" row="5">{{ $task->description }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">Статус</label>
                <select name="status" id="status" class="form-control">
                    @foreach ($statuses as $status)
                        <option value="{{ $status['value'] }}" {{ $task->status ===  $status['value'] ? 'selected' : ''}}>{{ $status['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('index') }}" class="btn btn-info">
                <i class="fa fa-arrow-left"></i> Отмена
            </a>
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Сохранить</button>
        </form>
    </div>
@endsection
