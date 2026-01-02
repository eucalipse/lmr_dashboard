<?php

namespace App\AE\C;

use App\AE\C\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AE_Auth extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function getLogin($type) {
        
        $app=config('_._app');
        
        if (isset($app->{$type})){
            $app_type=(object)$app->{$type};

            return view($app_type->auth_folder.'.login')->with('url', $app_type->url);
        }    
 
    }
    
    public function postLogin(Request $request, $type) {
    	$data = (object)$request->all();
		$credentials=['email' => $data->login, 'password' => $data->password];
		
		$app=config('_._app');
		
		if (isset($app->{$type})){
		    $app_type=(object)$app->{$type};
		    
		    if (Auth::attempt($credentials, true) && Auth::user()->type==$app_type->type) {
		        return redirect($app_type->default_url);
		    } else {
		        return view($app_type->auth_folder.'.login')->with('url', $app_type->url);
		    }
		    
		}
    }

    public function getLogout($type)
    {
    	Auth::logout();
    	
    	$app=config('_._app');
    	
    	if (isset($app->{$type})){
    	    $app_type=(object)$app->{$type};
            return view($app_type->auth_folder.'.logout');
    	}
    }
    
    
    static public function getUserModel($type, $id){
        
        $app=config('_._app');
        
        if (isset($app->{$type})){
            $app_type=(object)$app->{$type};
            return \App\AE\C\AE_D::getDataById($app_type->model, $id);
        } else {
            return null;
        }
        
    }
    
    // $password= \Hash::make('lmr');
    
}

?>
