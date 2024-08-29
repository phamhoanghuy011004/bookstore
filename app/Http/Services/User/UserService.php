<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Session;
class UserService
{
    public function getAll()
    {
        return User::orderbyDesc('id')->paginate(10);
    }

    public function create($request)
    {
        try {
            User::create([
                'fullname' => (string)$request->input('fullname'),
                'name' => (string)$request->input('name'),
                'phone' => (string)$request->input('phone'),
                'email' => (string)$request->input('email'),
                'address' => (string)$request->input('address'),
                'gender' => (string)$request->input('gender'),
                'status' => (string)$request->input('status'),
                'password' => bcrypt((string)$request->input('password')),
            ]);

            Session::flash('success', 'Tạo Người Dùng Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($user, $request)
    {
        try {
            $user->fullname = (string)$request->input('fullname');
            $user->name = (string)$request->input('name');
            $user->phone = (string)$request->input('phone');
            $user->email = (string)$request->input('email');
            $user->address = (string)$request->input('address');
            $user->gender = (string)$request->input('gender');
            $user->status = (string)$request->input('status');

            if ($request->input('password')) {
                $user->password = bcrypt((string)$request->input('password'));
            }

            $user->save();

            Session::flash('success', 'Cập Nhật Người Dùng Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $user = User::find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }

}
