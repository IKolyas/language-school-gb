<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DictionaryPostRequest;
use App\Http\Requests\Api\DictionaryPutRequest;
use App\Http\Resources\DictionaryResource;
use App\Http\Resources\DictionaryWordsResource;
use App\Models\Dictionary;
use Illuminate\Http\JsonResponse,
    Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DictionaryController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return DictionaryResource::collection(Dictionary::get());
    }

    public function store(DictionaryPostRequest $request): JsonResponse
    {
//        TODO: add user_id -> creator_is DictionaryUser table
        $validated = $request->validated();
        $dictionary = Dictionary::create($validated);
        return response()->json(['success' => true, 'dictionary' => $dictionary->id]);
    }

    public function show(int $id): DictionaryWordsResource
    {
        return new DictionaryWordsResource(Dictionary::with('words')->findOrFail($id));
    }

    public function update(DictionaryPutRequest $request, $id): JsonResponse
    {
        $validated = $request->validated();
        $dictionary = Dictionary::where('id', $id)->firstOrFail();
        $dictionary->update($validated);
        return response()->json(['success' => true, 'dictionary' => $dictionary->id]);
    }

    public function destroy(int $id): JsonResponse
    {
        if(Dictionary::destroy($id)) return response()->json(['success' => true, 'dictionary' => $id]);
        return response()->json(['success' => false, 'dictionary' => $id]);
    }
}
