<?php

namespace App\Http\Services\Contact;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
class ContactService
{
    public function create($request)
    {
        try {
            Contact::create([
                'name' => (string)$request->input('name'),
                'email' => (string)$request->input('email'),
                'message' => (string)$request->input('message'),
            ]);
            Session::flash('success', 'Tạo liên hệ thành công');
        } catch (\Exception $exception) {
            Log::error('Error creating contact: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    // Cập nhật liên hệ hiện có
    public function update($contact, $request)
    {
        $contact->name = (string)$request->input('name');
        $contact->email = (string)$request->input('email');
        $contact->message = (string)$request->input('message');

        $contact->save();

        Session::flash('success', 'Cập nhật thành công');
        return true;
    }

    // Xóa liên hệ
    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $contact = Contact::find($id);
        if ($contact) {
            return Contact::where('id', $id)->delete();
        }
        return false;
    }

    // Lọc liên hệ dựa trên các bộ lọc
    public function getFilteredContacts($filters)
    {
        $query = Contact::query();

        if (!empty($filters['id'])) {
            $query->where('id', $filters['id']);
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (!empty($filters['message'])) {
            $query->where('message', 'like', '%' . $filters['message'] . '%');
        }

        return $query->get();
    }
}
