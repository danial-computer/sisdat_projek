<?php

use App\Http\Resources\UserRecource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/users', function(){
    return UserRecource::collection(resource: User::all()); 
});
