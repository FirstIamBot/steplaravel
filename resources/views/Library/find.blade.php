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

    <div class="col-9">
        <div class="row">
            @if($books)
            @foreach ($books as $key =>$value)
                <div class="col-md-3">
                    <div class="card md-3 box-shadow">
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="" style="height: 320px; width: 100%; display: block;" src="{{$value->imageURL}}" data-holder-rendered="true">
                        <div class="card-body">
                            <p class="card-text">{{$value->name}}<br>
                                {{$value->strAutor}}<br>
                                Жанр : {{$value->genre}}<br>
                                Издатество:{{$value->Publishing}}<br>
                                Год :{{$value->YearPublication}}<br>
                                Цена :{{$value->price}}грн.<br>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    {!! Form::open(array('action' => array('Library\FindController@findBook', 'autors_name' => $value->name , 'method' => 'get'))) !!}
                                    {!! Form::submit('Просмотреть') !!}
                                    {!! Form::close() !!}
                                </div>
                                <small class="text-muted">{{$key}} num</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <nav>
                <ul class="pagination justify-content-end">
                    {{$books->links('vendor.pagination.bootstrap-4')}}
                </ul>
            </nav>
        </div>
    </div>
    </div>
    @endif

@endsection

@section('javascript')

<script>

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
    });
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

@endsection