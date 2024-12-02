<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Contact\ContactService;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function create()
    {
        return view('admin.contact.add', [
            'title' => 'Thêm liên hệ mới'
        ]);
    }

//    public function store(Request $request)
//    {
//        $data = $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255',
//            'message' => 'required|string',
//        ]);
//
//        $this->contactService->create($data);
//        return redirect()->back()->with('success', 'Contact created successfully.');
//    }

    public function index()
    {
        $list = Contact::paginate(10);
        return view('admin.contact.list', [
            'title' => 'Danh sách liên hệ',
            'list' => $list
        ]);
    }

    public function show(Contact $contact)
    {
        return view('admin.contact.show', [
            'title' => 'Chi tiết liên hệ',
            'contact' => $contact
        ]);
    }

    public function update(Contact $contact, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);

        $contact->update($data);
        return redirect('admin/contacts/list')->with('success', 'Update successfully.');
    }

    public function search(Request $request)
    {
        $filters = $request->only(['id', 'name', 'email', 'message']);
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

        $list = $query->paginate(10);

        return view('admin.contact.list', [
            'list' => $list,
            'hasFilters' => $this->hasFilters($filters),
        ]);
    }

    protected function hasFilters($filters)
    {
        return !empty($filters['id'])
            || !empty($filters['name'])
            || !empty($filters['email'])
            || !empty($filters['message']);
    }

    public function edit($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return redirect()->route('admin.contacts.index')->with('error', 'Contact not found.');
        }

        return view('admin.contacts.edit', [
            'contact' => $contact
        ]);
    }

    public function destroy($id)
    {
        try {
            Contact::where('id', $id)->delete();
            return redirect('/admin/contacts/list')->with('success', 'Delete successfully.');
        } catch (\Exception $exception) {
            return redirect('/admin/contacts/list')->with('error', $exception->getMessage());
        }
    }
}
