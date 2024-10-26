<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use App\Models\Event;
use App\Models\Worker;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dispatches = Dispatch::get();
        return view("dispatch_index", compact("dispatches"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $events = Event::get();
        $workers = Worker::get();
        return view("dispatch_create", compact("events", "workers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $event_id = Event::query()->where("name", $request->event_select)->first()->id;
        $workers = Worker::query()->where("name", $request->worker_select)->get();
        foreach ($workers as $worker) {
            Dispatch::create([
                "event_id" => $event_id,
                "worker_id" => $worker->id,
                "memo" => $request->memo,
                "flag" => false
            ]);
        }
        return redirect(route("dispatch_create"))->with(["message" => "派遣情報が登録されました"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $dispatch = Dispatch::find($id);
        $dispatch->delete();
        return redirect(route("dispatch_index"));
    }
}
