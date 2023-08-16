<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/account/login', function () {
    return view('welcome');
});

Route::post('/account/login', function (Request $request){
    $credentials = [
        "username" => $request->username,
        "password" => $request->password
    ];

    $response = Http::post('http://netzwelt-devtest.azurewebsites.net/Account/SignIn', $credentials);
    $user = $response->json();
    
    if($response->status() == 200){
        
    }else{
        return back()->withErrors([
            'invalid' => $user
        ]);
    }

})->name('/account/login');