<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status' => true,
            'message' => 'Danh sách loại sản phẩm',
            'data' => CategoryResource::collection($categories),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tenLoai' => 'required',
            'thuTu' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ], 400);
        }

        $category = Category::create($input);
        return response()->json([
            'status' => true,
            'message' => 'Loại sản phẩm đã được tạo thành công',
            'data' => new CategoryResource($category),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json([
                'status' => false,
                'message' => 'Loại sản phẩm không tồn tại'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Chi tiết loại sản phẩm',
            'data' => new CategoryResource($category),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tenLoai' => 'required',
            'thuTu' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ], 400);
        }

        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json([
                'status' => false,
                'message' => 'Loại sản phẩm không tồn tại'
            ], 404);
        }

        $category->update($input);
        return response()->json([
            'status' => true,
            'message' => 'Loại sản phẩm đã được cập nhật thành công',
            'data' => new CategoryResource($category),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json([
                'status' => false,
                'message' => 'Loại sản phẩm không tồn tại'
            ], 404);
        }

        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'Loại sản phẩm đã được xóa',
            'data' => [],
        ], 200);
    }
}
