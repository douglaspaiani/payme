<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Users;
use App\Repositories\UsersRepository;
use App\Services\TransferService;
use Exception;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    protected $transferService;
    protected $usersRepository;

    public function __construct(TransferService $transferService, UsersRepository $usersRepository)
    {
        $this->transferService = $transferService;
        $this->usersRepository = $usersRepository;
    }

    public function transfer(){
        $user = [
            'saldo' => Transactions::Balance(),
            'transfer' => false
        ];
        $payee = [];
        if(isset($_GET['payee'])){

            $input = $_GET['payee'];

            if ($this->isEmail($input)) {
                $payee = $this->usersRepository->findByEmail($input);
            }
    
            if ($this->isCPF($input)) {
                $payee = $this->usersRepository->findByCPF($input);
            }
    
            if ($this->isCNPJ($input)) {
                $payee = $this->usersRepository->findByCNPJ($input);
            }

            if(!empty($payee['nome'])){
                $user['transfer'] = true;
                if($payee['email'] == $_SESSION['email']){
                    $user['transfer'] = false;
                    $error = "Você não pode transferir para sí mesmo.";
                }
            } else {
                $error = "Beneficiário não encontrado.";
            }
        }
        return view('transfer', ['user' => $user, 'payee' => $payee, 'error' => $error ?? null]);
    }

    public function PostTransfer(Request $request){

        $validated = $request->validate([
            'value' => 'required|string|min:0.01',
            'payee' => 'required|integer|exists:users,id',
        ]);

        try {
            $payer = Users::findOrFail($_SESSION['id']);
            $payee = Users::findOrFail($validated['payee']);

            $transaction = $this->transferService->transfer(
                $validated['value'],
                $payer,
                $payee
            );

            if($transaction !== true){
                $error = $transaction;
                $user = [
                    'saldo' => Transactions::Balance(),
                    'transfer' => true
                ];
                return view('transfer', ['user' => $user, 'payee' => $payee, 'error' => $error ?? null]);
            } else {
                return view('success');
            }

        } catch (Exception $e) {
            return view('transfer',  ['user' => $payer, 'payee' => $payee, 'error' => $e->getMessage()]);
        }
    }

    public function success(){
        return view('success');
    }

    public function extract(){
        $extract = $this->transferService->extract();
        return view('extract', ['saldo' => Transactions::Balance(), 'extract' => $extract]);
    }

    public function revert(int $id, string $status){
        if($status == 'confirmed'){
            $this->transferService->revert($id);
            return redirect()->route('extract');
        }
        return view('revert', ['id' => $id]);
    }
}
