<?php
/**
 * Created by PhpStorm.
 * User: professor
 * Date: 19/06/17
 * Time: 03:25 م
 */

namespace App\Classes;


use App\Word;
use Illuminate\Database\Eloquent\Model;

class GermanWordHandler extends WordHandler
{

    /**
     * WordHandler constructor.
     * @param Model $wordModel
     * @param $word
     * @param $field
     */
    public function __construct(Word $wordModel, $word, $field)
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

        // if we got nothing search for close results as do you mean?
        $this->searchExact();

        $ids = array();
        foreach ($this->exactResults as $result)
        {
            array_push($ids, $result['id']);
        }
        $this->searchForCloseWords($ids);
        if(!count($this->exactResults) && !count($this->closeResults))
        {
            $this->suggestWords();
            $data['suggestion'] = $this->suggestResults;
            $data['kind'] = 'german';
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

        $this->exactResults = Word::Where('german_description', 'LIKE', "%$this->word%")
            ->orderBy('rank', 'desc')->limit(10)->get()->toArray();
    }


}