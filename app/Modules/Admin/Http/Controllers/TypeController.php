<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Http\Controllers\Controller;
use DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types = Type::paginate(10);

        if ($request->search) {
            $types = Type::where('title', 'like', '%'.$request->search.'%')->paginate(10);
        }

        $data = [
            'types' => $types,
            'search' => $request->search,
        ];

        return view ('admin::type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin::type.create');
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
            Type::create([
                'title' => $request->title,
                'slug' => $request->slug,
            ]);

            DB::commit();
            return redirect()->route('admin.types.index')->with('alert-success', 'Thêm loại giầy thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Thêm loại giầy thất bại!');
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
        $dataEdit = Type::findOrFail($id);

        $data = [
            'dataEdit' => $dataEdit,
        ];

        return view ('admin::type.edit', $data);
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
            Type::findOrFail($id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
            ]);

            DB::commit();
            return redirect()->route('admin.types.index')->with('alert-success', 'Cập nhật loại giầy thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Cập nhật loại giầy thất bại!');
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
        Type::destroy($id);

        return redirect()->route('admin.types.index')->with('alert-success', 'Xóa loại giầy thành công!');
    }
}
