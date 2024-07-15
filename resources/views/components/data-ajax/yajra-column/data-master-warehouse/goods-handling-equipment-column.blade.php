<span class="text-capitalize">
    <ul class="ps-3">
        @if (!is_null($model->goods_handling_equipment))
        @foreach (json_decode($model->goods_handling_equipment, true) as $key => $item)
            <li>{{ $item['value'] }}</li>
        @endforeach
        @endif
    </ul>
</span>