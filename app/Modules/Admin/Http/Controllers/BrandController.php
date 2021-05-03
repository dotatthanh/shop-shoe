<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::paginate(10);

        if ($request->search) {
            $brands = Brand::where('title', 'like', '%'.$request->search.'%')->paginate(10);
        }

        $data = [
            'brands' => $brands,
            'search' => $request->search,
        ];

        return view ('admin::brand.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin::brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Brand::create([
                'title' => $request->title,
                'slug' => $request->slug,
            ]);

            DB::commit();
            return redirect()->route('admin.brands.index')->with('alert-success', 'Thêm thương hiệu thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Thêm thương hiệu thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataEdit = Brand::findOrFail($id);

        $data = [
            'dataEdit' => $dataEdit,
        ];

        return view ('admin::brand.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            Brand::findOrFail($id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
            ]);

            DB::commit();
            return redirect()->route('admin.brands.index')->with('alert-success', 'Cập nhật thương hiệu thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Cập nhật thương hiệu thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::destroy($id);

        return redirect()->route('admin.brands.index')->with('alert-success', 'Xóa thương hiệu thành công!');
    }
}
