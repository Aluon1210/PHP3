<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => true,
            'message' => 'Danh sách sản phẩm',
            'data' => ProductResource::collection($products),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tenDT' => 'required_without:tenSP',
            'tenSP' => 'required_without:tenDT',
            'gia' => 'required|numeric',
            'idLoai' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ], 400);
        }

        if (isset($input['tenSP']) && ! isset($input['tenDT'])) {
            $input['tenDT'] = $input['tenSP'];
        }

        $product = Product::create($input);
        return response()->json([
            'status' => true,
            'message' => 'Sản phẩm đã lưu thành công',
            'data' => new ProductResource($product),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Chi tiết sản phẩm',
            'data' => new ProductResource($product)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tenDT' => 'required_without:tenSP',
            'tenSP' => 'required_without:tenDT',
            'gia' => 'required|numeric',
            'idLoai' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ], 400);
        }

        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại'
            ], 404);
        }

        if (isset($input['tenSP']) && ! isset($input['tenDT'])) {
            $input['tenDT'] = $input['tenSP'];
        }

        $product->update($input);
        return response()->json([
            'status' => true,
            'message' => 'Sản phẩm cập nhật thành công',
            'data' => new ProductResource($product),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại'
            ], 404);
        }

        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Sản phẩm đã được xóa',
            'data' => [],
        ], 200);
    }
}
