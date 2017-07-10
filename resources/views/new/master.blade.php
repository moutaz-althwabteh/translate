<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ isset($searchWord) ? $searchWord . ' | '  : ''}} {{'متع ذهنك'}}</title>

    <link rel="stylesheet" type="text/css" href="{{asset('new/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('new/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('new/css/bootstrap-rtl.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.css')}}">

    @yield('extra-css')
</head>

<body class="body">
<div class="container-fluid">
    <!---- Header ----->
    <div class="row">
        <div class="col-sm-12 mheader">
        </div>
    </div>
    <!---- End Header ---->

    <!--- Logo --->
    <div class="row">
        <div class="col-sm-12 m-logo" align="center">
            <img src="new/img/logo.png" width="300" height="100" class="img-responsive"/>
        </div>
    </div>
    <!--- End Logo---->
    <!--- menu---->
    <div class="row">
        <div class="col-sm-2">
        </div>

        <div class="col-sm-8">
            <nav class="navbar  navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand " href="#"></a>
                    </div>


                    <div class=" collapse navbar-collapse" id="myNavbar">

                        <ul class="nav navbar-nav navbar-center">
                            <li><a href="#"><span class="glyphicon glyphicon-th"></span></a>
                                <span class=" line"></span>
                            </li>

                            <li><a href="#"><span class="glyphicon glyphicon-home "></span> الصفحة الرئيسية</a>
                            </li>

                            <li><a href="#"><span class=""></span> </a>
                            </li>

                            <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> صفحة الأسئلة
                                    والاجوبة</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-sm-2">
        </div>
    </div>
    <!--- End menu---->
    <!-- Search -->
    <div class="row martop" align="center">
        <div class="col-sm-2">
        </div>

        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6">
                    <div>
                        <form id="search-form" method="GET" action="{{route('word.search')}}">
                            <div class="input-group">
                     <span class="input-group-btn">

                     <button class="btn  serachtxt glyphicon glyphicon-search " type="submit"></button>
                     </span>
                                <input id="main-search" dir="rtl" value="{{isset($searchWord) ? $searchWord : ''}}" name="search"
                                       type="text" class="form-control" placeholder="Search for  ................">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-3">
                    <img src="img/lang.png"  class="img-responsive marto"/>
{{--                    <img src="{{asset('img/lang.png')}}" class="img-responsive marto"/>--}}
                </div>

                <div class="martop  col-sm-2 glyphicon glyphicon-th ">
                </div>
            </div>
        </div>

        <div class="col-sm-2">
        </div>

    </div>
    <!-- end Search -->


<div id="body">
    @yield('content')
</div>
<div class="clearfix"></div>
<div align="center">
    <img src="img/googleplay.png"  class="img img-responsive gooplay"/>
    {{--<img src="{{asset('img/googleplay.png')}}" class="img img-responsive gooplay" alt=""/>--}}
</div>
</div>
<div class="col-sm-1">
</div>
</div>
<div class="clear"></div>
<!-- end Table -->

<!---  footer ---->
{{--<div class="row">--}}
    {{--<div class="col-sm-12 mfooter">--}}
        {{--<div class="right-copy">--}}
            {{--جميع الحقوق محفوظة لشركة الحمو--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<!--- end footer ---->
</div>

<script src="{{asset('new/js/jquery-3.1.0.js')}}"></script>
<script src="{{asset('new/js/bootstrap.js')}}"></script>
<script src="{{asset('new/js/general.js')}}"></script>
<script src="http://code.responsivevoice.org/responsivevoice.js"></script>
<script src="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
<script>

    $( "#main-search" ).autocomplete({
        source: '{{route('ajax.search')}}',
        select: function( event, ui ) {
            $('#main-search').val(ui.item.value);
            $('#search-form').submit();
        }
    });

</script>
@yield('extra-js')
</body>
</html>
