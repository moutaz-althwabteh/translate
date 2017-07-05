<?php
/**
 * Created by PhpStorm.
 * User: Moutaz
 * Date: 7/5/2017
 * Time: 8:45 PM
 */

namespace App\Classes;


class parentClass
{
    protected $wordModel;

    // searchable word
    protected $word;
    // The results that match the exacts searched word
    protected $exactResults;

    // The results in case no exact matched
    protected $closeResults;

    protected $suggestResults;

    protected $fieldsToSearch;

    public function searchForCloseWords($ids)
    {

        $wordsFromBeginning =Word::whereNotIn('id', $ids)
            ->where($this->fieldsToSearch, 'LIKE', "$this->word%")
            ->limit(25 - count($ids))
            ->orderBy('rank', 'desc')
            ->get()
            ->toArray();
        foreach($wordsFromBeginning as $word)
        {
            array_push($ids, $word['id']);
        }
        $wordsFromBothSides = ($this->wordModel)::where($this->fieldsToSearch, 'LIKE', "%$this->word%")
            ->whereNotIn('id', $ids)
            ->orderBy('rank', 'desc')
            ->limit(30 - count($ids))
            ->get()
            ->toArray();
        $this->closeResults = array_merge($wordsFromBeginning, $wordsFromBothSides);

    }

}