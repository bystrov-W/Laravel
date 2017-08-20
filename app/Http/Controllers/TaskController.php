<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    /**
     * Вывести список всех задач
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return view('tasks', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Сохранить новую задачу
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateTask($request);

        $task = new Task;
        $task->name = $request->name;
        $task->phone = $request->phone;
        $task->save();

        return redirect()->route('task.index');
    }

    /**
     * Удалить существующую задачу
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect()->route('task.index');
    }

    /**
     * Выбор контакта для редактирования
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasks = Task::find([$id]);
        return view('change', ['tasks' => $tasks]);
    }

    /**
     * Обновление задачи
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateTask($request);

        $task = Task::find($id);
        $task->name = $request->name;
        $task->phone = $request->phone;
        $task->save();

        return redirect()->route('task.index');
    }

    /**
     * Проверка ввода
     * 
     * @param \Illuminate\Http\Request  $request
     */
    private function validateTask(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required|digits:10',
        ]);
    }
}
