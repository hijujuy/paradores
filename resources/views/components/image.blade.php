@props(['item'=>null,'size'=>50,'float'=>''])

<img 
    src="{{$item->image ? Storage::url('public/'.$item->image->url) : asset('no-image.png')}}" 
    class="rounded {{$float}}" 
    width="{{$size}}"
    height="{{ $size }}"
>