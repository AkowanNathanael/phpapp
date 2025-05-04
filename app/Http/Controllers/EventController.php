<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->get();
        // dd($categories);
        return view("admin.event.index", ["events" => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.event.create_event");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->file("image")->store("post", "public"));
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "image" => ["nullable", "file" ,"max:1048"],
            "url" => ["url","nullable"],
            "start" => ["required"],
            "end" => ["required"]
        ]);
        
        // dd($validated);

        if ($request->hasFile("image")) {
            //  dd($validated);
            $validated["image"] = Storage::disk("public")->putFile("event", $request->file("image"));
        }
        Event::create($validated);
        return redirect("/admin/event")->with(["message" => "event created successfully"]);
        // dd($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
        // dd($post);
        return view("admin.event.show", ["event" => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
 
        return view("admin.event.edit",["event"=> $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // dd($request->all());
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "image" => ["nullable","file", "max:1048"],
            "url" => ["url","nullable"],
            "start_date" => ["required"],
            "end_date" => ["required"]
        ]);
        // dd("ok");
        if ($request->hasFile("image")) {
            //  dd($validated);
            if ($event->image) {
                Storage::disk("public")->delete($event->image);
            }
            $validated["image"] = Storage::disk("public")->putFile("event", $request->file("image"));
        }
        $event->update($validated);
        return redirect("/admin/event")->with(["update" => "event updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();
        if ($event->image) {
            Storage::disk("public")->delete($event->image);
        }
        return redirect("/admin/event")->with(["delete" => "event deleted"]);
    }
}
