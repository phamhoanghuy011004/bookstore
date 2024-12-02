<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Event\EventService;
use App\Models\Event;
use Illuminate\Http\Request;


class EventController extends Controller
{
    protected $eventService;
    public function __construct(EventService $eventService){
        $this->eventService = $eventService;
    }
    public function create()
    {
        return view('admin.event.add', [
            'title' => 'Thêm sự kiện mới',
        ]);
    }
    public function store(CreateFormRequest $request)
    {
        $result = $this->eventService->create($request);
        return redirect()->back();
    }

    public function indexlist() //indexlist of admin
    {
        $list = Event::paginate(10);
        return view('admin.event.list', [
            'title' => 'Danh sách liên hệ',
            'list' => $list
        ]);
    }
    public function index() // news of user
    {
        $events = Event::paginate(3);
        return view('main.news',['events' => $events]);
    }

    public function update(Event $event, CreateFormRequest $request)
    {
        $event->update($request->all());
        return redirect('admin/events/list')->with('success', 'Cập nhật thành công');
    }

    public function search(Request $request)
    {
        $filters = $request->only(['id', 'name', 'location', 'status', 'start_time', 'end_time']);
        $query = Event::query();

        if (!empty($filters['id'])) {
            $query->where('id', $filters['id']);
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['start_time'])) {
            $query->whereDate('start_time', $filters['start_time']);
        }

        if (!empty($filters['end_time'])) {
            $query->whereDate('end_time', $filters['end_time']);
        }

        $list = $query->paginate(10);
        $hasFilters = $this->hasFilters($filters);

        return view('admin.event.list', [
            'list' => $list,
            'hasFilters' => $hasFilters,
        ]);
    }

    protected function hasFilters($filters)
    {
        return !empty($filters['id'])
            || !empty($filters['name'])
            || !empty($filters['location'])
            || !empty($filters['status'])
            || !empty($filters['start_time'])
            || !empty($filters['end_time']);
    }

    public function edit($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('admin.events.index')->with('error', 'Sự kiện không tồn tại.');
        }

        return view('admin.event.edit', [
            'event' => $event,
            'list' => Event::all()
        ]);
    }


    public function destroy($id)
    {
        try {
            Event::where('id', $id)->delete();
            return redirect('/admin/events/list')->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect('/admin/events/list')->with('error', $exception->getMessage());
        }
    }
}
