<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserUpdateTasksRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
//  TODO: реализовать валидацию
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {

        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save()) {
            $success = true;
            $message = 'Пользователь успешно зарегистрирован!';
        } else {
            $success = false;
            $message = 'Ошибка при регистрации пользователя!';
        }

        return response()->json(compact('success', 'message'));
    }


    public function login(UserLoginRequest $request): \Illuminate\Http\JsonResponse
    {

        $validated = $request->validated();

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'Вы успешно авторизованы!';
        } else {
            $success = false;
            $message = 'Ошибка при авторизации пользователя!';
        }

        return response()->json(compact('success', 'message'));
    }


    public function logout(): \Illuminate\Http\JsonResponse
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
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

    public function updateTasks(Request $request, $id): \Illuminate\Http\JsonResponse
    {
//        TODO: Реализовать валидацию данных после принятия окончательного решения по формату json
        $user = User::findOrFail($id);
        $dictionary_id = $request->id;
        $learnedWords = $request->learnedWords;

        if (is_null($user->tasks)) {
            $task = [];
            $task[$dictionary_id] = $learnedWords;
            $user->tasks = json_encode($task, JSON_UNESCAPED_UNICODE);

            if($user->save()) return response()->json(['status' => 'success', 'user' => $user->id]);

            return response()->json(['status' => 'error', 'message' => 'error to save user task!']);
        }

        $tasks = json_decode($user->tasks);

        $tasks->$dictionary_id = $learnedWords;

        $user->tasks = json_encode($tasks, JSON_UNESCAPED_UNICODE);

        if($user->save()) return response()->json(['status' => 'success', 'user' => $user->id]);

        return response()->json(['status' => 'error', 'message' => 'error to save user task!']);
    }

    public function tasks($id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);

        return response()->json(['status' => 'success', 'tasks' => $user->tasks]);
    }

    public function show(int $id): UserResource
    {
        return new UserResource(User::with('dictionaries')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
//        $validated = $request->validated();
//        $dictionary = Dictionary::where('id', $id)->firstOrFail();
//        $dictionary->update($validated);
//        return response()->json(['success' => true, 'dictionary' => $dictionary->id]);
    }

    public function destroy(int $id)
    {
//        if(Dictionary::destroy($id)) return response()->json(['success' => true, 'dictionary' => $id]);
//        return response()->json(['success' => false, 'dictionary' => $id]);
    }
}
