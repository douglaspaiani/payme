<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'cpf',
        'cnpj',
        'tipo'
    ];

    public function login(array $data){
        // verify
        if(Users::where('email', $data['email'])->count() == 1){
            $user = Users::where('email', $data['email'])->first();
            if (Hash::check($data['senha'], $user->senha)){
                session_start();
                $_SESSION['email'] = $user->email;
                $_SESSION['id'] = $user->id;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function register(array $data){
        $exist = 0;
        //Verify exists users
        // CPF or CNPJ
        if(!empty($data['cpf'])){
            if(Users::where('cpf', $data['cpf'])->count() > 0){
                $exist = 1;
            }
        }
        if(!empty($data['cnpj'])){
            if(Users::where('cnpj', $data['cnpj'])->count() > 0){
                $exist = 1;
            }
        }
        // Email
        if(Users::where('email', $data['email'])->count() > 0){
            $exist = 1;
        }
        // create not exists
        if($exist == 0){
            $data['senha'] = Hash::make($data['senha']);
            $create = Users::create($data);
            if($create){
                $transaction = new Transactions();
                $transaction->TransactionBonus($create->id, $data['balance'] ?? null);
                return true;
            } else {
                return false;
            }
        } else {
            return "User exist";
        }
    }

    static function AccountName(int $id){   
        if($id == 0){
            return 'Payme';
        }
        $user = Users::find($id);
        return $user['nome'];
    }

}
