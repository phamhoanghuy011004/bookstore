<?php

namespace App\Http\Services\Menu;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductService
{
    public function getParent()
    {
        return Product::where('parent_id', 0)->get();
    }

    public function getAll(){
        return Product::orderbyDesc('id')->paginate(10);
    }

    public function create($request)
    {
        try {
            Product::create([
                'name' => $request->input('name'),
                'author' => $request->input('name'),
                'parent_id' => $request->input('parent_id'),
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'publish_at' => $request->input('publish_at'),
                'content' => $request->input('content'),
                'image' => $request->input('image'),
                'amount' => $request->input('amount'),
                'price' => $request->input('price'),
                'status' => $request->input('status'),
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }
    public function update($product, $request){
        $product->name = (string)$request->input('name');

        if ($request->input('parent_id') != $product->id) {
            $product->parent_id = $request->input('parent_id');
        }
        $product->category = $request->input('description');
        $product->description = $request->input('description');
        $product->content = $request->input('content');
        $product->image = $request->input('image');
        $product->amount = $request->input('amount');
        $product->price = $request->input('price');
        $product->status = $request->input('status');
        $product->save();

        Session::flash('success', 'Cap nhat thanh cong');
        return true;
    }
    public function destroy($request){
        $id = (int)$request->input('id');
        $menu = Product::where('id',$id)->first();
        if ($menu){
            return Product::where('id',$id)->orWhere('parent_id',$id)->delete();
        }
        return false;
    }


    public function getFilteredMenus($filters)
    {
        $query = Product::query();

        if ($filters['id']) {
            $query->where('id', $filters['id']);
        }

        if ($filters['start_date'] && $filters['end_date']) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
        }

        if ($filters['status']) {
            $query->where('status', $filters['status']);
        }

        return $query->get();
    }

}
