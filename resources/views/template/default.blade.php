<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Acadêmico</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    @yield('specific-styles')
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Sistema Acadêmico</a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="/alunos">Alunos <span class="sr-only">(current)</span></a></li>
                <li><a href="/cursos">Cursos</a></li>
                <li><a href="/matriculas">Matriculas</a></li>
            </ul>
        </div>
        @yield('content')
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-notify.min.js"></script>

<script>
    @if(Session::has('flash-message'))
        var type = 'success';
        @if(Session::has('alert-type'))
            type = '{{Session::get('alert-type')}}';
        @endif
        $.notify({
            message: '{{Session::get('flash-message')}}'
        }, {
            type: type,
            placement: {
                align: 'center',
                from: "top"
            }
        });
    @endif
</script>

@yield('specific-scripts')

</body>
</html>