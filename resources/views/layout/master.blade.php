<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ isset($searchWord) ? $searchWord . ' | '  : ''}} {{'أحلى عالم'}}</title>

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    @yield('extra-css')
</head>
<body>
<!-- ***************** NAVBAR ******************** -->
<section>
    <div id="navbar">
        <div class="container">
            <div id="menu" class="pull-right">
                <div class="dropdown">
                    <h5>شاهد الخدمات <i class="fa fa-lg fa-angle-right" aria-hidden="true"></i></h5>
                    <span class="dropdown-toggle" id="menu1" data-toggle="dropdown">
				    	<i class="glyphicon glyphicon-th" aria-hidden="true"></i>
			    	</span>
                    <ul class="dropdown-menu" id="drop-menu" role="menu" aria-labelledby="menu1">
                        <li role="presentation">
                            <a role="menuitem" class="menu-link" tabindex="-1" href="#">
                                <p class="pull-left menu-text text-center">اطلب الترجمة الفورية</p>
                                <span class="menu-icon">
				      				<span class="glyphicon glyphicon-comment"></span>
				      			</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" class="menu-link" tabindex="-1" href="#">
                                <p class="pull-left menu-text text-center">اطلب ترجمة الوثائق</p>
                                <span class="menu-icon">
				      				<span class="glyphicon glyphicon-comment"></span>
				      			</span>

                            </a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" class="menu-link" tabindex="-1" href="#">
                                <p class="pull-left menu-text text-center">لم تجد طلبك!</p>
                                <span class="menu-icon">
				      				<i class="fa fa-info" aria-hidden="true"></i>
				      			</span>

                            </a>
                        </li>
                        <li role="presentation" class="divider">

                        </li>
                        <li role="presentation">
                            <a role="menuitem" class="menu-link" tabindex="-1" href="#">
                                <p class="pull-left menu-text text-center">أعلن معنا</p>
                                <span class="menu-icon">
				      				<span class="glyphicon glyphicon-comment"></span>
				      			</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" class="menu-link" tabindex="-1" href="#">
                                <p class="pull-left menu-text text-center">شاركنا رأيك</p>
                                <span class="menu-icon">
				      				<i class="fa fa-share-alt" aria-hidden="true"></i>
				      			</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" class="menu-link" tabindex="-1" href="#">
                                <p class="pull-left menu-text text-center">من نحن</p>
                                <span class="menu-icon">
				      				<i class="fa fa-info" aria-hidden="true"></i>
				      			</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" class="menu-link" tabindex="-1" href="#">
                                <p class="pull-left menu-text text-center">إتصل بنا</p>
                                <span class="menu-icon">
				      				<span class="glyphicon glyphicon-comment"></span>
				      			</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="brand">
                <img src="{{asset('img/brand.png')}}" class="img-responsive">
            </div>
        </div>
    </div>
</section>

<!-- ***************** END NAVBAR ******************** -->

<!-- ***************** NAV SEARCH ******************** -->
<section>
    <div id="nav-search">
        <div class="container">
            <div class="row">
                <div id="languages" class="col-md-1 col-md-offset-1 col-xs-4">
                    <div class="dropdown">
				    <span class="dropdown-toggle" id="menu2" data-toggle="dropdown">
				    	<i class="glyphicon glyphicon-th" aria-hidden="true"></i>
			    	</span>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu2">
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">English Test</a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">German Test</a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">French Test</a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">Turkey Test</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="current-languages-image" class="col-md-3 col-xs-8">
                    <img class="" src="{{asset('img/de.png')}}">
                    DEUTSCH <span style="color: green;">><</span> ARABIC
                </div>

                <div id="search" class="col-md-5 col-xs-12">
                    <form id="search-form" method="GET" action="{{route('word.search')}}">
                        <input value="{{isset($searchWord) ? $searchWord : ''}}" contenteditable id="main-search" type="text" name="search" placeholder="Search..">
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- ***************** END NAVSEARCH ******************** -->

<div id="body">
    @yield('content')
</div>
<script src="http://code.responsivevoice.org/responsivevoice.js"></script>
@yield('extra-js')
</body>
</html>