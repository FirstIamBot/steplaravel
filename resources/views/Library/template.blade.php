{{--****************** Заголовок страницы ***********************--}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Library Laravel') }}</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
    <!--    Bootstrap 4-->
    <!-- Latest compiled and minified CSS  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    {{--<title>{{ config('app.name', 'Liblary') }}</title>--}}
    {{--<!-- Styles -->--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div>

{{--******************  Навигационное меню  ***********************************--}}
<nav class="navbar navbar-dark bg-dark">
    <!-- Навигационный бар -->
    <a class="navbar-brand" href="{{ url('/') }}">Главная</a>
    <a class="navbar-brand" href="{{ url('/library') }}">Библиотека</a>
    <a class="navbar-brand" href="{{ url('/autor') }}">Автора</a>
    <a class="navbar-brand" href="{{ url('/finds') }}">Поиск</a>
    <a class="navbar-brand" href="{{ url('/about') }}">О нас</a>
</nav>
<br>
<div class="container">
    <div class="row">
{{-- ****************** Вывод LeftSlideBar ************************************--}}
        @yield('leftSladeBar')
{{--@section('leftSladeBar') --}}
{{-- @show --}}
{{--****************** Вывод основной иформации (books, book) ******************--}}
        @yield('content')
    </div>
</div>
{{--******************************* вывод футера  ******************************--}}

<div class="row">
    <div class="col-3">
        <h4>Наши контакты</h4>
        <ul class="list">
                        <li class="first">г. Николаев,ул. Лягина 4</li>
                        <li class="last">Телефоны:   </li>
                        <li class="last">+38 (0512) 67-00-53</li>
                        <li class="last">+38 (067) 557-87-05</li>
                        <li class="last">+38 (050) 443-61-00</li>
                    </ul>
    </div>
    <div class="col-3">
                    <h4>О Компании</h4>
                    Вот дом.<br>
                    Который построил Джек.<br>
                    А это пшеница.<br>
                    Которая в тёмном чулане хранится<br>
                    В доме,<br>
                    Который построил Джек.<br>
                </div>
    <div class="col-3">
        <h4> Ещё раз О Компании</h4>
             А это весёлая птица-синица,<br>
             Которая ловко ворует пшеницу,<br>
             Которая в тёмном чулане хранится<br>
             В доме,<br>
             Который построил Джек.<br>
        </div>
    <div class="col-3">
                    <h4>И снова О Компании</h4>
                    Вот кот,<br>
                    Который пугает и ловит синицу,<br>
                    Которая ловко ворует пшеницу,<br>
                    Которая в тёмном чулане хранится<br>
                    В доме,<br>
                    Который построил Джек.<br>
                </div>
    </div>
    <div class="col-3">
        <a href="https://nikolaev.itstep.org/">Академиия ШАГ "Николаев"</a> &copy; 2018</a>
    </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src = "https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
{{--Полэунок цены книги мин и макс--}}
    @yield('javascript')

{{--Отправка данных фильтров для вывода книг не работает--}}
        {{--<script>--}}
                {{--$(document).ready(function(){--}}
                    {{--$('#autorsFind').on('submit', function(e){--}}
                        {{--e.preventDefault();--}}
                        {{--var _token = $('input[name="_token"]').val();--}}
                        {{--$.post( "{{url('findAutors')}}", {--}}
                            {{--_token: _token,--}}
                            {{--autor    : $('#autors_name').val(),--}}
                            {{--agemin   : $("#age-range" ).slider( "values", 0 ),--}}
                            {{--agemax   : $("#age-range" ).slider( "values", 1 ),--}}
                            {{--pricemin : $("#price-range" ).slider( "values", 0 ),--}}
                            {{--pricemax : $("#price-range" ).slider( "values", 1 )--}}
                        {{--} );--}}
                    {{--});--}}
                {{--});--}}
        {{--</script>--}}
</body>
</html>
