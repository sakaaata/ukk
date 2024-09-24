@extends('layouts.app')

@section('content')
<div class="container">
    <h1>daftar menu</h1>
    <div class="row">
        @foreach($menu as $item)
            <div class="col-md-4">
                <div class="card">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" class="card-img-top" width="150">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">Harga : {{ $item->price }} </p>
                        <p class="card-text">Deskripsi : {{ $item->description }} </p>
                        <form action="{{ route('cart.add', $item->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection