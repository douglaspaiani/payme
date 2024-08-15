<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home(){
        $user = Users::where('email', $_SESSION['email'])->first();
        $usuario = [
            'nome' => $user->nome,
            'saldo' => Transactions::Balance(),
            'cnpj' => $user->cnpj,
            'cpf' => $user->cpf
        ];
        return view('home', ['user' => $usuario]);
    }

    public function login(){
        return view('login');
    }

    public function logout(){
        session_start();
        session_destroy();
        return redirect()->route('login');
    }

    public function PostLogin(Request $request){
        $user = new Users();
        if($user->login($request->all()) == true){
            return redirect()->route('home');
        } else {
            return redirect()->route('login', ['return' => 'error']);
        }
    }

    public function register(){
        return view('register');
    }

    public function PostRegister(Request $request){
        $user = new Users();
        $data = $request->all();
        $register = $user->register($data);
        if($register === true){
            $user->login($data);
            return redirect()->route('home');
        } elseif($register == "User exist"){
            return redirect()->route('login', ['return' => 'user-exist']);
        } else {
            return redirect()->route('login', ['return' => 'error']);
        }
    }
}
