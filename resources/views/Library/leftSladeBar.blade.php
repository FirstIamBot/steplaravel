
@section('leftSladeBar')
    <div class="col-3">
        <div class="list-group">
            @foreach ($genre as $key =>$value)
                <a  class="list-group-item list-group-item-info" href="{{url('genre')}}/{{$value->idgenre}}" >{{$value->genre}}</a><br>
            @endforeach
        <!--Встаить форму проверки пользователя-->
        </div>
    </div>
@endsection