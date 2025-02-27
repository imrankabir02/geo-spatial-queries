@extends('layouts.app')

@section('content')

    <h1>CRUD</h1>
    <p>This is the CRUD page</p>

    <a href="{{ route('crud.create') }}">Create</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cruds as $crud)
                <tr>
                    <td>{{ $crud->id }}</td>
                    <td>{{ $crud->name }}</td>
                    <td>{{ $crud->description }}</td>
                    <td>{{ $crud->price }}</td>
                    <td>{{ $crud->quantity }}</td>
                    <td>{{ $crud->price * $crud->quantity }}</td>
                    <td>
                        <a href="{{ route('crud.show', $crud->id) }}">Show</a>
                        <a href="{{ route('crud.edit', $crud->id) }}">Edit</a>
                        <form action="{{ route('crud.destroy', $crud->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            Total: {{ $cruds->sum(function($crud) {
                return $crud->price * $crud->quantity;
            }) }}
        </tbody>
    </table>

    {{-- {{ $cruds->links() }} --}}

@endsection
