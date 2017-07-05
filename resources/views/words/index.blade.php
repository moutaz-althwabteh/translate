@extends('layout.master')
<!-- ***************** SEARCH RESULTS ******************** -->
@section('content')
<section>
	<div id="search-result">
		<div class="container">
			@if(isset($words))
				@if(isset($words['suggestion']))
					<h1 class="text-center text-danger">{{"$searchWord"}} NOT FOUND :(</h1>
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
				@if(!isset($words['suggestion']))
					@foreach($words['exact'] as $word)
					<div class="row single-row-translation single-{{$counter++ % 2 == 0? 'orange' : 'white'}}">
						<div class="col-md-4 col-md-offset-1 col-xs-12 text-left col-sm-4">
							<i class="fa fa-volume-up" aria-hidden="true" style="margin-right: 5px"></i>
							<a href="{{route('word.search', ['search'=>$word['german']])}}">
								<span>{{$word['article']}}</span>
								<span>{{$word['german'] . ' '}} </span>
								<span style="display: inline-block">{{$word['german_description']}}</span>
							</a>
						</div>
						<div class="col-md-2 col-xs-12 col-sm-4">
							<div class="row">
								<div class="col-md-4 col-xs-4">
									<i class="fa fa-plus-square-o fa-lg" id="collapse-row"
									   aria-hidden="true" data-toggle="collapse" data-target="#{{$word['id']}}">
									</i>
								</div>
								<div class="col-md-3 col-xs-offset-1 col-xs-3">
									<div id="dots" class="text-center" data-toggle="collapse" data-target="#{{$word['id']}}">
										<i class="fa fa-ellipsis-h fa-lg" id="dots-row" aria-hidden="true"></i>
									</div>
								</div>
								<div class="col-md-4 col-xs-4">
									<div id="bars" class="pull-right">
										<span class="small-bar background-colored-bars"></span>
										<span class="medium-bar background-colored-bars"></span>
										<span class="larg-bar background-black-bars"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-md-offset-1 col-xs-12 text-right col-sm-4">
							<a href="{{route('word.search', ['search'=>$word['arabic']])}}">
								<span style="display: inline-block;">
								{{$word['arabic_description'] . ' '}}
								</span>
								<span>{{$word['arabic']}}</span>
							</a>
							<i class="fa fa-volume-up fa-rotate-180" aria-hidden="true" style="margin-left: 5px"></i>
						</div>
					</div>
					<div class="row single-row-translation single-green  collapse" id="{{$word['id']}}">
						<div class="col-md-4 col-xs-2 col-sm-3"></div>
						<div class="col-md-1 col-xs-2 col-sm-1">
							<div class="pull-right">
								<i class="fa fa-thumbs-down unlike-word" aria-hidden="true"></i>
							</div>
						</div>
						<div class="col-md-2 col-xs-4 col-sm-4">
							<h4 style="" class="text-center">شاهد الأمثلة</h4>
						</div>
						<div class="col-md-1 col-xs-2 col-sm-2">
							<i class="fa fa-thumbs-up like-word" aria-hidden="true"></i>
						</div>
					</div>
					@endforeach
					@if(isset($words['close']))
						<h5 class="text-right">كلمات مشابهة</h5>
						@foreach($words['close'] as $word)
						<div class="row single-row-translation single-{{$counter++ % 2 == 0? 'orange' : 'white'}}">
							<div class="col-md-4 col-md-offset-1 col-xs-12 text-left col-sm-4">
								<i class="fa fa-volume-up" aria-hidden="true" style="margin-right: 5px"></i>
								<a href="{{route('word.search', ['search'=>$word['german']])}}">
									<span>{{$word['german'] . ' '}} {{$word['german_description']}}</span>
								</a>
							</div>
							<div class="col-md-2 col-xs-12 col-sm-4">
								<div class="row">
									<div class="col-md-4 col-xs-4">
										<i class="fa fa-plus-square-o fa-lg" id="collapse-row"
										   aria-hidden="true" data-toggle="collapse" data-target="#{{$word['id']}}">
										</i>
									</div>
									<div class="col-md-3 col-xs-offset-1 col-xs-3">
										<div id="dots" class="text-center" data-toggle="collapse" data-target="#{{$word['id']}}">
											<i class="fa fa-ellipsis-h fa-lg" id="dots-row" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4 col-xs-4">
										<div id="bars" class="pull-right">
											<span class="small-bar background-colored-bars"></span>
											<span class="medium-bar background-colored-bars"></span>
											<span class="larg-bar background-black-bars"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-md-offset-1 col-xs-12 text-right col-sm-4">
								<a href="{{route('word.search', ['search'=>$word['arabic']])}}">
									<span style="display: inline-block;">
									{{$word['arabic_description'] . ' '}}
									</span>
									<span>{{$word['arabic']}}</span>
								</a>
								<i class="fa fa-volume-up fa-rotate-180" aria-hidden="true" style="margin-left: 5px"></i>
							</div>
						</div>
						<div class="row single-row-translation single-green  collapse" id="{{$word['id']}}">
							<div class="col-md-4 col-xs-2 col-sm-3"></div>
							<div class="col-md-1 col-xs-2 col-sm-1">
								<div class="pull-right">
									<i class="fa fa-thumbs-down unlike-word" aria-hidden="true"></i>
								</div>
							</div>
							<div class="col-md-2 col-xs-4 col-sm-4">
								<h4 style="" class="text-center">شاهد الأمثلة</h4>
							</div>
							<div class="col-md-1 col-xs-2 col-sm-2">
								<i class="fa fa-thumbs-up like-word" aria-hidden="true"></i>
							</div>
						</div>
						@endforeach
					@endif
				@endif
			@endif
		</div>
		</div>
</section>
@stop
<!-- ***************** END SEARCH RESULTS ******************** -->
@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.css')}}">
@stop
@section('extra-js')
	<script src="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
	{{--<script>--}}

        {{--$( "#main-search" ).autocomplete({--}}
            {{--source: '{{route('ajax.search')}}',--}}
            {{--select: function( event, ui ) {--}}
            	{{--$('#search-form').submit();--}}
            {{--}--}}
        {{--});--}}
	{{--</script>--}}
	<script src="{{asset('js/right-left-search.js')}}"></script>
@stop