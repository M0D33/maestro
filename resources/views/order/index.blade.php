@extends('layouts.app')

@section('content')
    <div class="container">
     <div class="p-3 bg-light rounded-3">
            <h2>My Orders</h2>
        </div>
        <div class="row">
            <div class="col">
                <table class="table bg-white table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Promotion</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Delivery Method</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->promotion ? $order->promotion->name : '-' }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->delivery_method }}</td>
                                <td>£ {{ number_format($order->discount, 2) }}</td>
                                <td>£ {{ number_format($order->total, 2) }}</td>

                            </tr>
                            <tr>
                                <td colspan="8">
                                    <ul class="list-group mb-3">
                                        @foreach ($order->cart->pizzas as $pizza)
                                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                Name : {{ $pizza->name }}<br>
                                                @if ($pizza->pivot->addons)
                                            @foreach (json_decode($pizza->pivot->addons) as $addons)
                                                  Addons:  {{ \App\Models\PizzaAddon::find($addons)->name }} <br>
                                            @endforeach
                                                @endif
                                                Quantity : {{ $pizza->pivot->quantity }} <br>
                                                Item Price : £{{  number_format($pizza->pivot->total, 2) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                              @if($order->user->role == 'admin')
                             <a href="{{ route('orders.show', $order->id) }}"  class="btn btn-sm btn-success">
                                       View all orders
                              </a>

                    @endif
                        @endforeach


                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
