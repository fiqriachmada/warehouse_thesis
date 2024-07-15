<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Repositories\OutboundRepository;

class TenantReportingController extends Controller
{
    protected $outboundRepository;

    public function __construct(OutboundRepository $outboundRepository)
    {
        $this->outboundRepository = $outboundRepository;
    }

    public function reporting_periodic_sales(Warehouse $warehouse, $period) 
    {
        if ($period == 'daily') {
            return view('pages.tenant.reporting.sales.daily', compact('warehouse', 'period'));
        } else if ($period == 'monthly') {
            return view('pages.tenant.reporting.sales.monthly', compact('warehouse', 'period'));
        } else if ($period == 'yearly') {
            return view('pages.tenant.reporting.sales.yearly', compact('warehouse', 'period'));
        }
    }

    public function reporting_daily_sales_print(Warehouse $warehouse, $date)
    {
        return view('pages.tenant.reporting.sales.print-daily', [
            'outbounds' => $this->outboundRepository->getOutboundByDay($date, $warehouse)
        ]);
    }

    public function reporting_monthly_sales_print(Warehouse $warehouse, $date)
    {
        return view('pages.tenant.reporting.sales.print-monthly', [
            'outbounds' => $this->outboundRepository->getOutboundByMonth($date, $warehouse)
        ]);
    }

    public function reporting_yearly_sales_print(Warehouse $warehouse, $date)
    {
        return view('pages.tenant.reporting.sales.print-yearly', [
            'outbounds' => $this->outboundRepository->getOutboundByYear($date, $warehouse)
        ]);
    }

    public function reporting_performance(Warehouse $warehouse, $type)
    {
        if ($type == 'product') {
            return view('pages.tenant.reporting.performance.product', compact('warehouse'));
        } elseif ($type == 'supplier') {
            return view('pages.tenant.reporting.performance.supplier', compact('warehouse'));
        } elseif ($type == 'customer') {
            return view('pages.tenant.reporting.performance.customer', compact('warehouse'));
        }
    }

    public function reporting_history(Warehouse $warehouse, $type)
    {
        if ($type == 'rent') {
            return view('pages.tenant.reporting.history.rent', compact('warehouse'));
        }
    }
}
