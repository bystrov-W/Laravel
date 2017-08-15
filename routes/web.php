<?php
use App\Task;
use Illuminate\Http\Request;

//Вывести список всех задач
Route::get('/', 'UserController@allTasks');

//Добавить новую задачу
Route::post('/task', 'UserController@addTask');
	
//Обновить данные
Route::post('/change', 'UserController@changeTask');

//Удалить существующую задачу
Route::delete('/task/{id}', 'UserController@deleteTask');

//Выбор контакта для редактирования
Route::get('/change/{id}', 'UserController@selectContact');