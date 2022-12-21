@extends('admin.layouts.app')

@section('content')

<div class="col-8 offset-2 mt-5">
    <a href="{{ route('admin#trendPost') }}" class=" text-decoration-none text-dark mb-3">
        <p class=" fs-2  fw-bolder"><i class="fa-solid fa-arrow-left"></i></p>
    </a>
    <div class="card">
        <div class="row p-3">
            <div class="col-4 border rounded border-dark">
                @if ($post->image == null)
                <img src="{{ asset('default_image/default-image.jpg') }}" alt="" width="100%">
                @else
                <img src="{{ asset('postImage/'.$post->image) }}" alt="" width="100%">
                @endif
            </div>
            <div class="col">
                <div class="">
                    <h4 class=" border-bottom p-2 border-dark text-center">{{ $post->title }}</h4>
                    <p class=" p-2">{{ $post->description }}</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
