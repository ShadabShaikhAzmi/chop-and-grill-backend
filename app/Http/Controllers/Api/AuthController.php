<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use App\Traits\RespondsWithHttpStatus;

class AuthController extends Controller
{
    use RespondsWithHttpStatus;
    
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'unique:users|required|min:10|max:10|regex:/^[0-9]+$/',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->failure($validator->errors()->first());       
        }

        $user = new User();
        $user->mobile_number = $request->mobile_number;
        $user->password = bcrypt($request->password);
        $user->role_id = 2;
        $user->save();
        $success['token'] =  $user->createToken('MyAppMeat')->plainTextToken;
        return $this->success('Dear customer you have register successfully.', $success);
    }

    public function loginUser(Request $request)
    {
        if(Auth::attempt(['mobile_number' => $request->mobile_number, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyAppMeat')->plainTextToken;
            return $this->success('Dear customer you have login successfully.', $success);
        } 
        else{ 
            return $this->failure('Unauthorised.');
        } 
    }
}
