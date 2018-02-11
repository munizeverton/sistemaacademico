@extends('template.default')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard de Matrículas</h1>
        <a href="{{route('matriculas.create')}}" class="btn btn-primary">Nova</a><br><br>
    </div>
@endsection