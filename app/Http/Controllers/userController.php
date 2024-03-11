<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    public function registration_form(){
    return view('register');
    }

    public function registration(Request $request)
    {
      
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => 'required|string|min:8',
            ]);
    
            if ($validator->fails()) {
                return redirect('register')
                    ->withErrors($validator)
                    ->withInput();
            }
    
            $user = [
                'name' => $request->name,
                'email' => $request->email,
                'password' =>$request->password,
            ];
    
            User::create($user);
            session()->flash('success', 'Successfully Registered');
            return redirect('/login');
       
        
    }


    public function login_form(){
    return view('login');
    }
      
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('myApp')->plainTextToken;
  
            session()->flash('success', 'Successfully Logged In');
           
            session()->put('token', $token);
            session()->put('user',  $user);
    
            return redirect()->route('dashboard');
               
        } else {
            session()->flash('error', 'Invalid login credentials. Please try again.');
            return redirect()->route('login_form');
        }
    }
    
    public function dashboard()
    {
        $token = session()->get('token');
        $user = session()->get('user');
    
        if (!$token || !$user) {
            return redirect('login');
        }
    
        return view('dashboard', compact(['token','user']));
    }
    
public function logout()
{
    Auth::logout();
    session()->forget(['token', 'user']);
    return redirect()->route('login_form');
}

}
