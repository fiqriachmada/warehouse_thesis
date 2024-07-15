<?php 

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionRepository
{
    protected $rentedRepository, $warehouseRepostory;

    public function __construct(RentedRepository $rentedRepository, WarehouseRepository $warehouseRepository)
    {
        $this->rentedRepository = $rentedRepository;
        $this->warehouseRepostory = $warehouseRepository;
    }

    public function getAllTransactions()
    {
        return Transaction::all();
    }

    public function getTransactionById($id)
    {
        return Transaction::find($id);
    }

    public function getTransactionByStatus($status)
    {
        $query = Transaction::where('status', $status);

        if (Auth::check()) {
            if (auth()->user()->level == 'tenant') {
                $query->where('tenant_id', auth()->user()->tenant->id);
            }
        }

        return $query->get();
    }

    public function getAllTransactionsGroupByPeriodically($periodic)
    {
        $groupByClause = '';

        switch ($periodic) {
            case 'day':
                $groupByClause = DB::raw('DATE(transactions.created_at) as period');
                break;
            case 'month':
                $groupByClause = DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m") as period');
                break;
            case 'year':
                $groupByClause = DB::raw('YEAR(transactions.created_at) as period');
                break;
            default:
                break;
        }

        return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
            ->join('taxes', 'transactions.tax_id', '=', 'taxes.id')
            ->select(DB::raw('COUNT(*) as amount'), DB::raw('SUM(subtotal + (subtotal * value / 100)) as subtotal'),$groupByClause)
            ->where('transactions.status', '=', 'confirmed')
            ->groupBy('period')
            ->get();
    }

    public function updateTransactionStatus($id, $status = null)
    {
        $transaction = self::getTransactionById($id);

        // if ($status == 'success') {
        //     $transaction->update([
        //         'status' => 'confirmed'
        //     ]);
            
        return $this->rentedRepository->updateRentedStatusByTransactionId($id);
        // } elseif ($status == 'declined') {
        //     $transaction->update([
        //         'status' => 'declined'
        //     ]);

        //     foreach ($this->rentedRepository->getRentedByTransactionId($id) as $key => $item) {
        //         $this->warehouseRepostory->updateStatusWarehouse($item->warehouse_id, 'available');
        //         $this->rentedRepository->deleteRented($item->id);
        //     }
            
        //     return true;
        // }
    }

    public function getTransactionByDay($day)
    {
        $timestamp = strtotime($day);

        return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('taxes', 'transactions.tax_id', '=', 'taxes.id')
                        ->join('tenants', 'transactions.tenant_id', '=', 'tenants.id')
                        ->join('warehouse_subscriptions', 'detail_transactions.warehouse_subscription_id', '=', 'warehouse_subscriptions.id')
                        ->join('warehouses', 'warehouse_subscriptions.warehouse_id', '=', 'warehouses.id')
                        ->join('subscriptions', 'warehouse_subscriptions.subscription_id', '=', 'subscriptions.id')
                        ->select('transactions.*', 'detail_transactions.subtotal','tenants.name as tenant_name','taxes.value', 'subscriptions.name as subscription_name', 'warehouses.name as warehouse_name')
                        ->where('transactions.status', '=', 'confirmed')
                        ->whereDate('transactions.created_at', '=', date('Y-m-d', $timestamp))
                        ->get();
    }

    public function getTransactionByMonth($month)
    {
        $timestamp = Carbon::createFromFormat('F-Y', $month)->startOfMonth();

        return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('taxes', 'transactions.tax_id', '=', 'taxes.id')
                        ->join('tenants', 'transactions.tenant_id', '=', 'tenants.id')
                        ->join('warehouse_subscriptions', 'detail_transactions.warehouse_subscription_id', '=', 'warehouse_subscriptions.id')
                        ->join('warehouses', 'warehouse_subscriptions.warehouse_id', '=', 'warehouses.id')
                        ->join('subscriptions', 'warehouse_subscriptions.subscription_id', '=', 'subscriptions.id')
                        ->select('transactions.*', 'detail_transactions.subtotal','tenants.name as tenant_name','taxes.value', 'subscriptions.name as subscription_name', 'warehouses.name as warehouse_name')
                        ->where('transactions.status', '=', 'confirmed')
                        ->whereBetween('transactions.created_at', [$timestamp->format('Y-m-d H:i:s'), $timestamp->endOfMonth()->format('Y-m-d H:i:s')])
                        ->get();
    }

    public function getTransactionByYear($year)
    {
        return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('taxes', 'transactions.tax_id', '=', 'taxes.id')
                        ->join('tenants', 'transactions.tenant_id', '=', 'tenants.id')
                        ->join('warehouse_subscriptions', 'detail_transactions.warehouse_subscription_id', '=', 'warehouse_subscriptions.id')
                        ->join('warehouses', 'warehouse_subscriptions.warehouse_id', '=', 'warehouses.id')
                        ->join('subscriptions', 'warehouse_subscriptions.subscription_id', '=', 'subscriptions.id')
                        ->select('transactions.*', 'detail_transactions.subtotal','tenants.name as tenant_name','taxes.value', 'subscriptions.name as subscription_name', 'warehouses.name as warehouse_name')
                        ->where('transactions.status', '=', 'confirmed')
                        ->whereYear('transactions.created_at', $year)
                        ->get();
    }

    public function getTransactionWithDetailTransaction($warehouse)
    {
        return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('warehouse_subscriptions', 'detail_transactions.warehouse_subscription_id', '=', 'warehouse_subscriptions.id')
                        ->join('subscriptions', 'warehouse_subscriptions.subscription_id', '=', 'subscriptions.id')
                        ->select('detail_transactions.started_at', 'detail_transactions.ended_at', 'detail_transactions.subtotal', 'subscriptions.name as subscription')
                        ->where('transactions.tenant_id', auth()->user()->tenant->id)
                        ->where('warehouse_subscriptions.warehouse_id', $warehouse->id)
                        ->get();
    }

    public function getWeeklyRevenueReport()
    {
        $weeklyDataTransaction = Transaction::select(DB::raw('COUNT(*) as amount'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('DAYNAME(created_at) as day'))
                            ->where('transactions.status', '=', 'confirmed')
                            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                            ->groupBy(DB::raw('DAYNAME(created_at)'))
                            ->orderByRaw('FIELD(day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
                            ->pluck('count', 'day', 'grand_total')
                            ->all();

        $processedData = [];
        $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
    
        foreach ($daysOfWeek as $day) {
            $processedData[] = $weeklyDataTransaction[$day] ?? 0;
        }
    
        $processedData = array_pad($processedData, 7, 0);

        return $processedData;
    }

    public function getWeeklyReportTransactionIncome()
    {
        return Transaction::select(DB::raw('SUM(grand_total) as grand_total'))
                            ->where('transactions.status', '=', 'confirmed')
                            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                            ->first();
    }

    public function getWeeklyReportTransactionIncomePercentage() {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastMonthYear = Carbon::now()->subMonth()->year;

        $currentMonthCount = self::getAllTransactions()->where('transactions.status', '=', 'confirmed')->where('created_at', $currentMonth)->where('created_at', $currentYear)->count();
        $lastMonthCount = self::getAllTransactions()->where('transactions.status', '=', 'confirmed')->where('created_at', $lastMonth)->where('created_at', $lastMonthYear)->count();

        if ($lastMonthCount == 0) {
            return $currentMonthCount > 0 ? 100 : 0;
        }

        $growth = (($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100;

        return round($growth, 2);
    }

    public function getAllOfTimeTransactionsIncome($status)
    {
        return Transaction::select(DB::raw('SUM(grand_total) as grand_total'))
                            ->where('transactions.status', '=', $status)
                            ->first();
    }
}