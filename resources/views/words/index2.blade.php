@extends('new.master')
<!-- ***************** SEARCH RESULTS ******************** -->
@section('content')
    <div class="row martop">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <div class="rect">
                @if(isset($words))
                    @if(isset($words['suggestion']))
                        <h1 class="text-center text-danger">لايوجد نتيجة لكلمة : {{"$searchWord"}} </h1>
                        @if(count($words['suggestion']))
                            <h4 class="text-center"> هل تقصد </h4>
                            <h5 class="text-center">
                                @foreach($words['suggestion'] as $word)
                                    {{" "}}
                                    <a href="{{route('word.search',
								 ['search' => $words['kind'] == 'german' ? $word->german : $word->arabic ])}}" class="not-found">
                                        {{$words['kind'] == 'german' ? $word->german : $word->arabic . ' '}}
                                    </a>
                                @endforeach
                            </h5>
                        @endif
                     @endif
                @endif
                @if(!isset($words['suggestion']))
                        <table class="table table-responsive  ">
                        @foreach($words['exact'] as $word)

                                <tr class="{{$counter++ % 2 == 0? 'm-color' : 'm-noncolor'}}">
                                    <td class="right">

                                        <button class="btn btn-link" onclick="responsiveVoice.speak('{{$word['arabic']}}','Arabic Male')"><span class="glyphicon glyphicon-volume-up"></span></button>
                                        <a href="{{route('word.search', ['search'=>$word['arabic']])}}">
                                        <span class="title">{{$word['arabic']}}</span>
                                        <span>{{$word['arabic_description'] . ' '}}</span>
                                        </a>
                                    </td>
                                    <td class="" >
                                        <a href="{{route('word.search', ['search'=>$word['german']])}}">
{{--                                            <span>{{$word['german_description	'] . ' '}}</span>--}}
                                        <span dir="ltr">{{$word['german_description'] . ' '}} </span>
                                        <span class="title">{{$word['article']}} {{$word['german'] . ' '}}</span>
                                        </a>
                                        <button class="btn btn-link" onclick="responsiveVoice.speak('{{$word['german']}}','Deutsch Female')"><span class="glyphicon glyphicon-volume-up"></span></button>


                                    </td>
                                </tr>

                        @endforeach
                            @if(isset($words['close']))
                                @if(count($words['close']))
                                <tr>
                                    <td colspan="2"><h3 class="text-primary  text-center">كلمات مشابهة</h3></td>
                                </tr>
                                @endif
                                @foreach($words['close'] as $word)
                                    <tr class="{{$counter++ % 2 == 0? 'm-color' : 'm-noncolor'}}">
                                        <td class="">
                                                <button class="btn btn-link" onclick="responsiveVoice.speak('{{$word['arabic']}}','Arabic Male')"><span class="glyphicon glyphicon-volume-up"></span></button>
                                            <a href="{{route('word.search', ['search'=>$word['arabic']])}}">
                                                <span class="title">{{$word['arabic']}}</span>
                                                <span>{{$word['arabic_description'] . ' '}}</span>
                                            </a>
                                        </td>
                                        <td class="" >
                                            <a href="{{route('word.search', ['search'=>$word['german']])}}">
                                                <span dir="ltr">{{$word['german_description'] . ' '}} </span>
                                                <span class="title">{{$word['article']}} {{$word['german'] . ' '}}</span>
                                            </a>
                                                <button class="btn btn-link" onclick="responsiveVoice.speak('{{$word['german']}}','Deutsch Female')"><span class="glyphicon glyphicon-volume-up"></span></button>
                                        </td>
                                    </tr>

                                @endforeach
                             @endif

                        </table>

                @endif


                {{--<table class="table table-responsive  ">--}}
                    {{--<tr class="m-color">--}}
                        {{--<td class="">--}}
                            {{--<span class="glyphicon glyphicon-volume-up"></span>--}}
                            {{--<span class="title">ذهب</span>--}}
                            {{--<span>{فعل}</span> </td>--}}
                        {{--<td class="">--}}
                            {{--<span dir="ltr">{verb gegengen}</span>--}}
                            {{--<span class="title">gehen</span>--}}
                            {{--<span class="glyphicon glyphicon-volume-up"></span>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr class="m-noncolor">--}}
                        {{--<td class="">--}}
                            {{--<span class="glyphicon glyphicon-volume-up"></span>--}}
                            {{--<span class="title">ذهب</span>--}}
                            {{--<span>{فعل}</span> </td>--}}
                        {{--<td class="">--}}
                            {{--<span dir="ltr">{verb gegengen}</span>--}}
                            {{--<span class="title">gehen</span>--}}
                            {{--<span class="glyphicon glyphicon-volume-up"></span>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--</table>--}}
            </div>
        </div>
    </div>
@endsection