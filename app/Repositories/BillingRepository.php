<?php

namespace App\Repositories;

use App\Models\Bank;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class BillingRepository
{

    public function getAllBilling()
    {
        return Bank::all();
    }

    public function getBilling($id)
    {
        return Bank::find($id);
    }

    public function getAllBillingByUserId()
    {
        return Bank::where('user_id', auth()->user()->id)->get();
    }

    public function getFirstBillingByUserId()
    {
        return Bank::where('user_id', auth()->user()->id)->first();
    }

    public function checkBillingStatusUser()
    {
        return Bank::where('status', 'primary')->where('user_id', auth()->user()->id)->first();
    }

    public function getPrimaryBilling()
    {
        return Bank::where('status', 'primary')->first();
    }

    public function getBillingStatusUserCore()
    {
        return Bank::join('users', 'banks.user_id', '=', 'users.id')
                    ->select('banks.*')
                    ->where('status', 'primary')
                    ->where('attribute', 'core')
                    ->first();
    }

    public function checkBillingStatusUserCount()
    {
        return Bank::where('status', 'primary')->where('user_id', auth()->user()->id)->count();
    }
    
    public function getAllBillingByUserIdExceptBillingNowId($id)
    {
        return Bank::where('user_id', auth()->user()->id)->where('id', '!=', $id)->get();
    }

    public function createBilling($data)
    {
        $bank_id = Uuid::uuid4()->toString();

        $bank_status = $this->checkBillingStatusUser();

        return DB::transaction(function () use ($data, $bank_id, $bank_status) {
            return Bank::create([
                'id' => $bank_id,
                'user_id' => auth()->user()->id,
                'account_holder_name' => $data->account_holder_name,
                'bank_account_number' => $data->bank_account_number,
                'bank_name' => $data->bank_name,
                'status' => $bank_status ? 'secondary' : 'primary'
            ]);
        });
    }

    public function updateBilling($data, $id)
    {
        self::getBilling($id)->update([
            'account_holder_name' => $data->account_holder_name,
            'bank_account_number' => $data->bank_account_number,
            'bank_name' => $data->bank_name
        ]);

        if (isset($data->status)) {
            if (self::getAllBillingByUserId()->count() > 1) {
                self::getBilling($id)->update([
                    'status' => 'primary'
                ]);

                self::updateAllBillingStatusExceptBillingNowId($id, 'secondary');
            } else {
                self::getBilling($id)->update([
                    'status' => 'primary'
                ]);
            }
        } else {
            if (self::getAllBillingByUserId()->count() > 1) {
                self::getBilling($id)->update([
                    'status' => 'secondary'
                ]);

                self::getFirstBillingByUserId()->update([
                    'status' => 'primary'
                ]);
            } else {
                self::getBilling($id)->update([
                    'status' => 'secondary'
                ]);
            }
        }

        return true;
    }

    public function updateAllBillingStatusExceptBillingNowId($id, $status)
    {
        foreach (self::getAllBillingByUserIdExceptBillingNowId($id) as $key => $value) {
            $value->update(['status' => $status]);
        }
    }

    public function destroyBilling($id)
    {
        if (self::getAllBillingByUserId()->count() > 1) {
            if (self::getBilling($id)->status == 'primary') {
                self::updateAllBillingStatusExceptBillingNowId($id, 'secondary');                
                self::getBilling($id)->delete();
                self::getFirstBillingByUserId()->update(['status' => 'primary']);

                return true;
            } else {
                return self::getBilling($id)->delete();
            }       
        } else {
            return self::getBilling($id)->delete();
        }
    }
}