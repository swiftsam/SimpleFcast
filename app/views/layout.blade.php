<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GJ Simple Forecast</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-sortable.css" rel="stylesheet">
    <link href="/css/simplefcast.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="container">
    <header class="page-header">
      <h1>Good Judgment</h1>
      <nav id="nav">
        <ul class="nav nav-pills">
          <li><a href="/">Dashboard</a></li>
          <li><a href="/questions">Questions</a></li>
          <!--<li><a href="/scores">Scores</a></li>-->
        </ul>
      </nav>
    </header>


    <div id="content">
      @yield('content')
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-sortable.js"></script>
  </body>
</html>
