<div class="d-flex justify-content-center">
    <a href="{{ route('report.monthly.sales.print', \Carbon\Carbon::parse($model->period)->format('F-Y')) }}" class="text-body" target="_blank"><i class="ti ti-printer ti-sm mx-1"></i></a>
</div>