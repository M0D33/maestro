@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="bg-white col p-4 rounded rounded-2 col-md-8">
                <form class="row g-3" method="POST" action="{{ route('orders.update', $order->id) }}"
                    enctype="multipart/form-data">

                    @method('PUT')
                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Details for Order #{{$order->id}}</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name', $order->user->name) }}" />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="promotion" class="form-label">Promotion</label>
                                    <input type="promotion" class="form-control @error('promotion') is-invalid @enderror" id="promotion"
                                        name="promotion" value="{{ old('promotion', $order->promotion ? $order->promotion->name : '-') }}" />
                                    @error('promotion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Order status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="">Select</option>
                                        @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                            <option value="{{ $status }}"
                                                {{ old('status', $order->status) == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="payment_status" class="form-label">Payment status</label>
                                    <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status"
                                        name="payment_status">
                                        <option value="">Select</option>
                                        @foreach (['pending', 'paid', 'failed'] as $payment_status)
                                            <option value="{{ $payment_status }}"
                                                {{ old('payment_status', $order->payment_status) == $payment_status ? 'selected' : '' }}>
                                                {{ ucfirst($payment_status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('payment_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                 <div class="col-md-6">
                                    <label for="price" class="form-label">Order Discount</label>
                                    <input type="number"
                                        class="form-control @error('discount') is-invalid @enderror" id="discount"
                                        name="discount" value="{{ old('discount', $order->discount) }}" />
                                    @error('discount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                 <div class="col-md-6">
                                    <label for="total" class="form-label">Order Total </label>
                                    <input type="number"
                                        class="form-control @error('total') is-invalid @enderror" id="total"
                                        name="total" value="{{ old('total', $order->total) }}" />
                                    @error('total')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                </form>

                <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                    id="delete-{{ $order->id }}-order" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger"
                        onclick="confirm('Are you sure you want to delete the Order {{ $order->id }} ?') ? document.getElementById('delete-{{ $order->id }}-order').submit() : null">
                        Delete
                    </button>
                </form>
            </div>

            </div>
        </div>
    </div>
@endsection
