<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class AtmController extends Controller
{
    // 新規口座開設
    public function accountOpen(Request $request)
    {
        $account = new BankAccount();
        $account->deposit_balance = 0;
        $account->save();

        return $account;
    }

    // 残高照会
    public function balanceReference($accountId)
    {
        $account = BankAccount::find($accountId);
        return response()->json(["deposit_balance" => $account->deposit_balance]);
    }

    // 預入処理
    public function deposit(Request $request, $accountId)
    {
        $account = BankAccount::find($accountId);
        $account->deposit_balance += $request->amount;
        $account->save();

        return response()->json(["deposit_balance" => $account->deposit_balance]);
    }

    // 引き出し処理
    public function withdrawal($accountId, Request $request)
    {
        $account = BankAccount::find($accountId);
        if($account->deposit_balance >= $request->amount){
            $account->deposit_balance -= $request->amount;
            $account->save();
        }
        return response()->json(["deposit_balance" => $account->deposit_balance]);
    }

    // csrf用のトークン発行
    public function createToken()
    {
        return csrf_field();
    }
}
