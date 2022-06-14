@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="bg-white col p-4 rounded rounded-2 col-md-8">
                <form class="row g-3" method="POST" action="{{ route('pizza.update', $pizza->id) }}"
                    enctype="multipart/form-data">

                    @method('PUT')
                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pizza Details</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name', $pizza->name) }}" />
                                    <div id="nameHelp" class="form-text">Your user name</div>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="summary" class="form-label">Summary</label>
                                    <input type="summary" class="form-control @error('summary') is-invalid @enderror" id="summary"
                                        name="summary" value="{{ old('summary', $pizza->summary) }}" />
                                    <div id="summaryHelp" class="form-text">Summary</div>
                                    @error('summary')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="size" class="form-label">Pizza Size</label>
                                    <select class="form-select @error('size') is-invalid @enderror" id="size"
                                        name="size">
                                        <option value="">Select</option>
                                        @foreach (['small','medium','large'] as $size)
                                            <option value="{{ $size }}"
                                                {{ old('size', $pizza->size) == $size ? 'selected' : '' }}>
                                                {{ ucfirst($size) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('size')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price of Pizza</label>
                                    <input type="number"
                                        class="form-control @error('price') is-invalid @enderror" id="price"
                                        name="price" value="{{ old('price', $pizza->price) }}" />
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-3">
                                        <label for="image" class="form-label">Pizza Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="col mt-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description">{!! old('description', $pizza->description) !!}</textarea>
                                    <div id="descriptionHelp" class="form-text">Pizza description</div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                </form>

                <form action="{{ route('pizza.destroy', $pizza->id) }}" method="POST"
                    id="delete-{{ $pizza->id }}-pizza" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger"
                        onclick="confirm('Are you sure you want to delete the Pizza {{ $pizza->name }} ?') ? document.getElementById('delete-{{ $pizza->id }}-pizza').submit() : null">
                        Delete
                    </button>
                </form>
            </div>

            </div>
        </div>
    </div>
@endsection
