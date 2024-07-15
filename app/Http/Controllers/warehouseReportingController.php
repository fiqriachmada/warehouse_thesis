<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Repositories\OutboundRepository;
use Illuminate\Http\Request;

class warehouseReportingController extends Controller
{
    protected $outboundRepository;

    public function __construct(OutboundRepository $outboundRepository)
    {
        $this->outboundRepository = $outboundRepository;
    }

    public function warehouse_reporting_sales(Warehouse $warehouse, $period)
    {
        if ($period == 'daily') {
            return view('pages.warehouse.reporting.sales.daily', [
                'warehouse' => $warehouse
            ]);
        } elseif ($period == 'monthly') {
            return view('pages.warehouse.reporting.sales.monthly', [
                'warehouse' => $warehouse
            ]);
        } elseif ($period == 'yearly') {
            return view('pages.warehouse.reporting.sales.yearly', [
                'warehouse' => $warehouse
            ]);
        }
    }

    public function warehouse_reporting_daily_sales_print(Warehouse $warehouse, $date)
    {
        return view('pages.warehouse.reporting.sales.print-daily', [
            'outbounds' => $this->outboundRepository->getOutboundByDay($date, $warehouse),
            'warehouse' => $warehouse
        ]);
    }

    public function warehouse_reporting_monthly_sales_print(Warehouse $warehouse, $month)
    {
        return view('pages.warehouse.reporting.sales.print-monthly', [
            'outbounds' => $this->outboundRepository->getOutboundByMonth($month, $warehouse),
            'warehouse' => $warehouse
        ]);
    }

    public function warehouse_reporting_yearly_sales_print(Warehouse $warehouse, $year)
    {
        return view('pages.warehouse.reporting.sales.print-yearly', [
            'outbounds' => $this->outboundRepository->getOutboundByYear($year, $warehouse),
            'warehouse' => $warehouse
        ]);
    }

    public function warehouse_reporting_performance(Warehouse $warehouse, $type)
    {
        if ($type == 'product') {
            return view('pages.warehouse.reporting.performance.product', [
                'warehouse' => $warehouse
            ]);
        } elseif ($type == 'supplier') {
            return view('pages.warehouse.reporting.performance.supplier', [
                'warehouse' => $warehouse
            ]);
        } elseif ($type == 'customer') {
            return view('pages.warehouse.reporting.performance.customer', [
                'warehouse' => $warehouse
            ]);
        }
    }
}
