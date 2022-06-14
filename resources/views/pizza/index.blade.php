@extends('layouts.app')

@section('content')
<div class="container">
<h2> Mestro Pizza List </h2>
<div class ="row">
<div class ="row">
    <div class="col">
        <a href="{{ route('pizza.create') }}" class="btn btn-primary mt-4 mb-4">
            Add Pizza
        </a>
    </div>
</div>

<div class ="col">
<table class="table bg-white table-striped">
    <thead>
      <tr>
        <th scope="col">Pizza ID</th>
        <th scope="col">Pizza Name</th>
        <th scope="col">Pizza Summary</th>
        <th scope="col">Pizza Size</th>
        <th scope="col">Pizza Description</th>
        <th scope="col">Pizza Image</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($pizzas as $pizza)
        <tr>
            <th scope="row">{{ $pizza->id }}</th>
            <td>{{ $pizza->name }}</td>
            <td>{{ $pizza->summary }}</td>
            <td>{{ $pizza->size }}</td>
            <td>{{ $pizza->description }}</td>
            <td>{{ $pizza->image }}</td>
            <td>{{ $pizza->is_active ? 'Published' : 'Not Published' }}</td>
            <td>
                <a href="{{ route('pizza.show', $pizza->id) }}" class="btn btn-sm btn-success">View</a>
                <a href="{{ route('pizza.edit', $pizza->id) }}" class="btn btn-sm btn-primary">Edit</a>


            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  {{ $pizzas->links() }}
</div>
</div>
</div>
@endsection
