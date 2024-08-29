<?php

namespace App\Http\Controllers\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use stdClass;

class ShopCartController
{
    public static $menu_parent = 'shopping-cart';

    // show thông tin giỏ hàng.
    public function show()
    {
        // kiểm tra sự tồn tại của shopping cart trong session.
        $shoppingCart = null;
        // nếu có shopping cart rồi thì lấy ra
        if (Session::has('shoppingCart')) {
            $shoppingCart = Session::get('shoppingCart');
        } else {
            // nếu chưa có thì tạo shopping cart mới.
            $shoppingCart = [];
        }
        return view('main.shop-cart', ['shoppingCart' => $shoppingCart]);
    }

    // Thêm sản phẩm vào giỏ hàng kèm số lượng sản phẩm.
    public function add(Request $request)
    {
        // lấy thông tin sản phẩm.
        $productId = $request->get('id');
        // lấy số lượng sản phẩm cần thêm vào giỏ hàng.
        $productAmount = $request->get('amount');
        if ($productAmount <= 0) {
            return view('main.shop-cart', [
                'msg' => 'Số lượng sản phẩm cần lớn hơn 0.',
                'menu_parent' => self::$menu_parent,
                'menu_action' => 'create'
            ]);
        }
        // 1. Kiểm tra sự tồn tại của sản phẩm.
        $obj = Product::find($productId);
        // nếu không tồn tại thì trả về 404.
        if ($obj == null) {
            return view('main.404', [
                'msg' => 'Không tìm thấy sản phẩm',
                'menu_parent' => self::$menu_parent,
                'menu_action' => 'create'
            ]);
        }
        // nếu có sản phẩm trong db.
        // 2. Check số lượng tồn kho. Nếu như số lượng mua lớn hơn số lượng trong kho thì báo lỗi.

        // kiểm tra sự tồn tại của shopping cart trong session.
        $shoppingCart = null;
        // nếu có shopping cart rồi thì lấy ra
        if (Session::has('shoppingCart')) {
            $shoppingCart = Session::get('shoppingCart');
        } else {
            // nếu chưa có thì tạo shopping cart mới.
            $shoppingCart = [];
        }
        // kiểm tra sản phẩm có tồn tại trong giỏ hàng không.
        if (array_key_exists($productId, $shoppingCart)) {
            // nếu có sản phẩm rồi thì update số lượng
            $existingCartItem = $shoppingCart[$productId];
            // tăng số lượng theo số lượng cần mua thêm.
            $existingCartItem->amount += $productAmount;
            // và lưu lại vào đối tượng shopping cart.
            $shoppingCart[$productId] = $existingCartItem;
        } else {
            // nếu chưa có tạo ra một cartItem mới, có thông tin trùng với thông tin sản phẩm từ
            // trong database.
            $cartItem = new stdClass();
            $cartItem->id = $obj->id;
            $cartItem->name = $obj->name;
//            $cartItem->image = $obj->image;
            $cartItem->price = $obj->price;
            $cartItem->amount = $productAmount;
            // đưa cartItem vào trong shoppingCart.
            $shoppingCart[$productId] = $cartItem;
        }
        // update thông tin shopping cart vào session.
        Session::put('shoppingCart', $shoppingCart);
        return redirect('/shop-cart');
    }

    public function update(Request $request)
    {
        // lấy thông tin sản phẩm.
        $productId = $request->get('id');
        // lấy số lượng sản phẩm cần thêm vào giỏ hàng.
        $productAmount = $request->get('amount');
        if ($productAmount <= 0) {
            return view('main.404', [
                'msg' => 'Số lượng sản phẩm cần lớn hơn 0.',
                'menu_parent' => self::$menu_parent,
                'menu_action' => 'create'
            ]);
        }
        // 1. Kiểm tra sự tồn tại của sản phẩm.
        $obj = Product::find($productId);
        // nếu không tồn tại thì trả về 404.
        if ($obj == null) {
            return view('main.404', [
                'msg' => 'Không tìm thấy sản phẩm',
                'menu_parent' => self::$menu_parent,
                'menu_action' => 'create'
            ]);
        }
        // nếu có sản phẩm trong db.
        // 2. Check số lượng tồn kho. Nếu như số lượng mua lớn hơn số lượng trong kho thì báo lỗi.

        // kiểm tra sự tồn tại của shopping cart trong session.
        $shoppingCart = null;
        // nếu có shopping cart rồi thì lấy ra
        if (Session::has('shoppingCart')) {
            $shoppingCart = Session::get('shoppingCart');
        } else {
            // nếu chưa có thì tạo shopping cart mới.
            $shoppingCart = [];
        }
        // kiểm tra sản phẩm có tồn tại trong giỏ hàng không.
        if (array_key_exists($productId, $shoppingCart)) {
            // nếu có sản phẩm rồi thì update số lượng
            $existingCartItem = $shoppingCart[$productId];
            // tăng số lượng theo số lượng cần mua thêm.
            $existingCartItem->amount = $productAmount;
            // và lưu lại vào đối tượng shopping cart.
            $shoppingCart[$productId] = $existingCartItem;
        }
        // update thông tin shopping cart vào session.
        Session::put('shoppingCart', $shoppingCart);
        Session::flash('success', 'Cập nhật giỏ hàng thành công!');
        return redirect('/shop-cart');
    }

    public function remove(Request $request)
    {
        $productId = $request->get('id');
        $shoppingCart = null;
        // nếu có shopping cart rồi thì lấy ra
        if (Session::has('shoppingCart')) {
            $shoppingCart = Session::get('shoppingCart');
        } else {
            // nếu chưa có thì tạo shopping cart mới.
            $shoppingCart = [];
        }
        unset($shoppingCart[$productId]); // Xoá giá trị theo key ở trong map với php.
        Session::put('shoppingCart', $shoppingCart);
        Session::flash('success', 'Xóa sản phẩm khỏi giỏ hàng thành công!');
        return redirect('/shop-cart');
    }
}

