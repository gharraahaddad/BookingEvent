<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //   $events = Event::with('user')->get();
        // return EventResource::collection($events);
         $query = Event::with('user');

   
    if ($request->filled('date')) {
        $query->whereDate('date', $request->input('date'));
    }


    if ($request->input('sort') === 'capacity') {
        $direction = $request->input('sort_dir', 'asc');
        $query->orderBy('capacity', $direction);
    }


    $events = $query->get();

    return EventResource::collection($events);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(EventStoreRequest $request)
    {

      $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('event_images', 'public');
    }


        //  $event = Event::create($request->validated());
 // دمج المستخدم المصادق به مع البيانات المرسلة
    $event = Event::create(array_merge(
        $request->validated(),
        ['created_by' => auth()->id()]
    ));
        return response()->json([
            'message' => 'Event created successfully',
            'data' => new EventResource($event->load('user')),
             'image'=>$imagePath
        ], 201);
    }

    public function show($id)
    {
  $event = Event::with('user')->findOrFail($id);
        return new EventResource($event);
    }


    public function update(EventUpdateRequest $request, $id)
    {
          $event = Event::findOrFail($id);
        $event->update($request->validated());

        return response()->json([
            'message' => 'Event updated successfully',
            'data' => new EventResource($event->load('creator'))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
          $event = Event::findOrFail($id);
        $event->delete();

        return response()->json([
            'message' => 'Event deleted successfully'
        ]);
    }
}
