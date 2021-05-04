<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use App\Http\Requests\SupplierRequest;

class SupplierController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::paginate(10);

        if ($request->search) {
            $suppliers = Supplier::where('title', 'like', '%'.$request->search.'%')->paginate(10);
        }

        $data = [
            'suppliers' => $suppliers,
            'search' => $request->search,
        ];

        return view ('admin::supplier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin::supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        DB::beginTransaction();
        try {
            Supplier::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            DB::commit();
            return redirect()->route('admin.suppliers.index')->with('alert-success', 'Thêm nhà cung cấp thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Thêm nhà cung cấp thất bại!');
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
        $dataEdit = Supplier::findOrFail($id);

        $data = [
            'dataEdit' => $dataEdit,
        ];

        return view ('admin::supplier.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataEdit = Supplier::findOrFail($id);

        $data = [
            'dataEdit' => $dataEdit,
        ];

        return view ('admin::supplier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            Supplier::findOrFail($id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            DB::commit();
            return redirect()->route('admin.suppliers.index')->with('alert-success', 'Cập nhật nhà cung cấp thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Cập nhật nhà cung cấp thất bại!');
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
        Supplier::destroy($id);

        return redirect()->route('admin.suppliers.index')->with('alert-success', 'Xóa nhà cung cấp thành công!');
    }
}
