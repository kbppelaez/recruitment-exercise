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

Route::get('/', function (Request $request) {
    if($request->session()->has('loggedin')){
        $response = Http::get('http://netzwelt-devtest.azurewebsites.net/Territories/All');

        $territories = $response->json();

        dd($territories['data']);
        return view('home');
    }else{
        return redirect()->intended('/account/login');
    }
});

Route::get('/account/login', function (Request $request) {
    if($request->session()->has('loggedin')){
        return redirect()->intended('/');
    }else{
        return view('welcome');
    }
});

Route::post('/account/login', function (Request $request){
    //getting credentials from the form
    $credentials = [
        "username" => $request->username,
        "password" => $request->password
    ];

    //requesting for credential validation
    $response = Http::post('http://netzwelt-devtest.azurewebsites.net/Account/SignIn', $credentials);
    $user = $response->json();
    
    //checking of response status
    if($response->status() == 200){  //if OK
        $request->session()->regenerate();              //regenerate session token
        $request->session()->put('loggedin', 'true');   //indicate that user has logged in
        return redirect()->intended('/');               //redirect to home page
    }else{ //if invalid
        return back()->withErrors([
            'invalid' => $user      //show error returned by API
        ]);
    }

})->name('/account/login');

Route::get('/account/logout', function(Request $request){
    $request->session()->invalidate();
    return redirect()->intended('/account/login');
})->name('/account/logout');