<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use DB;
use Validator;

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
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|size:10|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
        ];

        $messages = [
            'title.string' => 'Tên nhà cung cấp không được chứa các ký tự đặc biệt.',
            'title.max' => 'Tên nhà cung cấp không được phép quá 255 ký tự.',
            'title.required' => 'Tên nhà cung cấp là trường bắt buộc.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'address.max' => 'Địa chỉ không được phép quá 255 ký tự.',
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'phone.size' => 'Số điện thoại phải có 10 số.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.string' => 'Email không được chứa các ký tự đặc biệt.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.max' => 'Email không được phép quá 255 ký tự.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|size:10|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
        ];

        $messages = [
            'title.string' => 'Tên nhà cung cấp không được chứa các ký tự đặc biệt.',
            'title.max' => 'Tên nhà cung cấp không được phép quá 255 ký tự.',
            'title.required' => 'Tên nhà cung cấp là trường bắt buộc.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'address.max' => 'Địa chỉ không được phép quá 255 ký tự.',
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'phone.size' => 'Số điện thoại phải có 10 số.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.string' => 'Email không được chứa các ký tự đặc biệt.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.max' => 'Email không được phép quá 255 ký tự.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
