<?php

namespace App\Classes;


use App\Word;

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
            ->where($this->fieldsToSearch, 'LIKE', $this->word."%")
            ->limit(25 - count($ids))
            ->orderBy('rank', 'desc')
            ->get()
            ->toArray();
        foreach($wordsFromBeginning as $word)
        {
            array_push($ids, $word['id']);
        }
        $wordsFromBothSides = Word::where($this->fieldsToSearch, 'LIKE', "%$this->word%")
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

        if(strlen($this->word) > 8)
        {
            $word = str_split($this->word, strlen($this->word) / 3);
            $this->suggestResults = Word::where($this->fieldsToSearch, 'LIKE', "$word[0]%")
                ->orWhere("$this->fieldsToSearch", 'LIKE', "%$word[1]%")
                ->orWhere($this->fieldsToSearch, 'LIKE', "%$word[2]")
                ->orderBy('rank', 'desc')
                ->limit(10)
                ->get();

        }
        else
        {

            $word = str_split($this->word, strlen($this->word) / 2);


            $this->suggestResults = Word::where($this->fieldsToSearch, 'LIKE', "$word[0]%")
                ->orWhere($this->fieldsToSearch, 'LIKE', "%$word[1]")
                ->orderBy('rank', 'desc')
                ->limit(10)
                ->get();

        }

    }

}