<?php 

namespace App\Repositories;

use App\Models\Transactions;

class TransactionRepository
{
    public function create(array $data): Transactions
    {
        return Transactions::create($data);
    }

    public function find(int $id): ?Transactions
    {
        return Transactions::find($id);
    }

}
