<?php

namespace App\Services;

use App\Models\Guardian;
use App\Models\Kid;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Exception;

class WalletService
{
    public function createParentChildWallet($walletOwnerid, $wallettype)
    {
        Wallet::create([
            'walletable_id' => $walletOwnerid,
            'walletable_type' => $wallettype,
            'balance' => 0,
        ]);
        return true;
    }
    public function addMoneyToParentWallet($parentId, $amount)
    {
        $parent = Guardian::find($parentId);
        if (!$parent) {
            throw new Exception('Parent not found');
        }
        $wallet = $parent->wallet;
        $wallet->balance += $amount;
        $wallet->save();

        $this->recordTransaction($wallet->id, null, $amount, 'add');
    }

    public function distributeMoneyToChild($parentId, $childId, $amount)
    {
        DB::beginTransaction();

        try {
            $parent = Guardian::find($parentId);
            if (!$parent) {
                throw new Exception('Parent not found');
            }

            $parentWallet = $parent->wallet;
            if ($parentWallet->balance < $amount) {
                throw new Exception('Insufficient balance in parent wallet');
            }

            $child = Kid::find($childId);
            if (!$child) {
                throw new Exception('Child not found');
            }
            if ($child &&  $child->approval_status==0) {
                throw new Exception('Wait Until Child Approval');
            }
            $childWallet = $child->wallet;

            $parentWallet->balance -= $amount;
            $childWallet->balance += $amount;

            $parentWallet->save();
            $childWallet->save();

            $this->recordTransaction($parentWallet->id, $childWallet->id, $amount, 'distribute');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function transferMoneyBetweenChildren($fromChildId, $toChildId, $amount)
    {
        DB::beginTransaction();

        try {
            $fromChild = Kid::find($fromChildId);
            if (!$fromChild) {
                throw new Exception('From child not found');
            }
            if ($fromChild && $fromChild->approval_status==0) {
                throw new Exception('Wait Until Child Approval');
            }
            $fromWallet = $fromChild->wallet;
            if ($fromWallet->balance < $amount) {
                throw new Exception('Insufficient balance in from child wallet');
            }

            $toChild = Kid::find($toChildId);
            if (!$toChild) {
                throw new Exception('To child not found');
            }
            if ($toChild && $toChild->approval_status==0) {
                throw new Exception('Wait Until Child Approval');
            }
            $toWallet = $toChild->wallet;

            $fromWallet->balance -= $amount;
            $toWallet->balance += $amount;

            $fromWallet->save();
            $toWallet->save();

            $this->recordTransaction($fromWallet->id, $toWallet->id, $amount, 'transfer');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    protected function recordTransaction($fromWalletId, $toWalletId, $amount, $type ,$paymethod=null,$status='completed')
    {
        Transaction::create([
            'transaction_id'=>time().'-'.auth('sanctum')->user()->id,
            'from_wallet_id' => $fromWalletId,
            'to_wallet_id' => $toWalletId,
            'amount' => $amount,
            'type' => $type,
            'payment_method'=>$paymethod,
            'payment_status'=>$status,
        ]);
    }
}
