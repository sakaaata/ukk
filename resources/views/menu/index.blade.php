@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Menu</h1>
    <div class="row">
        @foreach($menu as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                    @else
                        <img src="{{ asset('default-placeholder-image.png') }}" class="card-img-top" alt="Default Image">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Deskripsi:</strong> {{ $item->description }}</p>
                        <form action="{{ route('cart.add', $item->id)}}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
