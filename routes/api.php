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
    $title = $request->title;
    $events = [];
    $results = [];
    if ($worker_id) {
        $dispatches = Dispatch::query()->where("worker_id", $worker_id)->get();
        if ($dispatches->isEmpty()) {
            return response()->json("エラー", 404);
        }
        foreach ($dispatches as $dispatch) {
            $events[] = Event::query()->find($dispatch->event_id);
        }
        foreach ($events as $event) {
            $data = Event::query();
            if (isset($event_date)) {
                $data->where("event_date", $event_date);
            }
            if (isset($place)) {
                $data->where("place", $place);
            }
            if (isset($title)) {
                $data->where("name", "like", "%" . $title . "%");
            }
            if (!empty($data->find($event->id))) {
                $results[] = $data->find($event->id);
            }
        }
        if (empty($results)) {
            return response()->json("エラー", 404);
        }
        return response()->json(["data" => $results], 200);
    }
});
Route::post("/events", function (Request $request) {
    $event_id = $request->event_id;
    $worker_id = $request->worker_id;
    $dispatch = Dispatch::query()->where("event_id", $event_id)->where("worker_id", $worker_id)->first();
    if (empty($dispatch)) {
        return response()->json(["message" => "エラー"], 404);
    }
    $dispatch->update([
        "flag" => true
    ]);
    return response()->json("", 204);
});
