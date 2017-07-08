<?php

namespace App\Classes;


use App\Word;
use Illuminate\Support\Facades\DB;

class WordHandler
{
    // Word Model
    protected $wordModel;

    // searchable word
    protected $word;
    // The results that match the exacts searched word
    protected $exactResults;

    // The results in case no exact matched
    protected $closeResults;

    protected $suggestResults;

    protected $fieldsToSearch;


    /**
     * searches for words close to it
     * @param $ids
     */
    public function searchForCloseWords($ids)
    {

        $wordsFromBeginning = Word::whereNotIn('id', $ids)
            ->where($this->fieldsToSearch, 'LIKE', $this->word . "%")
            ->limit(25 - count($ids))
            ->orderBy('rank', 'desc')
            ->get()
            ->toArray();

        foreach ($wordsFromBeginning as $word) {
            array_push($ids, $word['id']);
        }

        $wordsFromBothSides = Word::where($this->fieldsToSearch, 'LIKE', "%" . $this->word . "%")
            ->whereNotIn('id', $ids)
            ->orderBy('rank', 'desc')
            ->limit(30 - count($ids))
            ->get()
            ->toArray();

        $this->closeResults = array_merge($wordsFromBeginning, $wordsFromBothSides);

    }


    /**
     * searches for suggestions
     */
    public function suggestWords()
    {
        $column = '';
        if (isArabic($this->word))
            $column = 'arabic';
        else
            $column = 'german';


        $output = array();
        $wordOutput = array();
        $words = DB::select('select * from word where LEFT (' . $column . ',1)="' . mb_substr($this->word, 0, 1) . '"');

        foreach ($words as $word) {

            if (!in_array($word->$column, $wordOutput)) {
//                echo $word->$column, '<br/>';
                similar_text($this->word, $word->$column, $parcent);
                if ($parcent > 70) {
                    $output[] = $word;
                    $wordOutput[] = $word->$column;
                }

            }

        }

        $this->suggestResults = $output;

//        if(strlen($this->word) > 8)
//        {
//
////            $word = str_split($this->word, strlen($this->word) / 3);
////            dd($word);
////            dd(preg_split('//u', $this->word, strlen($this->word) / 3, PREG_SPLIT_NO_EMPTY));
//            $word=preg_split('//u', $this->word, strlen($this->word) / 3, PREG_SPLIT_NO_EMPTY);
//
//            $this->suggestResults = Word::where($this->fieldsToSearch, 'LIKE', $word[0]."%")
//                ->orWhere("$this->fieldsToSearch", 'LIKE', "%".$word[1]."%")
//                ->orWhere($this->fieldsToSearch, 'LIKE', "%".$word[2])
//                ->orderBy('rank', 'desc')
//                ->limit(10)
//                ->get();
//
//        } else {
//
//            if (strlen($this->word) == 1) {
//
//                $word[0] = ($this->word);
//                $this->suggestResults = Word::where($this->fieldsToSearch, 'LIKE', "$word[0]%")
//                    ->orderBy('rank', 'desc')
//                    ->limit(10)
//                    ->get();
//            } else {
////                dd(mb_strlen($this->word));
//                $word=preg_split('//u', $this->word,mb_strlen($this->word) / 2 , PREG_SPLIT_NO_EMPTY);
//
////                $word = str_split($this->word, strlen($this->word) / 2);
////                dd(preg_split('//u', $this->word, strlen($this->word) / 2, PREG_SPLIT_NO_EMPTY));
//                try{
//                    $this->suggestResults = Word::where($this->fieldsToSearch, 'LIKE', "$word[0]%")
//                        ->orWhere($this->fieldsToSearch, 'LIKE', "%$word[1]")
//                        ->orderBy('rank', 'desc')
//                        ->limit(10)
//                        ->get();
//                }catch (\Exception $e){
//                    $this->suggestResults = Word::where($this->fieldsToSearch, 'LIKE', "$word[0]%")
//                     //   ->orWhere($this->fieldsToSearch, 'LIKE', "%$word[1]")
//                        ->orderBy('rank', 'desc')
//                        ->limit(10)
//                        ->get();
//                }
//
//            }
//
//        }

    }

}