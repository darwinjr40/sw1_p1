<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventApiController extends Controller
{

    public function index()
    {
        $event = Event::included()
                    ->filter()
                    ->sort()
                    ->getOrPaginate();
        return EventResource::collection($event);
    }

    public function store(Request $request)
    {
        request()->validate(Event::$rules);
        $event = Event::create($request->all());
        return EventResource::make($event);
    }


    public function show($id)
    {
        $event = Event::included()->findOrFail($id);
        return EventResource::make($event);
    }

    public function update(Request $request,  $id)
    {
        $event = Event::findOrFail($id);
        request()->validate(Event::$rules);
        $event->update($request->all());
        $event->save();
        return EventResource::make($event);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event -> delete();
        return EventResource::make($event);
    }
}
