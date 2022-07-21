<?php
namespace App\Services;

use App\Http\Resources\DictionaryWordsResource;
use App\Models\Dictionary;
use Illuminate\Support\Facades\DB;

class DictionaryService {
    public static function getDictionaryWithRatings(int $dictionary_id, int $user_id): DictionaryWordsResource
    {
        $dictionary = Dictionary::with('creator')->findOrFail($dictionary_id);
        $wordsWithRating = DB::table('dictionaries')
            ->join('dictionary_word', 'dictionaries.id', '=', 'dictionary_word.dictionary_id')
            ->join('words', 'dictionary_word.word_id', '=', 'words.id')
            ->join('ratings', 'words.id', '=', 'ratings.word_id')
            ->select(
                'words.*',
                'ratings.rating'
            )
            ->where('dictionaries.id', '=', $dictionary_id)
            ->where('ratings.user_id', '=', $user_id)
            ->orderBy('words.id')
            ->get();
        $dictionary->words = $wordsWithRating;
        return new DictionaryWordsResource($dictionary);
    }
}
