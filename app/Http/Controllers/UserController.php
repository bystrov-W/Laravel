<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class UserController extends Controller
{
	//Вывести список всех задач
	public function allTasks ()
	{
		$tasks = Task::orderBy('created_at', 'asc')->get();
		return view('tasks', [
			'tasks' => $tasks
		]);
	}
	
	//Добавить новую задачу
	public function addTask (Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'phone' => 'required|max:255',
		]);

		if ($validator->fails()) {
			return redirect('/')
			->withInput()
			->withErrors($validator);
		}

		$task = new Task;
		$task->name = $request->name;
		$task->phone = $request->phone;
		$task->id = $request->id;
		$task->save();

		return redirect('/');
	}

	//Обновить данные
	public function changeTask (Request $request) {
		$id = $request->id;
		$name = $request->name;
		$phone = $request->phone;
		
		/*$affected = DB::update('update tasks set name=?,phone=?  where name = ?', [$name,$phone,$id]); */
		$a = DB::table('tasks')
            ->where('id', $id)
            ->update(['phone' => $phone, 'name' => $name]);

		return redirect('/');
	}
	
	//Выбор контакта для редактирования
	public function selectContact ($id) {
		$tasks = DB::select('select * from tasks where id = ?', [$id]);
		return view('change', ['tasks' => $tasks]);
	}

	// Удалить существующую задачу
	public function deleteTask ($id) {
		Task::findOrFail($id)->delete();
		return redirect('/');
	}
}
