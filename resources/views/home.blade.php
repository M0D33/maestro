@extends('layouts.app')

@section('content')
<div class="container">

    {{-- <div class="container-1">

          {{-- <div class= "sizes">
            <ul>
                {{-- @foreach ($pizzas->$pizza->$pizzaAddons as $addOn ) --}}

                {{-- @endforeach --}}



      <div class="row">
        @if ($pizzas && $pizzas->count())
        @foreach ($pizzas as $pizza)
                <div class="col-4">
                    <div class="card mx-2 mt-3 border-0">
                        @if ($pizza->image)
                            <img src="{{ asset('storage/' . $pizza->image) }}" class="card-img-top"
                                alt="...">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $pizza->name }}
                            </h4>
                            <p class="card-text">{{ $pizza->summary }}</p>
                            <p class="card-text">Size: {{ $pizza->size }}</p>

                            <h4> Starting from £{{ number_format($pizza->price) }}</h4>

                            @auth
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                @if ($pizza->pizzaAddons)
                                <ul>
                                    @foreach ($pizza->pizzaAddons as $addOn)
                                        <li>
                                            <input type="checkbox" name="pizza_addons[]"
                                                value="{{ $addOn->id }}">
                                            {{ $addOn->name }}
                                            £{{ number_format($addOn->value, 2) }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                                    <input type="hidden" name="pizza_id" value="{{ $pizza->id }}">
                                    <input type="number" name="quantity" value="1" />
                                    <button type="submit" class="btn btn-success btn-md mt-1 pull-right">
                                        Add To Cart
                                    </button>
                                </form>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">
                                    Login to Buy
                                </a>
                            @endguest

                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
