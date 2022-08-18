<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WordRequest;
use App\Models\DictionaryWord;
use App\Models\Rating;
use App\Models\Word;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $user_id = $validated['user_id'];

        $newWord = Word::firstOrCreate(
            ['translation' => $translation, 'word' => $word],
        );
        Rating::firstOrCreate(
            ['user_id' => $user_id, 'word_id' => $newWord->id],
            ['rating' => 0]
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

    public function destroy(int $id): JsonResponse
    {
        if(Word::destroy($id)) return response()->json(['success' => true, 'word' => $id]);
        return response()->json(['success' => false, 'word' => $id]);
    }

    public function getAllUserWords(int $user_id)
    {
        return Rating::where('user_id', $user_id)->get();
    }

    public function updateRating(Request $request, $user_id)
    {
        $caseString = 'case word_id';
        $ids = '';
        foreach ($request->words as $word) {
            $id = $word['id'];
            $rating = $word['rating'];
            $caseString .= " when $id then $rating";
            $ids .= " $id,";
        }
        $ids = trim($ids, ',');

        $result = DB::update("update ratings set rating = $caseString end where word_id in ($ids) and user_id = $user_id");
        return $result;
    }
}
