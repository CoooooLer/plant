<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/20
 * Time: 9:45
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\model\User;

class PassportController extends Controller
{
    public $successStatus = 200 ;

    /*login api*/
    public function login()
    {
        if(Auth::attempt(['phone' => request('phone'),'password' => request('password')]))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success],$this->successStatus);
        }
        else
        {
            return response()->json(['error' => 'Unauthorised'],401);
        }
    }

    /*register api*/
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'phone' => 'required',
        ]);

        dd($request);

        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()],401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['username'] = $user->username;

        return response()->json(['success' => $success],$this->successStatus);
    }

    /*details api*/
    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user],$this->successStatus);
    }

}