<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::paginate(PAGE_LIMIT);

        if ($request->search) {
            $categories = Category::where('title', 'like', '%'.$request->search.'%')->paginate(PAGE_LIMIT);
        }

        $data = [
            'categories' => $categories,
            'search' => $request->search,
        ];

        return view ('admin::category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            Category::create([
                'title' => $request->title,
                'slug' => $request->slug,
            ]);

            DB::commit();
            return redirect()->route('admin.categories.index')->with('alert-success', 'Thêm danh mục thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Thêm danh mục thất bại!');
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
        $dataEdit = Category::findOrFail($id);

        $data = [
            'dataEdit' => $dataEdit,
        ];

        return view ('admin::category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            Category::findOrFail($id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
            ]);

            DB::commit();
            return redirect()->route('admin.categories.index')->with('alert-success', 'Cập nhật danh mục thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Cập nhật danh mục thất bại!');
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
        Category::destroy($id);

        return redirect()->route('admin.categories.index')->with('alert-success', 'Xóa danh mục thành công!');
    }
}
