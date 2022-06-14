@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{ route('users.index') }}" class="btn btn-primary mt-4 mb-4">
                    Back
                </a>
            </div>
        </div>
        <div class="row">
            <div class="bg-white col p-4 rounded rounded-2 col-md-8">
                <div class="card">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $user->name }}
                            <small class="float-end text-info">{{ $user->email }} | {{ $user->role }}</small>
                        </h5>
                        <p class="card-text">{{ $user->bio }}</p>

                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="" style="width: 100px">
                        @endif

                        <h5 class="mt-4">Personal Information</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Title : {{ ucfirst($user->title) }}</li>
                            <li class="list-group-item">First Name : {{ $user->first_name }}</li>
                            <li class="list-group-item">Last Name : {{ $user->last_name }}</li>
                            <li class="list-group-item">Gender : {{ ucfirst($user->gender) }}</li>
                            <li class="list-group-item">Birhtday : {{ $user->birthday }}</li>
                        </ul>

                        <h5 class="mt-4">Address</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Addres 1 : {{ $user->address_1 }}</li>
                            <li class="list-group-item">Addres 2 : {{ $user->address_2 }}</li>
                            <li class="list-group-item">City : {{ $user->city }}</li>
                            <li class="list-group-item">ZIP : {{ $user->postcode }}</li>
                            <li class="list-group-item">Country : {{ $user->county }}</li>
                            <li class="list-group-item">Phone : {{ $user->phone }}</li>
                            <li class="list-group-item">Mobile : {{ $user->mobile }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
