<link rel="stylesheet" href="css/foundation.css">
<link rel="stylesheet" href="css/app.css">
<?php
    require "./core.php";
    echoHeader();
?>
  <script src="js/foundation/foundation.js"></script>
  <script src="js/foundation/foundation.slider.js"></script>
  <script src="js/vendor/modernizr.js"></script>
<article id="main">
    <header>
        <h2>Mentor Maps Survey</h2>
    </header>
    <section class="wrapper style5" style="padding-left:10%;">
        <h3>Rate Your Experience</h3>
        <div style="width:25%;">
                <div class="range-slider" data-slider data-options="start: 1; end: 10;">
                    <span class="range-slider-handle" role="slider" tabindex="0"></span>
                    <span class="range-slider-active-segment"></span>
                    <input type="hidden">
                </div>        
        </div>
    </section>
    <script>
        $(document).foundation();
    </script>
    <div style="font-family:'comic sans ms';font-size:50px;color:red;">BRING BACK THE DIVS</div>
</article>
