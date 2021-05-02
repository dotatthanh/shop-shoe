<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index() {
        return view('admin::product.index');
    }

    public function create() {
        return view('admin::product.create');
    }

    public function store(Request $request) {
        $params = $request->all();
        dd($params);
    }

    public function edit() {
        return view('admin::product.edit');
    }

    public function update(Request $request, $id) {
        $params = $request->all();
        dd($params);
    }
}
