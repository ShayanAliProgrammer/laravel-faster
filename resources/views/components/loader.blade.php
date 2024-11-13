@props(['wrapper_tag' => 'div'])

<{{ $wrapper_tag }} {{$attributes->merge(['class' => 'grid place-items-center'])}}>
    <x-icon.spinner class="size-6 animate-spin" />
</{{ $wrapper_tag }}>