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
        <h3 style="color:#c1c1c1">Your answers will be collected to improve MentorMaps</h3> 
    </header>
    <section class="wrapper style5">
        <div align='center' style="padding-top:10px; padding-bottom:10px">
            <h3>Rate your experience</h3>
            <div id="slider1" class="range-slider" data-slider data-options="step: 1;">
              <span class="range-slider-handle"></span>
              <span class="range-slider-active-segment"></span>
              <input type="hidden">
            </div>
            <hr>
            <h3>Would you recommend MentorMaps to a friend?</h3>
            <div class="row uniform" style="display: inline-block;">
                <div class="3u 12u$">
                    <input type="radio" id="yes" name="yesno">
                    <label for="yes">Yes</label>

                    <input type="radio" id="no" name="yesno">
                    <label for="no">No</label>
                </div>
            </div>
            <hr>
            <h3 style="padding-top:10px; padding-bottom:10px">What features did you like or use the most?</h3>
            <div align='center' style="padding-top:10px; padding-bottom:10px">
                <input type="text" name="team-name" id="team-name" placeholder="Write Response" style="width: 60%"/>
            </div>
            <hr>
            <h3 style="padding-top:10px; padding-bottom:10px">What features did you dislike or never use?</h3>
            <div align='center' style="padding-top:10px; padding-bottom:10px">
                <input type="text" name="team-name" id="team-name" placeholder="Write Response" style="width: 60%"/>
            </div>
            <hr>
            <h3 style="padding-top:10px; padding-bottom:10px">What features would you like to see added?</h3>
            <div align='center' style="padding-top:10px; padding-bottom:10px">
                <input type="text" name="team-name" id="team-name" placeholder="Write Response" style="width: 60%"/>
            </div>
        </div>
    </section>
    <script>
        $(document).foundation();
    </script>
    
</article>

