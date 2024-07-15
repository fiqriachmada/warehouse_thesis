<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Repositories\InboundRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OutboundRepository;

class WarehouseController extends Controller
{
    protected $outboundRepository, $inboundRepository, $customerRepository;

    public function __construct(OutboundRepository $outboundRepository, InboundRepository $inboundRepository, CustomerRepository $customerRepository)
    {
        $this->outboundRepository = $outboundRepository;
        $this->inboundRepository = $inboundRepository;
        $this->customerRepository = $customerRepository;
    }

    public function warehouse_index(Warehouse $warehouse)
    {
        return view('pages.warehouse.dashboard.index', [
            'warehouse' => $warehouse,
            'outbounds_year' => $this->outboundRepository->getAllOutboundsGroupByPeriodically('year', $warehouse),
            'outbounds_month' => $this->outboundRepository->getAllOutboundsGroupByPeriodically('month', $warehouse),
            'total_inbound_price_month' => $this->inboundRepository->getAllInboundsGroupByPeriodically('month', $warehouse),
            'total_outbound_amount_month' => $this->outboundRepository->getAllOutboundsGroupByPeriodically('month', $warehouse),
            'total_customer_amount_month' => $this->customerRepository->getAllCustomersGroupByPeriodically('month', $warehouse),
        ]);
    }
}
