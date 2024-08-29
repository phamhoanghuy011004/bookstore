<?php

namespace App\Http\Controllers\Client;
use App\Models\Product;
class ProductController1
{
    public function index()
    {
        $products = Product::paginate(20);

        //category
        $products1 = Product::where('category','=','Tiểu thuyết')->get();
        $products2 = Product::where('category','=','Truyện ngắn')->get();
        $products3 = Product::where('category','=','Văn học hiện đại, thiếu nhi')->get();
        $products4 = Product::where('category','=','Khoa học viễn tưởng, Xã hội')->get();
        $products5 = Product::where('category','=','Sách kỹ năng sống, tự lực')->get();
        $products6 = Product::where('category','=','Khoa học, vũ trụ học')->get();
        $products7 = Product::where('category','=','Tâm lý học, xã hội')->get();
        $products8 = Product::where('category','=','Du lịch, khám phá')->get();

        //year
        $products_2024 = Product::whereYear('publish_at', '=', 2024)->get();
        $products_2000_2024 = Product::whereBetween('publish_at', [2000, 2024])->get();
        $products_before_2000 = Product::whereYear('publish_at', '<', 2000)->get();

        return view('main.shop', ['products' => $products,
            'products1' => $products1,
            'products2' => $products2,
            'products3' => $products3,
            'products4' => $products4,
            'products5' => $products5,
            'products6' => $products6,
            'products7' => $products7,
            'products8' => $products8,
            'products_2024' => $products_2024,
            'products_2000_2024' => $products_2000_2024,
            'products_before_2000' => $products_before_2000
        ]);
    }

    public function index2(){
        $products = Product::paginate(20);
        return view('main.shop-list', ['products' => $products,]);
    }
    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');

        // Lấy giỏ hàng của người dùng đang đăng nhập
        $cart = auth()->user()->cart;

        // Lọc các mặt hàng trong giỏ hàng dựa trên truy vấn tìm kiếm
        $filteredCartItems = $cart->items->filter(function ($item) use ($searchQuery) {
            return stripos($item->name, $searchQuery) !== false;
        });

        return view('shop-cart', compact('filteredCartItems', 'cart'));
    }

    public function shop_details($id)
    {
        $product = Product::find($id);
        return view('main.shop-details',compact('product'));
    }

//    public function home_index()
//    {
//        $products = Product::all();
//        return view('main.index',['products' => $products]);
//    }
}

