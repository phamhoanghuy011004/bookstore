<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateFormRequest;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function create(){
        return view('admin.product.add', [
            'title' => 'Thêm sản phẩm mới',
//            'categories' => $this->productService->getCategories()
        ]);
    }
    public function store(CreateFormRequest $request)
    {
        $result = $this -> productService->create($request);
        return redirect()->back();
    }
    public function index()
    {
        $list = Product::paginate(10);
        return view('admin.product.list',[
            'title' => 'Danh sach muc moiw nhat',
            'list' => Product::paginate(10)
        ]);

    }
    public function show(Product $product){
        return view('admin.product.edit',[
            'title' => 'Chinh sua danh muc' . $product->name,
            'menu' => $product,
            'menus' => $this->productService->getParent()
        ]);
    }
    public function update (Product $product, CreateFormRequest $request){
        $this->productService->update($product, $request);
        return redirect('admin/products/list')->with('success','Update successfully');
    }

//    update
    public function search(Request $request)
    {
        // Lấy tất cả các tham số tìm kiếm từ request
        $filters = $request->only(['id', 'name', 'author', 'category', 'publish_at', 'status', 'price_min', 'price_max']);

        // Bắt đầu query với model Product
        $query = Product::query();

        // Lọc theo ID nếu có
        if (!empty($filters['id'])) {
            $query->where('id', $filters['id']);
        }

        // Lọc theo tên sản phẩm nếu có
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        // Lọc theo tác giả nếu có
        if (!empty($filters['author'])) {
            $query->where('author', 'like', '%' . $filters['author'] . '%');
        }

        // Lọc theo danh mục nếu có
        if (!empty($filters['category'])) {
            $query->where('category', 'like', '%' . $filters['category'] . '%');
        }

        // Lọc theo ngày xuất bản nếu có
        if (!empty($filters['publish_at'])) {
            $query->whereDate('publish_at', $filters['publish_at']);
        }

        // Lọc theo trạng thái nếu có
        if (isset($filters['status']) && $filters['status'] !== '') {
            $query->where('status', $filters['status']);
        }

        // Lọc theo giá tối thiểu nếu có
        if (!empty($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }

        // Lọc theo giá tối đa nếu có
        if (!empty($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }

        // Lấy danh sách sản phẩm sau khi lọc và phân trang
        $list = $query->paginate(10);

        // Kiểm tra xem có bất kỳ bộ lọc nào được áp dụng không
        $hasFilters = $this->hasFilters($filters);

        // Trả về view với dữ liệu danh sách sản phẩm và biến $hasFilters
        return view('admin.product.list', [
            'list' => $list,
            'hasFilters' => $hasFilters,
        ]);
    }

    protected function hasFilters($filters)
    {
        return !empty($filters['id'])
            || !empty($filters['name'])
            || !empty($filters['author'])
            || !empty($filters['category'])
            || !empty($filters['publish_at'])
            || !empty($filters['status'])
            || !empty($filters['price_min'])
            || !empty($filters['price_max']);
    }

    public function edit($id) {
        $product = Product::find($id);

        // Kiểm tra xem sản phẩm có tồn tại không
        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        return view('admin.product.edit', [
            'product' => $product,
            'list' => Product::all() // Nếu bạn cần danh sách tất cả các sản phẩm
        ]);
    }

    public function destroy($id){
        try {
            Product::where('id', $id)->delete();
            return redirect('/admin/products/list')->with('success','Delete successfully');
        } catch (\Exception $exception) {
            return redirect('/admin/products/list')->with('error', $exception->getMessage());
        }
    }



}
