<?php

namespace App\Classes;

use App\Word;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArabicWordHandler extends WordHandler
{


    /**
     * WordHandler constructor.
     * @param Model $wordModel
     * @param $word
     * @param $field
     */
    public function __construct(Model $wordModel, $word, $field)
    {
        $this->wordModel = $wordModel;
        $this->word = $word;
        $this->fieldsToSearch = $field;
    }


    /**
     * Handles word search
     * @return mixed
     */
    public function handleWord()
    {
        // Filter arabic from confusing chars
        $this->word = filterArabicWords($this->word);
        // if we got nothing search for close results as do you mean?
        $this->searchExact();
        $ids = array();

        foreach ($this->exactResults as $result)
        {
            array_push($ids, $result['id']);
        }
//        dd($ids);
        // كلمات متشابهة
        $this->searchForCloseWords($ids);

        if(!count($this->exactResults) && !count($this->closeResults))
        {

            $this->suggestWords();

            $data['suggestion'] = $this->suggestResults;
            $data['kind'] = 'arabic';
            return $data;
        }
        $data['exact'] = $this->exactResults;
        $data['close'] = $this->closeResults;

        return $data;
    }


    /**
     * searches for the exact matched word
     */
    public function searchExact()
    {
        // search for words

        $this->exactResults = Word::where($this->fieldsToSearch, $this->word)
            ->orderBy('rank', 'desc')->get()->toArray();

        if(count($this->exactResults))
        {
            return;
        }

        $prefix = 'ال';
        // search without ال
        if (substr($this->word, 0, strlen($prefix)) == $prefix)
        {
            $str = substr($this->word, strlen($prefix));
            $this->exactResults = Word::where($this->fieldsToSearch, $str)
                ->orderBy('rank', 'desc')->get()->toArray();
        }
    }

}