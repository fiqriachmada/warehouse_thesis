@if ($model->admin->status == 'active')
    <span class="badge bg-success d-flex justify-content-center">{{ $model->admin->status }}</span>
@else
    <span class="badge bg-danger d-flex justify-content-center">{{ $model->admin->status }}</span>
@endif