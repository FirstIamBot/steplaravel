@extends('Library.template')

@section('leftSladeBar')
    <div class="col-2">
        <form id="autorsFind" method="post" action="{{url('findBooks')}}">
            {{ csrf_field() }}
            <div class="row">
                <div>
                    Поиск по автору
                    <input type="text" name="autors_name" id="autors_name" class="form-control input-lg" placeholder="Имя автора" />
                </div>
                <div>
                    <p>
                        <label for="amount" style="text-align: left">Дипазон цен</label>
                        {{--<input type="text" id="price" name="price" readonly style="border:0; color:#f6272f; font-weight:bold;">--}}
                    </p>
                    <p>
                        <label for="amount" style="text-align: left">Минимальная цена</label>
                        <input type="text" id="pricemin" name="pricemin" readonly style="border:0; color:#f6272f; font-weight:bold;"> грн.
                    </p>
                    <p>
                        <label for="amount" style="text-align: left">Макимальная цена</label>
                        <input type="text" id="pricemax" name="pricemax" readonly style="border:0; color:#f6272f; font-weight:bold;">грн.
                    </p>

                    <div id="price-range" ></div>
                </div>

                <div>
                    {{--<p>--}}
                    {{--<label for="amount" >Год издания</label>--}}
                    {{--<input type="text" id="age" name="age" readonly style="border:0; color:#406df6; font-weight:bold;">--}}
                    {{--</p>--}}
                    <p>
                        <label for="amount" >Минимальный год издания</label>
                        <input type="text" id="agemin" name="agemin" readonly style="border:0; color:#f6272f; font-weight:bold;">
                    </p>
                    <p>
                        <label for="amount" >Максимальный год издания</label>
                        <input type="text" id="agemax" name="agemax" readonly style="border:0; color:#f6272f; font-weight:bold;">
                    </p>
                    <div id="age-range"></div>
                </div>
                <button class="btn btn-theme margin top10 pull-left" type="submit">Поиск</button>
            </div>
        </form>

        <div >
        </div>
    </div>
@endsection

@section('content')
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="col-md-8">
        @foreach ($book as $key =>$value)
            <div class="card flex-md-row mb-3 box-shadow h-md-12">
                <img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 480px; height: 100%;" src="{{$value->imageURL}}" data-holder-rendered="true">
                <div class="card-body flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-primary">
                        <h3 align="center">{{$value->name}}</h3>
                    </strong>
                    <h3 class="mb-0">
                        <a class="text-dark" >Описание :</a>
                    </h3>
                    {{--<div class="mb-1 text-muted"> </div>--}}
                    <p class="card-text mb-auto">{{$value->description}}</p>
                    <div class="mb-md-1 text-muted">
                        <p class="card-text">
                            Автор : {{$value->strAutor}}><br>
                            Жанр : {{$value->genre}}<br>
                            Издатество:{{$value->Publishing}}><br>
                            Год : {{$value->YearPublication}}<br>
                            Количествр страниц :{{$value->NumberPages}}<br>
                            Цена : {{$value->price }}грн.<br>
                            <small class="text-muted">{{$key}} num</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('javascript')

    <script type="text/javascript">

        var pricemin = {!! $pricemin !!};
        var pricemax = {!! $pricemax !!};


        $( function() {
            $( "#price-range" ).slider({
                range: true,
                min: pricemin,
                max: pricemax,
                values: [ pricemin, pricemax ],
                slide: function( event, ui ) {
                    $( "#price" ).val( ui.values[ 0 ]+ "грн." + ' - ' + ui.values[ 1 ] + " грн." );
                    $( "#pricemin" ).val( ui.values[ 0 ]);
                    $( "#pricemax" ).val( ui.values[ 1 ]);
                }
            });
            $( "#price" ).val( $( "#price-range" ).slider( "values", 0 ) + " грн." + ' - ' +
                $( "#price-range" ).slider( "values", 1 ) + " грн.");
            $( "#pricemin" ).val( $( "#price-range" ).slider( "values", 0 ));
            $( "#pricemax" ).val( $( "#price-range" ).slider( "values", 1 ));
        } );
    </script>
    {{--Полэунок года выпуска книги мин и макс--}}
    <script>
        var minage = {!! $minage !!};
        var maxage = {!! $maxage !!};

        $( function() {
            $( "#age-range" ).slider({
                range: true,
                min: minage,
                max: maxage,
                values: [ minage, maxage ],
                slide: function( event, ui ) {
                    $("#age").val( ui.values[ 0 ] + " год. " + ' - ' + ui.values[ 1 ] + " - год. " );
                    $("#agemin").val( ui.values[ 0 ]);
                    $("#agemax").val( ui.values[ 1 ]);

                }
            });
            $( "#age" ).val( $("#age-range" ).slider( "values", 0 ) +" год." + ' - ' +
                $( "#age-range").slider( "values", 1 ) + " - год. "  );
            $( "#agemin" ).val( $( "#age-range" ).slider( "values", 0 ));
            $( "#agemax" ).val( $( "#age-range" ).slider( "values", 1 ));
        } );

    </script>
    {{--Поиск авторов Ajax запросом--}}
    <script>
        $(document).ready(function() {
            var _token = $('input[name="_token"]').val();
            $("#autors_name").autocomplete({
                minlength:1,
                autoFocus:true,
                source: function(request, response) {
                    $.ajax({
                        url:"{{ url('/findAuto') }}",
                        method: "POST",
                        data: {
                            _token: _token,
                            autor: request.term,
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
            });
        });

    </script>
    </script>

@endsection