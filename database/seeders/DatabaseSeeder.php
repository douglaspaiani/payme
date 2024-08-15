<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Conta de usuário        
        // Users::factory()->create([
        //     'nome' => 'Douglas Paiani',
        //     'email' => 'contato@douglaspaiani.com.br',
        //     'cpf' => '03737736090',
        //     'senha' => Hash::make('admin'),
        // ]);

        // // Conta de lojista
        // Users::factory()->create([
        //     'nome' => 'Logista Teste',
        //     'email' => 'lojista@hotmail.com',
        //     'cnpj' => '29660741000180',
        //     'senha' => Hash::make('admin'),
        // ]);
    }
}
