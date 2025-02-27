<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCrudRequest;
use App\Http\Requests\UpdateCrudRequest;
use App\Models\Crud;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('crud.index', [
            'cruds' => Crud::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCrudRequest $request)
    {
        Crud::create($request->validated());

        return redirect()->route('crud.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Crud $crud)
    {
        return view('crud.show', [
            'crud' => $crud
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crud $crud)
    {
        return view('crud.edit', [
            'crud' => $crud
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCrudRequest $request, Crud $crud)
    {
        $crud->update($request->validated());

        return redirect()->route('crud.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crud $crud)
    {
        $crud->delete();

        return redirect()->route('crud.index');
    }
}
