<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'payer',
        'payee'
    ];

    static function Balance(){
        $entry = Transactions::where('payee', $_SESSION['id'])->sum('value');
        $exit = Transactions::where('payer', $_SESSION['id'])->sum('value');
        $value = $entry - $exit;
        return number_format($value, 2, ',', '.');
    }

    static function BalanceById(int $id){
        $entry = Transactions::where('payee', $id)->sum('value');
        $exit = Transactions::where('payer', $id)->sum('value');
        $value = $entry - $exit;
        return number_format($value, 2, ',', '.');
    }

    static function BalanceTotal(){
        $entry = Transactions::where('payee', $_SESSION['id'])->sum('value');
        $exit = Transactions::where('payer', $_SESSION['id'])->sum('value');
        $value = $entry - $exit;
        return $value;
    }

    static function BalanceTotalById(int $id){
        $entry = Transactions::where('payee', $id)->sum('value');
        $exit = Transactions::where('payer', $id)->sum('value');
        $value = $entry - $exit;
        return $value;
    }

    public function TransactionBonus(int $id, $balance = 1000){
        $data = [
            'value' => $balance,
            'payer' => 0,
            'payee' => $id
        ];
        if(Transactions::create($data)){
            return true;
        } else {
            return false;
        }
    }
}
