@extends('layouts.app')

@section('content')

    <h1>Create</h1>
    <p>This is the create page</p>

    <form action="{{ route('crud.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="description">Description</label>
        <input type="text" name="description" id="description">
        <br>
        <label for="price">Price</label>
        <input type="number" name="price" id="price" required>
        <br>
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" required>
        <br>
        <button type="submit">Create</button>
    </form>

    <a href="{{ route('crud.index') }}">Back</a>

@endsection
