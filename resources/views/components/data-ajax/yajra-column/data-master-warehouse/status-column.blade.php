@if ($model->status == 'available')
    <span class="badge bg-success d-flex justify-content-center">{{ $model->status }}</span>
@elseif ($model->status == 'rented')
    <span class="badge bg-warning d-flex justify-content-center">{{ $model->status }}</span>
@elseif ($model->status == 'maintenance')
    <span class="badge bg-info d-flex justify-content-center">{{ $model->status }}</span>
@elseif ($model->status == 'damaged')
    <span class="badge bg-danger d-flex justify-content-center">{{ $model->status }}</span>
@elseif ($model->status == 'unavailable')
    <span class="badge bg-secondary d-flex justify-content-center">{{ $model->status }}</span>
@endif