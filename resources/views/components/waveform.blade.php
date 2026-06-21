@props(['played' => 13, 'total' => 24, 'gap' => 'gap-[2px]', 'height' => 'h-[22px]'])

@php
    $heights = ['h-[38%]', 'h-[58%]', 'h-[66%]', 'h-[42%]', 'h-[90%]', 'h-[72%]', 'h-[54%]', 'h-[82%]', 'h-[78%]', 'h-[44%]', 'h-[62%]', 'h-[96%]', 'h-[50%]', 'h-[60%]', 'h-[34%]', 'h-[76%]', 'h-[48%]', 'h-[72%]', 'h-[40%]', 'h-[84%]', 'h-[56%]', 'h-[68%]', 'h-[44%]', 'h-[36%]'];
@endphp

<div class="flex items-center {{ $gap }} {{ $height }}">
    @for ($i = 0; $i < $total; $i++)
        <span class="flex-1 {{ $heights[$i % 24] }} {{ $i < $played ? 'bg-accent' : 'bg-accent-border' }} rounded-sm"></span>
    @endfor
</div>
