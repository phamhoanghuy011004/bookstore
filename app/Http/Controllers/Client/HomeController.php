<?php

namespace App\Http\Controllers\Client;

use App\Models\Author;
use App\Models\Event;
use App\Models\Product;

class HomeController
{
    public function index()
    {
        $products = Product::whereIn('author', ['Nguyễn Nhật Ánh', 'Nhiều tác giả'])->get();
        $authors = Author::all();
        $events = Event::latest()->take(4)->get();
        return view('main.index',[
            'products' => $products,
            'authors' => $authors,
            'events' => $events]);
    }
}
