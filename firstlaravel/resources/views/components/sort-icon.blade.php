@props(['sortBy', 'sortDirection','col'])

@php
    $icon = '<i class="fas fa-sort"></i>';

    if (isset($sortBy) && $sortBy == $col) {
        $icon = ($sortDirection == 'asc') ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
    }
@endphp

{!! $icon !!}
