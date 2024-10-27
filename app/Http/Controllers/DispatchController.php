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
        $request->validate([
            "event_select" => "required",
            "workers_select" => "required",
            "memo" => "required"
        ], [
            "event_select.required" => "エラーが発生しました",
            "workers_select.required" => "エラーが発生しました",
            "memo.required" => "エラーが発生しました",
        ]);
        $event_id = Event::query()->where("name", $request->event_select)->first()->id;
        $results = [];
        foreach ($request->workers_select as $worker_select) {
            $results[] = Worker::query()->where("name", $worker_select)->first();
        }
        foreach ($results as $result) {
            Dispatch::create([
                "event_id" => $event_id,
                "worker_id" => $result->id,
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
        $events = Event::get();
        $workers = Worker::get();
        $dispatch = Dispatch::find($id);
        return view("dispatch_edit", compact("events", "workers", "dispatch"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            "event_select" => "required",
            "worker_select" => "required",
            "memo" => "required"
        ], [
            "event_select.required" => "エラーが発生しました",
            "worker_select.required" => "エラーが発生しました",
            "memo.required" => "エラーが発生しました",
        ]);
        $dispatch = Dispatch::find($id);
        $event_id = Event::query()->where("name", $request->event_select)->first()->id;
        $worker_id = Worker::query()->where("name", $request->worker_select)->first()->id;
        $dispatch->update([
            "event_id" => $event_id,
            "worker_id" => $worker_id,
            "memo" => $request->memo,
        ]);
        return redirect(route("dispatch_edit", ["id" => $dispatch->id]))->with(["message" => "派遣情報が編集されました"]);
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
