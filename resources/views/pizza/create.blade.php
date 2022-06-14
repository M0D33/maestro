@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="bg-white col p-4 rounded rounded-2 col-md-8">
            <form class="row g-3" method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Authentication</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name', $user->name) }}" />
                                <div id="nameHelp" class="form-text">Your user name</div>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $user->email) }}" />
                                <div id="emailHelp" class="form-text">Email Address</div>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" />
                                <div id="passwordHelp" class="form-text">Password</div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                    name="password_confirmation" />
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <label for="role" class="form-label">User Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="">Select</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                    <option value="customer"
                                        {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>
                                        Customer</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Personal Information</h5>

                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <label for="title" class="form-label">Title</label>
                                <select class="form-select @error('title') is-invalid @enderror" id="title"
                                    name="title">
                                    <option value="">Select</option>
                                    @foreach (['mr', 'mrs', 'miss', 'dr', 'prof', 'etc'] as $title)
                                        <option value="{{ $title }}"
                                            {{ old('title', $user->title) == $title ? 'selected' : '' }}>
                                            {{ ucfirst($title) }}.
                                        </option>
                                    @endforeach
                                </select>
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <div class="row pt-3">
                            <div class="col-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" value="{{ old('first_name', $user->first_name) }}"
                                    class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                    name="first_name" />
                                <div id="Help" class="form-text">User First Name</div>
                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" value="{{ old('last_name', $user->last_name) }}"
                                    class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                    name="last_name" />
                                <div id="Help" class="form-text">User Last Name</div>
                                @error('last_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-6">
                                <label for="gender" class="form-label">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                        name="gender" id="gender-male" value="male"
                                        {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender-male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                        name="gender" id="gender-female" value="female"
                                        {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender-female">
                                        Female
                                    </label>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday"
                                    value="{{ old('birthday', $user->birthday) }}" />
                                <div id="Help" class="form-text"></div>
                            </div>

                            <div class="col mt-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio">{!! old('bio', $user->bio) !!}</textarea>
                                <div id="bioHelp" class="form-text">User Bio</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Address</h5>

                        <div class="row">
                            <div class="col-6">
                                <label for="address_1" class="form-label">Address 1</label>
                                <input type="text" value="{{ old('address_1', $user->address_1) }}"
                                    class="form-control @error('address_1') is-invalid @enderror" id="address_1"
                                    name="address_1" />
                                <div id="Help" class="form-text">Address 1</div>
                                @error('address_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="address_2" class="form-label">Address 2</label>
                                <input type="text" value="{{ old('address_2', $user->address_2) }}"
                                    class="form-control" id="address_2" name="address_2" />
                                <div id="Help" class="form-text">Address 2</div>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" value="{{ old('city', $user->city) }}"
                                    class="form-control @error('city') is-invalid @enderror" id="city" name="city" />
                                <div id="cityHelp" class="form-text">User City</div>
                                @error('city')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="postcode" class="form-label">Post Code</label>
                                <input type="text" value="{{ old('postcode', $user->postcode) }}"
                                    class="form-control @error('postcode') is-invalid @enderror" id="postcode"
                                    name="postcode" />
                                <div id="postcodeHelp" class="form-text">User Post Code</div>
                                @error('postcode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="county" id="county" value="LK">

                        <div class="row pt-3">
                            <div class="col-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" value="{{ old('phone', $user->phone) }}" class="form-control"
                                    id="phone" name="phone" />
                                <div id="phoneHelp" class="form-text"></div>
                            </div>
                            <div class="col-6">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" value="{{ old('mobile', $user->mobile) }}"
                                    class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                                    name="mobile" />
                                <div id="mobileHelp" class="form-text"></div>
                                @error('mobile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
