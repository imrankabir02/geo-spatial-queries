@extends('layouts.app')

@section('content')

    <h1>Show</h1>
    <p>This is the show page</p>

    <p>ID: {{ $crud->id }}</p>
    <p>Name: {{ $crud->name }}</p>
    <p>Description: {{ $crud->description }}</p>
    <p>Price: {{ $crud->price }}</p>
    <p>Quantity: {{ $crud->quantity }}</p>
    <p>Total: {{ $crud->price * $crud->quantity }}</p>

    <a href="{{ route('crud.index') }}">Back</a>

@endsection
