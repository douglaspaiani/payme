<?php 

namespace App\Repositories;

use App\Models\Users;

class UsersRepository
{
    public function findByEmail(string $email)
    {
        return Users::where('email', $email)->first();
    }

    public function findByCPF(string $cpf)
    {
        return Users::where('cpf', $cpf)->first();
    }

    public function findByCNPJ(string $cnpj)
    {
        return Users::where('cnpj', $cnpj)->first();
    }
}