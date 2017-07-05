<?php

namespace App\Http\Controllers;

use App\Classes\ArabicWordHandler;
use App\Classes\GermanWordHandler;
use App\Word;
use Illuminate\Http\Request;

class tstController extends Controller
{
    public function index()
    {
//        fillDatabase();
//        (delete_all_between("{","}","szdas {dwa}"));
       return view('words.index');

    }
    public function search(Request $request)
    {

        if(!$request->has('search') || !trim($request->search))
        {
            return view('words.index');
        }

        $searchWord = trim($request->search);
        if (isArabic($searchWord)) {
            $wordHandler = new ArabicWordHandler(new Word(), $searchWord, 'arabic');
        } else {
            $wordHandler = new GermanWordHandler(new Word(), $searchWord, 'german');
        }

        $words = $wordHandler->handleWord();

        $counter = 0;
        return view('words.index', compact( 'words', 'counter','searchWord'));
    }
}
