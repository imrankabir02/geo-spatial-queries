<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud;

class TestController extends Controller
{
    public function test()
    {
        $items = Crud::select('id','name', 'price')
            ->where('price', '>=', 10)
            ->get();
        return response([
            'message' => 'success',
            'data' => $items,
        ]);
    }
}
