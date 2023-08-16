<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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
        //retrieval of data
        $response = Http::get('http://netzwelt-devtest.azurewebsites.net/Territories/All');
        $territories = $response->json();
        $territories = $territories['data'];

        //data holders
        $parents = [];
        $places = [];
        $unaccounted = [];

        //processing flat data into a hierarchy
        for($i = 0; $i < sizeof($territories); $i += 1){
            //add this place to the places array
            $place = $territories[$i];
            $places[$place['id']] = [
                "name" => $place["name"],
                "parent" => $place["parent"],
                "child" => []
            ];

            //if this place has no parent, add it to places array
            if(is_null($place['parent'])){
                array_push($parents, $place['id']);
            }else{ //if it has a parent...

                //if the parent has already been added before, record this place as its child
                if(array_key_exists($place['parent'], $places)){
                    array_push($places[$place['parent']]['child'], $place['id']);
                }else{ //else, record it later
                    array_push($unaccounted, $place['id']);
                }
            }
        }

        for($i=0; $i < sizeof($unaccounted); $i+=1){
            $thisplace = $places[$unaccounted[$i]];
            $parent = $thisplace['parent'];

            array_push($places[$parent]['child'], $unaccounted[$i]);
        }

        unset($territories);
        unset($unaccounted);

        return view('home')->with(["parents"=>$parents, "places"=>$places]);
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