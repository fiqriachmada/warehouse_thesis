<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Outbound;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class OutboundRepository
{
    public function getAllOutbound()
    {
        return Outbound::all();
    }

    public function getOutbound($id)
    {
        return Outbound::find($id);
    }

    public function getAllOutboundByWarehouseIdAndTenantId($warehouse_id)
    {
        return Outbound::where('warehouse_id', $warehouse_id)->where('tenant_id', auth()->user()->tenant->id)->get();
    }

    public function getAllOutboundsGroupByPeriodically($periodic, $warehouse)
    {
        $groupByClause = '';

        switch ($periodic) {
            case 'day':
                $groupByClause = DB::raw('DATE(outbounds.created_at) as period');
                break;
            case 'month':
                $groupByClause = DB::raw('DATE_FORMAT(outbounds.created_at, "%Y-%m") as period');
                break;
            case 'year':
                $groupByClause = DB::raw('YEAR(outbounds.created_at) as period');
                break;
            default:
                break;
        }

        return Outbound::select('warehouse_id', DB::raw('SUM(amount_total) as amount_total'), DB::raw('SUM(grand_total) as grand_total'),$groupByClause)
            ->where('warehouse_id', $warehouse->id)
            ->where('tenant_id', auth()->user()->tenant->id)
            ->groupBy('period', 'warehouse_id')
            ->get();
    }

    public function getAllOutboundsGroupByTenantPeriodically($periodic)
    {
        $groupByClause = '';

        switch ($periodic) {
            case 'day':
                $groupByClause = DB::raw('DATE(outbounds.created_at) as period');
                break;
            case 'month':
                $groupByClause = DB::raw('DATE_FORMAT(outbounds.created_at, "%Y-%m") as period');
                break;
            case 'year':
                $groupByClause = DB::raw('YEAR(outbounds.created_at) as period');
                break;
            default:
                break;
        }

        return Outbound::select(DB::raw('SUM(amount_total) as amount_total'), DB::raw('SUM(grand_total) as grand_total'),$groupByClause)
            ->where('tenant_id', auth()->user()->tenant->id)
            ->groupBy('period')
            ->get();
    }

    public function getOutboundByDay($day, $warehouse)
    {
        $timestamp = strtotime($day);

        return Outbound::join('detail_outbounds', 'outbounds.id', '=', 'detail_outbounds.outbound_id')
                        ->join('products', 'detail_outbounds.product_id', '=', 'products.id')
                        ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                        ->join('racks', 'products.rack_id', '=', 'racks.id')
                        ->select('products.*', 'product_categories.name as category_name', 'detail_outbounds.*', 'outbounds.*', 'racks.name as rack_name')
                        ->whereDate('outbounds.created_at', '=', date('Y-m-d', $timestamp))
                        ->where('outbounds.warehouse_id', $warehouse->id)
                        ->where('outbounds.tenant_id', auth()->user()->tenant->id)
                        ->get();
    }

    public function getOutboundByMonth($month, $warehouse)
    {
        $timestamp = Carbon::createFromFormat('F-Y', $month)->startOfMonth();

        return Outbound::join('detail_outbounds', 'outbounds.id', '=', 'detail_outbounds.outbound_id')
                        ->join('products', 'detail_outbounds.product_id', '=', 'products.id')
                        ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                        ->join('racks', 'products.rack_id', '=', 'racks.id')
                        ->select('products.*', 'product_categories.name as category_name', 'detail_outbounds.*', 'outbounds.*', 'racks.name as rack_name')
                        ->whereBetween('outbounds.created_at', [$timestamp->format('Y-m-d H:i:s'), $timestamp->endOfMonth()->format('Y-m-d H:i:s')])
                        ->where('outbounds.warehouse_id', $warehouse->id)
                        ->where('outbounds.tenant_id', auth()->user()->tenant->id)
                        ->get();
    }

    public function getOutboundByYear($year, $warehouse)
    {
        return Outbound::join('detail_outbounds', 'outbounds.id', '=', 'detail_outbounds.outbound_id')
                        ->join('products', 'detail_outbounds.product_id', '=', 'products.id')
                        ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                        ->join('racks', 'products.rack_id', '=', 'racks.id')
                        ->select('products.*', 'product_categories.name as category_name', 'detail_outbounds.*', 'outbounds.*', 'racks.name as rack_name')
                        ->whereYear('outbounds.created_at', $year)
                        ->where('outbounds.warehouse_id', $warehouse->id)
                        ->where('outbounds.tenant_id', auth()->user()->tenant->id)
                        ->get();
    }
}