@extends('Library.template')

 @section('leftSladeBar')
    <div class="col-3">
        <div class="list-group">
            @foreach ($genre as $key =>$value)
                <a  class="list-group-item list-group-item-info" href="{{url('genre')}}/{{$value->idgenre}}" >{{$value->genre}}</a><br>
            @endforeach
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
