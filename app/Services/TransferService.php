<?php

namespace App\Services;

use App\Models\Transactions;
use App\Repositories\TransactionRepository;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Http;

class TransferService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function transfer($value, Users $payer, Users $payee)
    {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);

        if ($payer->id === $payee->id) {
            return "O pagador e o beneficiário devem ser usuários diferentes.";
        }

        if(!empty($payer->cnpj)){
            return "Lojistas não podem realizar transferências.";
        }

        if ($value <= 0) {
            return "Transferência não pode ser 0.";
        }

        if (Transactions::BalanceTotal() < $value) {
            return "Saldo insuficiente.";
        }

        DB::beginTransaction();

        try {

            $authorization = Http::get(env('URL_AUTH'))->json();

            if($authorization['data']['authorization'] == true){
                $this->transactionRepository->create([
                    'payer' => $payer->id,
                    'payee' => $payee->id,
                    'value' => $value,
                ]);
            } else {
                return "Authorization failed.";
            } 

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return "Falha na transação: " . $e->getMessage();
        }
    }

    public function ApiTransfer($value, Users $payer, Users $payee)
    {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);

        if ($payer->id === $payee->id) {
            return "O pagador e o beneficiário devem ser usuários diferentes.";
        }

        if(!empty($payer->cnpj)){
            return "Lojistas não podem realizar transferências.";
        }

        if ($value <= 0) {
            return "Transferência não pode ser 0.";
        }

        if (Transactions::BalanceTotalById($payer->id) < $value) {
            return "Saldo insuficiente.";
        }

        if(!isset($payee->id) || !isset($payer->id)){
            return "Usuário não encontrado.";
        }

        DB::beginTransaction();

        try {

            $authorization = Http::get(env('URL_AUTH'))->json();

            if($authorization['data']['authorization'] == true){
                $this->transactionRepository->create([
                    'payer' => $payer->id,
                    'payee' => $payee->id,
                    'value' => $value,
                ]);

                DB::commit();

                return true;
            } else {
                return "Authorization failed.";
            }
            
        } catch (Exception $e) {
            DB::rollBack();
            return "Falha na transação: " . $e->getMessage();
        }
    }

    public function extract(){
        $extract = Transactions::where('payee', $_SESSION['id'])
        ->orWhere('payer', $_SESSION['id'])
        ->orderBy('id', 'desc')
        ->get();
        return $extract;
    }

    public function revert(int $id){
        if(Transactions::find($id)->delete()){
            return true;
        } else {
            return false;
        }
    }
}
