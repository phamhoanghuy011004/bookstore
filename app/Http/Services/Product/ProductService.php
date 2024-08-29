<?php

namespace App\Http\Services\Product;


use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductService
{
//     Lấy danh sách các danh mục (categories)
    public function getParent()
    {
        return Product::where('id', 0)->get();
    }

    // Tạo mới một sản phẩm
    public function create($request)
    {
        try {
            Product::create([
                'name' => (string)$request->input('name'),
                'author' => (string)$request->input('author'),
                'description' => (string)$request->input('description'),
                'category' => (string)$request->input('category'),
                'content' => (string)$request->input('content'),
                'publish_at' => (int)$request->input('publish_at'),
                'image' => (string)$request->input('image'),
                'amount' => (int)$request->input('amount'),
                'price' => (int)$request->input('price'),
                'status' => (int)$request->input('status'),
            ]);
            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $exception) {
            Log::error('Error creating product: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    // Cập nhật sản phẩm hiện có
    public function update($product, $request) {
        $product->name = (string)$request->input('name');
        $product->author = (string)$request->input('author');
        $product->description = (string)$request->input('description');
        $product->category = (string)$request->input('category');
        $product->content = (string)$request->input('content');
        $product->publish_at = (int)$request->input('publish_at');
        $product->image = $request->input('image') ? (string)$request->input('image') : $product->image;
        $product->amount = (float)$request->input('amount');
        $product->price = (float)$request->input('price');
        $product->status = (int)$request->input('status');

        $product->save();

        Session::flash('success', 'Cập nhật thành công');
        return true;
    }
    public function destroy($request) {
        $id = (int)$request->input('id');
        $product = Product::find($id);
        if ($product) {
            return Product::where('id', $id)->delete();
        }
        return false;
    }


    // Lọc sản phẩm dựa trên các bộ lọc
//    public function getFilteredProducts($filters)
//    {
//        $query = Product::query();
//
//        if (!empty($filters['id'])) {
//            $query->where('id', $filters['id']);
//        }
//
//        if (!empty($filters['name'])) {
//            $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
//        }
//
//        if (!empty($filters['author'])) {
//            $query->where('author', 'LIKE', '%' . $filters['author'] . '%');
//        }
//
//        if (!empty($filters['category'])) {
//            $query->where('category', $filters['category']);
//        }
//
//        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
//            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
//        }
//
//        if (!empty($filters['status'])) {
//            $query->where('status', $filters['status']);
//        }
//
//        return $query->get();
//    }
    public function getFilteredProducts($filters)
    {
        $query = Product::query();

        if ($filters['id']) {
            $query->where('id', $filters['id']);
        }
        if ($filters['name']) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if ($filters['author']) {
            $query->where('author', 'like', '%' . $filters['author'] . '%');
        }
        if ($filters['category']) {
            $query->where('category', 'like', '%' . $filters['category'] . '%');
        }
        if ($filters['publish_at']) {
            $query->where('publish_at', $filters['publish_at']);
        }
        if ($filters['status']) {
            $query->where('status', $filters['status']);
        }
        if ($filters['price_min']) {
            $query->where('price', '>=', $filters['price_min']);
        }
        if ($filters['price_max']) {
            $query->where('price', '<=', $filters['price_max']);
        }

        return $query->get();
    }


}
