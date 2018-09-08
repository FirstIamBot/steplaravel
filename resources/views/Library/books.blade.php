@extends('Library.template')

@section('leftSladeBar')
    <div class="col-3">
        <div class="list-group">
            @foreach ($genre as $key =>$value)
                {{--<a  class="list-group-item list-group-item-info" href="genre/{{$value->idgenre}}" >{{$value->genre}}</a><br>--}}
                <a  class="list-group-item list-group-item-info" href="{{url('genre')}}/{{$value->idgenre}}" >{{$value->genre}}</a><br>
        @endforeach
        <!--Встаить форму проверки пользователя-->
        </div>
    </div>
@endsection

@section('content')
    <div class="col-9">
            <div class="row">
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
                                    {!! Form::open(array('action' => array('Library\BooksController@showBook', $value->name), 'method' => 'get')) !!}
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
@endsection
