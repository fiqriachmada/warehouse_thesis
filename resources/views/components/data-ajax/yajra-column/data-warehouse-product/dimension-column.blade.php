@if (!empty($model->length))
    @convertCmToM($model->length)
@endif

@if (!empty($model->width))
    x @convertCmToM($model->width)
@endif 

@if (!empty($model->height))
    x @convertCmToM($model->height)
@endif