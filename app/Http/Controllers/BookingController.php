<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;
// use App\Events\BookingCreated;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $booking =Booking::with(['user', 'event'])->get();
        return BookingResource::collection($booking);
    }


    public function store(BookingStoreRequest $request)
    {
          $booking = Booking::create($request->validated());
         event(new BookingCreated($booking));
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => new BookingResource($booking->load(['user', 'event']))
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
  $booking = Booking::with(['user', 'event'])->findOrFail($id);
        return new BookingResource($booking);
    }


    public function update(BookingUpdateRequest $request, $id)
    {
  $booking = Booking::findOrFail($id);
        $booking->update($request->validated());

        return response()->json([
            'message' => 'booking updated successfully',
            'data' => new BookingResource($booking->load(['user', 'event']))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
          $booking= Booking::findOrFail($id);
        $booking->delete();

        return response()->json([
            'message' => 'Reservation deleted successfully'
        ]);
    }
}
