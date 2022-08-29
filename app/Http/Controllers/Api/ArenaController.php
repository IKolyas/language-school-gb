<?php

namespace App\Http\Controllers\Api;

use App\Entities\ArenaRoom;
use App\Events\Arena;
use App\Events\UserActiveArena;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ArenaController extends Controller
{
    public function createRoom(Request $request): JsonResponse
    {
        $owner = User::select('id', 'name', 'lastname')->where('id', (int) auth()->user()->id)->get()->first();
        $invite = User::select('id', 'name', 'lastname')->where('id', (int) $request->get('user_id'))->get()->first();

        $arena = new ArenaRoom($owner, $invite);

//        Redis::set($room['user_id'], json_encode($room));

        Arena::dispatch($arena);
        return response()->json(['success' => true]);
    }

    public function nextStep(Request $request): JsonResponse
    {
        $redis    = Redis::connection();
        $room = $redis->get(auth()->user()->id);
        $room = json_decode($room);
        ++$room->step;
        $redis->set(auth()->user()->id, json_encode($room));

        Arena::dispatch(json_encode($room));
        return response()->json(['success' => true]);
    }

    public function getUsers(): JsonResponse
    {
        $users = User::select('id', 'name', 'lastname')->get();

        return response()->json(['success' => true, 'users' => $users]);
    }

    public function userIsActive(Request $request): JsonResponse
    {
        $user_id = auth()->user()->id;

        $users = Redis::get('users.arena');


        if ($users) {
            $users = json_decode($users);
            if(!in_array($user_id, $users)) $users[] = $user_id;
        } else {
            $users = [];
        }


        Redis::set('users.arena', json_encode($users), 'EX', 30);

        UserActiveArena::dispatch(json_encode($users));

        return response()->json(['success' => true]);


    }

}
