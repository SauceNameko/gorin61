<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $workers = Worker::get();
        return view("worker_index", compact("workers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("worker_create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "memo" => "required"
        ], [
            "name.required" => "エラーが発生しました",
            "email.required" => "エラーが発生しました",
            "password.required" => "エラーが発生しました",
            "memo.required" => "エラーが発生しました",
        ]);
        Worker::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->passowrd),
            "memo" => $request->memo,
        ]);
        return redirect(route(("worker_create")))->with(["message" => "人材情報が登録されました"]);
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
        $worker = Worker::find($id);
        return view("worker_edit", compact("worker"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            "name" => "required",
            "email" => "required",
            "memo" => "required"
        ], [
            "name.required" => "エラーが発生しました",
            "email.required" => "エラーが発生しました",
            "memo.required" => "エラーが発生しました",
        ]);
        $worker = Worker::find($id);
        $worker->update([
            "name" => $request->name,
            "email" => $request->email,
            "memo" => $request->memo,
        ]);
        return redirect(route("worker_edit", ["id" => $worker->id]))->with(["message" => "人材情報が編集されました"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $worker = Worker::find($id);
        $dispatch = Dispatch::query()->where("event_id", $worker->id);
        $worker->delete();
        $dispatch->delete();
        return redirect(route("worker_index"));
    }
}
