@extends('layouts.app')

@section('content')
    <div class="container">

            <div class="row">
                <div class="col">
                    <a href="{{ route('pizza.index') }}" class="btn btn-primary mt-4 mb-4">
                        Back
                    </a>
                </div>
            </div>

        <div class="row">
            <div class="bg-white col p-4 rounded rounded-2 col-md-8">
                <div class="card">
                    @if ($pizza->image)
                        <img src="{{ asset('storage/' . $pizza->image) }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $pizza->name }}
                        </h5>
                        <p class="card-text">{{ $pizza->summary }}</p>
                        <p class="card-text">{{ $pizza->size }}</p>


                        {{-- <p class="card-text">{{ $pizza->description }}</p> --}}

                        <h4>£{{ number_format($pizza->price, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
