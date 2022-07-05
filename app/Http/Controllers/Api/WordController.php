<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WordRequest;
use App\Models\DictionaryWord;
use App\Models\Word;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WordController extends Controller
{

    public function index(): JsonResponse
    {
        $words = Word::all();
        return response()->json(['success' => true, 'words' => $words]);
    }

    public function store(WordRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $word = $validated['word'];
        $translation = $validated['translation'];
        $dictionary_id = $validated['dictionary_id'];

        $newWord = Word::firstOrCreate(
            ['word' => $word],
            ['translation' => $translation]
        );

        DictionaryWord::create(['word_id' => $newWord->id, 'dictionary_id' => $dictionary_id]);

        return response()->json(['success' => true, 'wordId' => $newWord->id]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
