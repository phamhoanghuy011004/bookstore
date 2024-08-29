<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Services\Menu\ProductService;
class MenuController
{
    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService  = $productService;
    }
    public function create(){
        return view('admin.menu.add',[
            'title' => 'Them danh muc moi',
            'menus' => $this->productService ->getParent()
        ]);
    }

    // Lưu chi tiết mới
    public function store(CreateFormRequest $request){
        $result = $this->productService ->create($request);
        return redirect()->back();
    }

    public function index(){
        $list = Product::paginate(10);
        return view('admin.menu.list',[
            'title' => 'Danh sach muc moi nhat',
            'list'=>Product::paginate(10)
        ]);
    }

    // Hiển thị chi tiết
    public function show(Product $product){
        return view('admin.menu.edit',[
            'title' => 'Chinh sua danh muc' . $product->name,
            'menu' => $product,
            'menus' => $this->productService ->getParent()
        ]);
    }

    // Update
    public function update (Product $product, CreateFormRequest $request){
         $this->productService ->update($product, $request);
         return redirect('admin/menus/list')->with('success','Update successfully');
    }


    // Delete
    public function destroy($id){
        try {
            Product::where('id', $id)->delete();
            return redirect('/admin/menus/list')->with('success','Delete successfully');
        } catch (\Exception $exception) {
            return redirect('/admin/menus/list')->with('error', $exception->getMessage());
        }
    }

    // Search
    public function search(Request $request)
    {
        $filters = [
            'id' => $request->input('id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'active' => $request->input('active'),
        ];

        $hasFilters = $this->hasFilters($filters);

        if ($hasFilters) {
            $products = $this->productService ->getFilteredMenus($filters);
        } else {
            $products = [];
        }

        return view('admin.menu.search', compact('products', 'hasFilters'));
    }
    protected function hasFilters($filters)
    {
        return !empty($filters['id'])
            || (!empty($filters['start_date']) && !empty($filters['end_date']))
            || !empty($filters['status']);
    }
}
