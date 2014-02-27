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
    <link href="/css/noui-slider.min.css" rel="stylesheet">
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
      <a href="/">
        <img src="/img/gj_logo_60.png", alt="Good Judgment, LLC">
      </a>
      <h1>Good Judgment<small>,LLC</small></h1>
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
    <script src="/js/noui-slider.min.js"></script>

    <script type="text/javascript">
      function sumto100(){
        var sum = 0;
        $("input.slider-val").each(function(i,n){
          sum += parseInt($(n).val(),10); 
        });
        var sumErr = sum - 100;
        var correction = -Math.ceil(sumErr / ($("input.slider-val").size() - 1))

        $(".slider-val").not($(this)).each(function(i, e){
          var currentVal = $(e).val()*1;
          var newVal = (currentVal += correction*1);
          $(e).val(newVal);
          $("#slider_"+$(e).attr("name")).val(newVal);
        });
      }

      function BrierScore(pArr){
        //assumes that we are scoring the probability in pArr[0]
        var score = 0;
        score += Math.pow(1-pArr[0],2)
        for(var i = 1; i < pArr.length; i++){
          score += Math.pow(pArr[i],2)
        }

        return score;
      }

      function calcScores(){
        $("input.slider-val").each(function(){
          var pArr = new Array();
          pArr[0]=($(this).val()/100);
          $("input.slider-val").not($(this)).each(function(){
            pArr.push($(this).val()/100);
          });
          score = BrierScore(pArr);
          $("#score_"+$(this).attr("name")).html(score.toFixed(3));
        });
      }

      $(function(){
        $('.noUiSlider').each(function(){
          $(this).noUiSlider({
            range: [0,100],
            start: [$("#opt_"+$(this).attr("ifp-option")).val()],
            handles:1,
            step:1,
            connect:"lower",
            serialization: {
              to: [ $("#opt_"+$(this).attr("ifp-option")), 'value' ],
                        resolution:1
            },
            slide: function(){sumto100(); calcScores();},
          });
        });
        calcScores();
      });

      $("input.slider-val").change(function(){
        sumto100();
        calcScores();
      });

    </script>
  </body>
</html>
