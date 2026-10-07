@props(['placeholder'=>'','size'=>'small','class','name'])
@php

    if ($size=='small')
    {
        $class='w-[200px] h-10 bg-black/10 px-2 py-2 rounded-lg text-sm no-focus outline-0 ';
    }
    else
    {
        $class='w-lg h-10 bg-black/10 px-2 py-2 rounded-lg';
    }
@endphp
<input type="text" placeholder="{{ $placeholder }}" class="{{ $class }}" />