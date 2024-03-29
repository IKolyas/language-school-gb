<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserDictionaryRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\DictionaryUser;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
//  TODO: реализовать валидацию
    public function register(Request $request): JsonResponse
    {

        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            $success = true;
            $message = 'Пользователь успешно зарегистрирован!';
        } else {
            $success = false;
            $message = 'Ошибка при регистрации пользователя!';
        }

        return response()->json(compact('success', 'message'));
    }


    public function login(UserLoginRequest $request): JsonResponse
    {

        $validated = $request->validated();
        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if(Auth::attempt($credentials)){
            $success = true;
            $token = Auth::user()->createToken('LaravelSanctumAuth')->plainTextToken;
            $user = Auth::user();
            return response()->json(compact('success', 'user', 'token'));
        }
        return response()->json(['success' => false, 'message' => 'auth error']);
    }

    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json(compact('success', 'message'));
    }

    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::with('dictionaries')->get());
    }

    public function store(Request $request)
    {
//        $validated = $request->validated();
//        $dictionary = Dictionary::create($validated);
//        return response()->json(['success' => true, 'dictionary' => $dictionary->id]);

    }

    public function updateTask(Request $request, int $user_id, int $dictionary_id): JsonResponse
    {
//        TODO: Реализовать валидацию данных после принятия окончательного решения по формату json

        $user = User::findOrFail($user_id);
        $words = $request['words'];

        if (is_null($user->tasks)) {
            $task = [];
            $task[$dictionary_id] = $words;
            $user->tasks = json_encode($task, JSON_UNESCAPED_UNICODE);

            if ($user->save()) return response()->json(['status' => 'success', 'user' => $user->id]);

            return response()->json(['status' => 'error', 'message' => 'error to save user task!']);
        }

        $tasks = json_decode($user->tasks);

        $tasks->$dictionary_id = $words;

        $user->tasks = json_encode($tasks, JSON_UNESCAPED_UNICODE);

        if ($user->save()) return response()->json(['status' => 'success', 'user' => $user->id]);

        return response()->json(['status' => 'error', 'message' => 'error to save user task!']);
    }

    public function task(int $user_id, int $dictionary_id = 0): JsonResponse
    {
        $user = User::findOrFail($user_id);

        if (!$dictionary_id) return response()->json(['status' => 'success', 'task' => $user->tasks]);

        $tasks = json_decode($user->tasks);
        $task = $tasks->$dictionary_id;

        if ($task) return response()->json(['status' => 'success', 'task' => $task]);

        return response()->json(['status' => 'error', 'message' => "Not find task: $dictionary_id"]);
    }

    public function addUserDictionary(UserDictionaryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user_id = $validated['user_id'];
        $dictionary_id = $validated['dictionary_id'];

        $newDictionaryUser = DictionaryUser::create(['user_id' => $user_id, 'dictionary_id' => $dictionary_id]);

        if (!$newDictionaryUser) return response()->json(['status' => 'error', 'message' => "Error create: $dictionary_id"]);

        return response()->json(['success' => true, '$newDictionaryWord' => $newDictionaryUser->id]);
    }

    public function destroyUserDictionary(int $user_id, int $dictionary_id): JsonResponse
    {
        $dictionary = DictionaryUser::where([
            ["dictionary_id", "=", $dictionary_id],
            ["user_id", "=", $user_id],
        ])->first();

        if (!$dictionary) return response()->json(['status' => 'error', 'message' => "Error destroy: $dictionary_id"]);

        $dictionary->delete();
        return response()->json(['status' => 'success', 'dictionary' => $dictionary->id]);
    }

    public function show(int $id): UserResource
    {
        return new UserResource(User::with('dictionaries')->findOrFail($id));
    }

    public function update(Request $request, int $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        if ($user->save()) {
            $success = true;
            $message = 'Данные пользователя успешно обновлены!';
        } else {
            $success = false;
            $message = 'Ошибка при обновлении данных пользователя!';
        }
        return response()->json(compact('success', 'message'));
    }

    public function destroy(int $id)
    {

    }

    public function getSocialiteUser(): JsonResponse
    {
        $redis = Redis::connection();
        $data = json_decode($redis->get('socialite' . csrf_token()));

        if ($data) {
            return response()->json(['success' => true, 'user' => $data->user, 'token' => $data->token]);
        }

        return response()->json(['success' => false]);
    }
}
