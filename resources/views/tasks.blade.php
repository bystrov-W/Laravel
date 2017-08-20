@extends('layouts.app')

@section('content')

  <!-- Bootstrap шаблон... -->
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<!-- Отображение ошибок проверки ввода -->
				@include('common.errors')
				<!-- Форма новой задачи -->
				<form action="{{ route('task.store') }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					<!-- Имя задачи -->
					<div class="form-group">
						<label for="task" class="col-sm-3 control-label">Имя</label>

						<div class="col-sm-9">
							<input type="text" name="name" id="task-name" class="form-control" value="{{ old('name') }}">
						</div>
					</div>
					<!-- Телефон -->
					<div class="form-group">
						<label for="task" class="col-sm-3 control-label">Телефон</label>

						<div class="col-sm-9">
							<input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
						</div>
					</div>
					<!-- Кнопка добавления задачи -->
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<button type="submit" class="btn btn-default">Добавить</button>
						</div>
					</div>
				</form>
			</div>
			@if (count($tasks) > 0)
			<div class="col-md-6">
				<!-- Текущие задачи -->
				<table class="table">
					<!-- Заголовок таблицы -->
						<th>Имя</th>
						<th>Телефон</th>
						<th>Операции</th>
						<th></th>
					<!-- Тело таблицы -->
					<tbody>
					@foreach ($tasks as $task)
						<tr>
							<!-- Имя задачи -->
							<td class="table-text">
								<div>{{ $task->name }}</div>
							</td>
							<td class="table-text">
								<div>{{ $task->phone }}</div>
							</td>
							<!-- Кнопка Удалить -->
							<td>
								<a href="{{ route('task.edit', ['task' => $task->id]) }}">Изменить</a>
								<form action="{{ route('task.destroy', ['task' => $task->id]) }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger">Удалить</button>
								</form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			@endif
	</div>
@endsection
