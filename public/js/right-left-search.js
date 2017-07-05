
rightToLeft();
$('#main-search').keyup(function () {
    rightToLeft();
});
function rightToLeft()
{
    var arabicAlpha = 'ابتثجحخدذرزسشصضطظعغفقكلمنهويئءؤة';
    if(arabicAlpha.indexOf($('#main-search').val()[0]) !== -1)
    {
        $('#main-search').addClass('text-right');
    }
    else
    {
        $('#main-search').removeClass('text-right');
    }
}