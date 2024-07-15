@if ($model->status == 'active')
    <span class="badge bg-label-success">Active</span>
@else
    <span class="badge bg-label-danger">Inactive</span>
@endif