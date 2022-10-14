<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        return Inertia::render('Books');
    }

    public function data(Request $request)
    {
        $events = Event::whereBetween('start',[$request->input('start'), $request->input('end')] )->get();
        return response()->json(["events" => $events]);
    }

    public function store(Request $request)
    {
        Event::create($request->all());
        return redirect()->back();
    }
}
