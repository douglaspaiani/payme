<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Users;
use App\Services\TransferService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    protected $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = Users::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->senha)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $token = $user->createToken('API Token')->plainTextToken;
    
        return response()->json(['token' => $token]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }

    public function transfer(Request $request){
        $request = $request->json()->all();

        try {
            $payer = Users::findOrFail($request['payer']);
            $payee = Users::findOrFail($request['payee']);

            $transaction = $this->transferService->ApiTransfer(
                $request['value'],
                $payer,
                $payee
            );

            if($transaction === true){
                return response()->json([
                    'status' => true,
                    'message' => 'Transfer successful.',
                    'data' => []
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Transfer failed.',
                    'data' => $transaction
                ], 400);
            }

            

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Transfer failed.',
                'error' => $e->getMessage()
            ], 400);
        
        }
        
    }

    public function register(Request $request){
        $user = new Users();
        $data = $request->json()->all();
        $register = $user->register($data);
        if($register === true){
            return response()->json([
                'status' => true,
                'message' => 'User created successfully.',
                'data' => [],
            ], 200);
        } elseif($register == "User exist"){
            return response()->json([
                'status' => false,
                'message' => 'User exist.',
                'data' => [],
            ], 400);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User created failed.',
                'data' => [],
            ], 400);
        }
    }

    public function balance(int $id){

        $transaction = Transactions::BalanceById($id);

        return response()->json([
            'status' => true,
            'message' => 'Balance successful.',
            'data' => 'R$ '.$transaction,
        ], 200);
    }

    public function revert(Request $request){
        $req = $request->json()->all();
        try {
            $this->transferService->revert($req['id_transaction']);
            return response()->json([
                'status' => true,
                'message' => 'Revert successful.',
                'data' => [],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Falha: '.$e->getMessage(),
                'data' => [],
            ], 400);
        }
        
    }
}
