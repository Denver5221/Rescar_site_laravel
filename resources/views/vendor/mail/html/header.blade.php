@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
<img src="{{ asset('front/images/logo.png') }}"  style="height: 36px;" alt="Rescar-aoc">

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
