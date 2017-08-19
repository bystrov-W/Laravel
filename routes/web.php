<?php

Route::get('/', function () { 
    return redirect('/task');
});

Route::resource('task', 'TaskController', ['except' => ['create', 'show']]);