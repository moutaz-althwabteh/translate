<?php

namespace App\Http\Controllers;

use App\Classes\ArabicWordHandler;
use App\Classes\GermanWordHandler;
use App\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tstController extends Controller
{
    public function index()
    {
//        set_time_limit(1000);
//        fillDatabase2();

       return view('layout.master');


    }
    public function search(Request $request)
    {

        if(!$request->has('search') || !trim($request->search))
        {
            return view('words.index');
        }

        $searchWord = trim($request->search);
        if (isArabic($searchWord)) {
            $wordHandler = new ArabicWordHandler(new Word(), $searchWord, 'arabic_filtered');
        } else {
            $wordHandler = new GermanWordHandler(new Word(), $searchWord, 'german');
        }

        $words = $wordHandler->handleWord();

        $counter = 0;
        return view('words.index', compact( 'words', 'counter','searchWord'));
    }

    public function ajaxSearch(Request $request)
    {
        // check if there is an input
        if(!$request->has('term') || !trim($request->term))
        {
            return;
        }
        // remove the spaces
        $word = trim($request->term);
        // if it's arabic or german
        if (isArabic($word))
        {
            // get all arabic words that matches
            $wordHandler = new ArabicWordHandler(new Word(), $word, 'arabic_filtered');
            $words = $wordHandler->handleWord();
            $data = $this->prepareDataForAjax($words, 'arabic');
        }
        else
        {

            $wordHandler = new GermanWordHandler(new Word(), $word, 'german');
            $words = $wordHandler->handleWord();

            $data = $this->prepareDataForAjax($words, 'german');

        }

        return array_unique($data);

    }

    /**
     *
     * prepares data for auto complete
     * @param $words
     * @param $kind
     * @return array
     */
    public function prepareDataForAjax($words, $kind)
    {
        $data = array();

        foreach ($words['exact'] as $word)
        {
            if(isset($word[$kind]))
                array_push($data, $word[$kind]);
        }
//        dd($words['close']);
//        foreach ($words['close'] as $word)
//        {
//            if(isset($word[$kind]))
//                array_push($data, $word[$kind]);
//        }

        return $data;
    }

}
