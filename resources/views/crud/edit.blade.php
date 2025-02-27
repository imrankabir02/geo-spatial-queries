@extends('layouts.app')

@section('content')

    <h1>Edit</h1>
    <p>This is the edit page</p>

    <form action="{{ route('crud.update', $crud->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $crud->name }}" required>
        <br>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="{{ $crud->description }}">
        <br>
        <label for="price">Price</label>
        <input type="number" name="price" id="price" value="{{ $crud->price }}" required>
        <br>
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" value="{{ $crud->quantity }}" required>
        <br>
        <button type="submit">Update</button>
    </form>

    <a href="{{ route('crud.index') }}">Back</a>

@endsection
