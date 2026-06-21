@props(['played' => 13, 'total' => 24, 'gap' => '2px', 'height' => '22px'])

<div class="flex items-center gap-[{{ $gap }}] h-[{{ $height }}]">
    @for ($i = 0; $i < $total; $i++)
        @php $h = [38, 58, 66, 42, 90, 72, 54, 82, 78, 44, 62, 96, 50, 60, 34, 76, 48, 72, 40, 84, 56, 68, 44, 36][$i % 24]; @endphp
        <span class="flex-1 h-[{{ $h }}%] {{ $i < $played ? 'bg-accent' : 'bg-accent-border' }} rounded-sm"></span>
    @endfor
</div>
