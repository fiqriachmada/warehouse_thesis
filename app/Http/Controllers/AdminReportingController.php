<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class AdminReportingController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function report_daily_sales()
    {
        return view('pages.admin.reporting.sales.daily.index');
    }

    public function report_daily_sales_print($date)
    {
        return view('pages.admin.reporting.sales.daily.print', [
            'transactions' => $this->transactionRepository->getTransactionByDay($date)
        ]);
    }

    public function report_monthly_sales()
    {
        return view('pages.admin.reporting.sales.monthly.index');
    }

    public function report_monthly_sales_print($month)
    {
        return view('pages.admin.reporting.sales.monthly.print', [
            'transactions' => $this->transactionRepository->getTransactionByMonth($month)
        ]);
    }

    public function report_yearly_sales()
    {
        return view('pages.admin.reporting.sales.yearly.index');
    }

    public function report_yearly_sales_print($year)
    {
        return view('pages.admin.reporting.sales.yearly.print', [
            'transactions' => $this->transactionRepository->getTransactionByYear($year)
        ]);
    }

    public function report_taxes_index()
    {
        return view('pages.admin.reporting.taxes.index');
    }
}
