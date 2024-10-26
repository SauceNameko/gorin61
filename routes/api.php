<?php

use App\Models\Dispatch;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/events", function (Request $request) {
    $worker_id = $request->worker_id;
    $event_date = $request->event_date;
    $place = $request->place;
    $results = [];
    if ($request->worker_id) {
        // if ($event_date && $title && $place) {
        //     $dispatches = Dispatch::query()->where("worker_id", $worker_id)->get();
        //     foreach ($dispatches as $dispatch) {
        //         // $event_id = $dispatch->event_id;
        //         // $event = Event::find($event_id);
        //         return $dispatch;
        //         // $data = $event->where("event_date", $event_date)->where("title", $title)->where("place", $place)->get();
        //         return $event;
        //     }
        // }
        $dispatches = Dispatch::query()->where("worker_id", $worker_id)->get();

        return response()->json($dispatches, 200);
    }
    return response()->json("エラー", 404);
});
Route::post("/events", function (Request $request) {
    $event_id = $request->event_id;
    $worker_id = $request->worker_id;
    $dispatch = Dispatch::query()->where("event_id", $event_id)->where("worker_id", $worker_id)->first();
    if (empty($dispatch)) {
        return response()->json("エラー", 404);
    }
    $dispatch->update([
        "flag" => true
    ]);
    return response()->json("登録しました", 204);
});
