@extends('layouts.app')

@section('content')

  <!-- Bootstrap шаблон... -->
	<div class="container">
		@if (count($tasks) > 0)
		@foreach ($tasks as $task)
		<div class="row">
			<div class="col-md-6">
				<!-- Отображение ошибок проверки ввода -->
				@include('common.errors')
				<!-- Форма новой задачи -->
				<form action="/task/{{ $task->id }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<!-- Имя задачи -->
					<div class="form-group">
						<label for="task" class="col-sm-3 control-label">Имя</label>

						<div class="col-sm-9">
							<input type="text" name="name" id="name" class="form-control" value="{{ old('name') or $task->name }}">
						</div>
					</div>
					<!-- Телефон -->
					<div class="form-group">
						<label for="task" class="col-sm-3 control-label">Телефон</label>

						<div class="col-sm-9">
							<input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') or $task->phone }}">
							<input type="hidden" name="id" id="id" class="form-control" value="{{ $task->id or ''}}">
						</div>
					</div>
					<!-- Кнопка добавления задачи -->
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<button type="submit" class="btn btn-default">Обновить</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		@endforeach
		@endif
@endsection
