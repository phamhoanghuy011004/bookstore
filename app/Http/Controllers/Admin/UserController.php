<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\User\CreateFormRequest;
use App\Http\Services\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;

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
    public function update(User $user, Request $request){
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
            'status' => 'required|string|in:active,inactive',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if($request->filled('password')){
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return redirect('admin/users/list')->with('success','Update successfully');
    }

    public function search(Request $request)
    {
        $filters = $request->only(['id', 'fullname', 'name', 'email', 'phone', 'status', 'gender']);
        $query = User::query();

        if (!empty($filters['id'])) {
            $query->where('id', $filters['id']);
        }

        if (!empty($filters['fullname'])) {
            $query->where('fullname', 'like', '%' . $filters['fullname'] . '%');
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (!empty($filters['phone'])) {
            $query->where('phone', 'like', '%' . $filters['phone'] . '%');
        }

        if (isset($filters['status']) && $filters['status'] !== '') {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['gender'])) {
            $query->where('gender', $filters['gender']);
        }

        $list = $query->paginate(10);

        return view('admin.user.list', [
            'list' => $list,
            'hasFilters' => $this->hasFilters($filters),
        ]);
    }

    protected function hasFilters($filters)
    {
        return !empty($filters['id'])
            || !empty($filters['fullname'])
            || !empty($filters['name'])
            || !empty($filters['email'])
            || !empty($filters['phone'])
            || !empty($filters['status'])
            || !empty($filters['gender']);
    }

    public function edit($id) {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }

        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    public function destroy($id){
        try {
            User::where('id', $id)->delete();
            return redirect('/admin/users/list')->with('success','Delete successfully');
        } catch (\Exception $exception) {
            return redirect('/admin/users/list')->with('error', $exception->getMessage());
        }
    }


}
