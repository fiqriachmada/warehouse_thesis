<div class="d-flex justify-content-center">
    <a href="{{ route('reporting.periodic.warehouse.monthly.sales.print', ['date' => \Carbon\Carbon::parse($model->period)->format('F-Y'), 'warehouse' => $model->warehouse_id]) }}" class="text-body" target="_blank"><i class="ti ti-printer ti-sm mx-1"></i></a>
</div>