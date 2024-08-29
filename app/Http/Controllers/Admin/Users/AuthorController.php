<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateFormRequest;
use App\Http\Services\Author\AuthorService;
use App\Models\Author;


class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService){
        $this->authorService = $authorService;
    }

    public function create(){
        return view('admin.author.add', [
            'title' => 'Thêm tác giả mới',
//            'categories' => $this->productService->getCategories()
        ]);
    }
    public function store(CreateFormRequest $request)
    {
        $result = $this -> authorService->create($request);
        return redirect()->back();
    }
    public function index()
    {
        $list = Author::paginate(10);
        return view('admin.author.list',[
            'title' => 'Danh sach muc moi nhat',
            'list' => Author::paginate(15)
        ]);

    }
}
