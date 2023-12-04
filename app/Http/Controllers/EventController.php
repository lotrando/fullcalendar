<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function calendarIndex(Request $request)
    {
        $items = Event::with('user', 'department')
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end',   '<=', $request->end)
            ->get();

        foreach ($items as $item) {
            $events[] = [
                'id'            => $item->id,
                'color'         => $item->department->color,
                'textColor'     => '#ffffff',
                'title'         => $item->department->department_name,
                'department_id' => $item->department->id,
                'user_id'       => $item->user_id,
                'start'         => $item->start,
                'end'           => $item->end,
            ];
        }
        return response()->json($events);
    }

    public function calendarShow($id)
    {
        $event = Event::with('user', 'department')->findOrFail($id);
        // if ($event->user_id != auth()->user->id) {
        if ($event->user_id == 5) {
            return response()->json(['warning' => 'Toto není váše rezervace!']);
        }
        return response()->json(['data' => $event]);
    }

    public function calendarStore(Request $request)
    {
        $error = Validator::make($request->all(), [
            'title'         => 'required',
            'user_id'       => 'required',
            'department_id' => 'required',
            'start'         => 'required|date|after_or_equal:today',
            'end'           => 'required|date'
        ]);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'title'         => $request->title,
            'user_id'       => $request->user_id,
            'department_id' => $request->department_id,
            'start'         => $request->start,
            'end'           => $request->end,
        ];

        Event::create($form_data);
        return response()->json(['success' => 'Rezervace úspěšně uložena!']);
    }

    public function calendarUpdate(Request $request)
    {
        $error = Validator::make($request->all(), [
            'title'         => 'required',
            'department_id' => 'required',
            'user_id'       => 'required',
            'start'         => 'required|date|after_or_equal:today',
            'end'           => 'required|date'
        ]);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'title'         => $request->title,
            'user_id'       => $request->user_id,
            'department_id' => $request->department_id,
            'start'         => $request->start,
            'end'           => $request->end,
        ];

        Event::find($request->id)->update($form_data);
        return response()->json(['success' => 'Rezervace úspěšně upravena!']);
    }

    public function calendarDestroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json(['success' => 'Odstraněno']);
    }

    public function tableIndex(Request $request)
    {
        $departments = Department::all();

        if ($request->ajax()) {
            $model = Event::with('user', 'department')->select('*', 'events.id');
            return DataTables::eloquent($model)->addColumn('action', function ($data) {
                $buttons = '
                    <center>
                        <span title="Možnosti" class="cursor-pointer" id="dropdownMenuButton-' . $data->id . '" data-bs-toggle="dropdown">
                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                        </svg>
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-' . $data->id . '">
                            <li class="dropdown-item delete" name="delete" data-event-id="' . $data->id . '">
                                <svg class="icon dropdown-item-icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7h16"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path><path d="M10 12l4 4m0 -4l-4 4"></path>
                                </svg>
                                Odstranit zaměstnance
                            </li>
                        </ul>
                    </center>
                    ';
                return $buttons;
            })->toJson();
        }
    }
}
