<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCode;
use App\Http\Requests\DiscountCodeRequest;
use App\Http\Controllers\Controller;
use Str;

class DiscountCodeController extends AppController
{
    public function index(Request $request) {
        $query = DiscountCode::query();

        if ($request->has('search')) {
            $query = $query->where('code', 'like', '%'.$request->search.'%');
        }

        $discountCodes = $query->paginate(PAGE_LIMIT);

        $viewData = [
            'discount_codes' => $discountCodes,
            'search' => $request->search,
        ];
        return view('admin::discount_code.index', $viewData);
    }

    public function create() {
        return view('admin::discount_code.create');
    }

    public function store(DiscountCodeRequest $request) {
        $params = $request->all();
        DiscountCode::create($params);

        return redirect()->route('admin.discount_code.index')
            ->with('alert-success', 'Thêm mã giảm giá thành công!');
    }

    public function edit($id) {
        $discountCode = DiscountCode::findOrFail($id);

        $viewData = [
            'dataEdit' => $discountCode
        ];
        return view('admin::discount_code.edit', $viewData);
    }

    public function update(DiscountCodeRequest $request, $id) {
        $params = $request->all();
        $discountCode = DiscountCode::findOrFail($id);
        $discountCode->update($params);

        return redirect()->route('admin.discount_code.index')
            ->with('alert-success', 'Cập nhật mã giảm giá thành công!');
    }

    public function delete($id) {
        $discountCode = DiscountCode::findOrFail($id);
        $discountCode->delete();

        return redirect()->back()->with('alert-success', 'Xóa mã giảm giá thành công!');
    }

    public function randomCode() {
        $data = Str::random(8);

        return response()->json([
            'code' => 200,
            'message' => 'Random success',
            'data' => $data
        ]);
    }
}
