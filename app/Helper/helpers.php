<?php
/**
 * Created by PhpStorm.
 * User: professor
 * Date: 17/06/17
 * Time: 01:56 م
 */
use App\Word;

/**
 * Generates random id
 * @param int $length
 * @param null $model
 * @return string
 */

function generateRandomId($length = 10, $model = null) {
    $chars = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789');
    $newId = '';
    for ($i = 0; $i < $length; $i++) {
        $newId .= $chars[array_rand($chars)];
    }

    if ($model)
    {
        if($model::find($newId))
        {
            $newId = generateRandomId($length,$model);
        }
    }

    // Return the random id.
    return $newId;
}


/**
 * checks if it's an Arabic word
 * @param $word
 * @return bool
 */
function isArabic($word)
{

    // string contains all Arabic alpha
    $arabicAlpha = 'ابتثجحخدذرزسشصضطظعغفقكلمنهويئءؤة';
    // counter to check how many arabic chars within the user's input
    $containsArabic = 0;
    // filter the arabic word
    $word = filterArabicWords($word);
    // split the word to array and check how many arabic chars within
    $wordChars = str_split($word);
    foreach ($wordChars as $char)
    {
        if(strpos($arabicAlpha, $char))
        {
            $containsArabic++;
        }
    }
    if($containsArabic >= 3 || $containsArabic >= strlen($word) / 2)
    {
        return true;
    }
    return false;
}

/**
 * filters Arabic
 * @return mixed
 */
function filterArabicWords($word) {
    //Find values and replace with associated key
    $filters = array(
        'ا' => array('أ', 'إ', 'آ'),
        'ي' => array('ى'),
        'ه' => array('ة'),
        'ء' => array('ئ', 'ؤ','ء'),
        '' => array('ـ', 'ُ', 'ْ', 'َ', 'ِ', 'ّ', '~', 'ٍ', 'ً', 'ٌ'),
        ' ' => array('[', ']', '(', ')', '_', '-', '{', '}', '/', '\\', '.')
    );

    //Loop through the filters we have and call str_replace to replace any confusing chars
    foreach ($filters as $replaceWith => $find) {
        $word = str_replace($find, $replaceWith, $word);
    }

    //Replace 2+ spaces that may occur in the word to only one space
    return  preg_replace("/\s{2,}/", ' ', $word);

}

/**
 * fill database with the words
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
 */
function fillDatabase()
{
    $x = 0;
    $limit = 300;
    while($hello = DB::table('word')->offset($x++ * $limit)->limit($limit)->get())
    {

        foreach ($hello as $item)
        {
//            dd($item->id);
            $word = Word::find($item->id);
//            $word->id = generateRandomId(10, $word);
            $word->arabic = $item->arabic;
            $word->arabic_filtered = filterArabicWords($word->arabic);
            $word->article = $item->article;
            $word->german = $item->german;
            $word->arabic_description = $item->arabic_description;
            $word->german_description = $item->german_description;
            $word->save();
        }
    }

    return redirect(route('words.index'));
}

function fillDatabase2()
{
    $x = 0;
    $limit = 300;
    while($hello = DB::table('word')->offset($x++ * $limit)->limit($limit)->get())
    {

        foreach ($hello as $item)
        {
//            dd($item->id);
            $word = Word::find($item->id);
//            $word->id = generateRandomId(10, $word);
//            $word->arabic = $item->arabic;
//            $word->arabic_filtered = filterArabicWords($word->arabic);
//            $word->article = $item->article;
//            $word->german = $item->german;
//            $word->arabic_description = $item->arabic_description;
//            $word->german_description = $item->german_description;
            $word->german_description_filter=delete_all_between("{","}",$item->german_description);
            $word->save();
        }
    }

    return redirect(route('words.index'));
}

function delete_all_between($beginning, $end, $string) {
    $string=trim($string," ");
    $beginningPos = strpos($string, $beginning);
    $endPos = strpos($string, $end);
    if ($beginningPos === false || $endPos === false) {
        return (delete_all_between2("(",")",$string));
    }

    $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

    return (delete_all_between2("(",")",str_replace($textToDelete, '', $string)));
}
function delete_all_between2($beginning, $end, $string) {
    $string=trim($string," ");
    $beginningPos = strpos($string, $beginning);
    $endPos = strpos($string, $end);
    if ($beginningPos === false || $endPos === false) {
        return $string;
    }

    $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
    return str_replace($textToDelete, '', $string);
}


