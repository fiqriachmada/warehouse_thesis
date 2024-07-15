@php
    $endedAt = \Carbon\Carbon::parse($model->ended_at);
    $differenceInDays = $endedAt->diffInDays(\Carbon\Carbon::now());
@endphp

{{ $differenceInDays }} Days