@if ($model->status == 'active')
    <span class="badge bg-success d-flex justify-content-center">{{ $model->status }}</span>
@else
    <span class="badge bg-danger d-flex justify-content-center">{{ $model->status }}</span>
@endif