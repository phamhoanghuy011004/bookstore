<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\User\CreateFormRequest;
use App\Http\Services\User\UserService;
use App\Models\User;

class UserController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create()
    {
        return view('admin.user.add', [
            'title' => 'Thêm người dùng mới',
            'users' => $this->userService->getAll()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->userService->create($request);
        return redirect()->back();
    }

    public function index()
    {
        $list = User::paginate(10);
        return view('admin.user.list', [
            'title' => 'Danh sách người dùng mới nhất',
            'list' => $list
        ]);
    }

    public function show(User $user)
    {
        return view('admin.user.edit', [
            'title' => 'Chỉnh sửa người dùng: ' . $user->fullname,
            'user' => $user,
            'users' => $this->userService->getAll()
        ]);
    }

}
