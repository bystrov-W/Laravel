<?php

Route::get('/', function () { 
    return redirect()->route('task.index');
});

Route::resource('task', 'TaskController', ['except' => ['create', 'show']]);