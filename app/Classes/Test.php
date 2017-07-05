<?php
/**
 * Created by PhpStorm.
 * User: Moutaz
 * Date: 7/5/2017
 * Time: 8:41 PM
 */

namespace App\Classes;


use App\Word;
use Illuminate\Database\Eloquent\Model;

class Test extends parentClass
{
    public $wordModel;
    public function __construct(Model $wordModel, $word, $field)
    {
        $this->wordModel = $wordModel;
        $this->word = $word;
        $this->fieldsToSearch = $field;

        $wordsFromBeginning = Word::where($field, 'LIKE', $word."%")->get();
//        dd(  $this->wordModel);
    }
    function get(){
        dd($this->wordModel);
        $wordsFromBeginning = ($this->wordModel)::where($this->fieldsToSearch, 'LIKE', $this->wordModel."%")->get();
    }

}