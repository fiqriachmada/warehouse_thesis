<?php 

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Rented;
use App\Repositories\TenantRepository;
use App\Repositories\TempTransactionRepository;

class RentedRepository
{
    protected $tempTransactionRepository, $tenantRepository, $detailTransactionRepository;

    public function __construct(TempTransactionRepository $tempTransactionRepository, TenantRepository $tenantRepository, DetailTransactionRepository $detailTransactionRepository)
    {
        $this->tempTransactionRepository = $tempTransactionRepository;
        $this->tenantRepository = $tenantRepository; 
        $this->detailTransactionRepository = $detailTransactionRepository;
    }

    public function getRented($id)
    {
        return Rented::find($id);
    }

    public function checkIfRentedExistFromTempTransaction()
    {
        $data = [];
        foreach ($this->tempTransactionRepository->getTempTransactionByTenantId()->get() as $key => $item) {
            $data[] = $item->warehouse_subscription->warehouse_id;
        }

        return Rented::where('tenant_id', auth()->user()->tenant->id)
                    ->whereIn('warehouse_id', $data);
    }

    public function getRentedByTransactionId($id)
    {
        return Rented::where('transaction_id', $id)->get();
    }

    public function getRentedByWarehouseId($id, $require)
    {
        $rented = Rented::where('warehouse_id', $id);

        if ($require == 'count') {
            return $rented->count();
        } elseif ($require == 'get') {
            return $rented->get();
        }
    }

    public function deleteRentWhenExpiredToday()
    {
        return Rented::whereDate('ended_at', Carbon::today())->delete();
    }

    public function updateRentedStatusByTransactionId($id)
    {
        foreach ($this->detailTransactionRepository->getDetailTransactionByTransactionId($id) as $key => $item) {
            $subscriptionDurationInMonths = $item->warehouse_subscription->subscription->month_duration;

            $yearsToAdd = floor($subscriptionDurationInMonths / 12);
            $monthsToAdd = $subscriptionDurationInMonths % 12;

            $this->detailTransactionRepository->getDetailTransactionById($item->id)->update([
                'started_at' => Carbon::now(),
                'ended_at' => Carbon::now()->addYears($yearsToAdd)->addMonths($monthsToAdd)
            ]);
        }
        
        foreach (self::getRentedByTransactionId($id) as $key => $item) {
            $subscriptionDurationInMonths = self::getRented($item->id)->warehouse_subscription->subscription->month_duration;
            
            $yearsToAdd = floor($subscriptionDurationInMonths / 12);
            $monthsToAdd = $subscriptionDurationInMonths % 12;

            self::getRented($item->id)->update([
                'status' => 'active',
                'started_at' => Carbon::now(),
                'ended_at' => Carbon::now()->addYears($yearsToAdd)->addMonths($monthsToAdd)
            ]);

            $this->tenantRepository->getTenant($item->tenant_id)->update([
                'rank' => 'paid'
            ]);
        }

        return true;
    }

    public function deleteRented($id)
    {
        return self::getRented($id)->delete();
    }
}