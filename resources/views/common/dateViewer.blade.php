@php
    use Carbon\Carbon;

    $format = $format ?? 'd-m-Y'; // Default format
@endphp

{{ !empty($date) ? Carbon::parse($date)->format($format) : '-' }}
