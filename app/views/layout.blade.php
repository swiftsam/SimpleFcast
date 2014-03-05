<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Good Judgment Forecasting</title>

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
      <h1>Good Judgment, LLC</h1>
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
      function inputSum(){
        var sum = 0;
        $("input.slider-val").each(function(i,n){
          sum += parseInt($(n).val(),10); 
        });
        return sum;
      }

      function setFcastValue(option, value){
        $("#opt_"+option).val(value);
        $("#slider_opt_"+option).val(value);
      }

      function sumto100(changedInput, inputType){
        // limit input values to [0,100]
        inputVal = parseInt($(changedInput).val(),10)
        if(inputVal > 100){
          setFcastValue($(changedInput).attr("ifp-option"), 100);        
        }
        if(inputVal < 0){
          setFcastValue($(changedInput).attr("ifp-option"), 0);        
        }

        // Check the current sum and adjust bins
        var sum          = inputSum();
        var sumErr       = sum - 100;
        var nUnlocked    = $("input.slider-val.unlocked").length;
        var nCorrectable = $("input.slider-val.unlocked").not(changedInput).length;
        var correction   = -sumErr / nCorrectable;

        $(".slider-val.unlocked").not(changedInput).each(function(i, e){
          var currentVal = parseInt($(e).val(),10);
          var newVal     = Math.round(currentVal + correction);
          setFcastValue($(e).attr("ifp-option"),newVal);
        });

        // Limit current input not to exceed sum 100
        if(inputType == "slider" && inputVal == 100){
          $(".slider-val.unlocked").not(changedInput).each(function(i, e){
            setFcastValue($(e).attr("ifp-option"),0);
          });
        }
        if(inputType == "slider" && (inputSum() > 101 | inputSum() < 99) ){
            var sumErr = inputSum() - 100;
            var newVal = parseInt($(changedInput).val(),10)-sumErr;
            setFcastValue($(changedInput).attr("ifp-option"), newVal);
        }
        if(inputType == "input"){
          var lockedSum = 0;
          $("input.slider-val.locked").not($(changedInput)).each(function(i,n){
            lockedSum += parseInt($(n).val(),10); 
          });
          
          if(lockedSum + inputVal > 100){
            setFcastValue($(changedInput).attr("ifp-option"), 100-lockedSum);  
          }

          if(nUnlocked == 0 && lockedSum + inputVal > 100){
            setFcastValue($(changedInput).attr("ifp-option"), lockedSum-100);  
          }

          var currentSum = inputSum();
          while(currentSum > 100){
            $(".slider-val.unlocked").not(changedInput).each(function(i, e){
              var currentVal = parseInt($(e).val(),10);
              setFcastValue($(e).attr("ifp-option"),Math.max(currentVal-1,0));
            });
            currentSum = inputSum();
          }
        }
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

      function lockOption(option){
        $("#slider_opt_"+option).removeClass("unlocked").addClass("locked");
        $("#opt_"+option).removeClass("unlocked").addClass("locked");
        $("#lock_opt_"+option).removeClass("unlocked").addClass("locked").unbind('click').click(function(){ unlockOption(option);});

      }

      function unlockOption(option){
        $("#slider_opt_"+option).removeClass("locked").addClass("unlocked");
        $("#opt_"+option).removeClass("locked").addClass("unlocked");
        $("#lock_opt_"+option).removeClass("locked").addClass("unlocked").unbind('click').click(function(){ lockOption(option);});
      }

      $(function(){
        // fix for jquery and bootstrap conflict on hidden
        $('.hidden').hide().removeClass('hidden');

        // intialize sliders
        $('.noUiSlider').each(function(){
          var option = $(this).attr("ifp-option");
          $(this).noUiSlider({
            range: [0,100],
            start: [$("#opt_"+option).val()],
            handles:1,
            step:1,
            connect:"lower",
            serialization: {
              to: [ $("#opt_"+option), 'value' ],
                        resolution:1
            },
            slide: function(){sumto100($("#opt_"+option),"slider"); 
                              calcScores();
                              unlockOption(option)},
          });
        });
        calcScores();

        var sliderVals = new Array();
        $("input.slider-val").focus(function(){
          sliderVals[$(this).attr("ifp-option")] = $(this).val();
        })

        $("input.slider-val").blur(function(){ 
          if($(this).val() != sliderVals[$(this).attr("ifp-option")]){
            lockOption($(this).attr("ifp-option"));
          }
          sumto100($(this), "input");
          calcScores();
        })

        $(".glyphicon-lock.unlocked").click(function(){ 
          lockOption($(this).attr("ifp-option"));
        });

        $("#showHideScores").click(function(){
          $("#scores").toggle();
          $(this).text(function(i, text){
            return text === "Show potential scores" ? "Hide potential scores" : "Show potential scores";
        })
        });
      });

    </script>
  </body>
</html>
