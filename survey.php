<?php
    require "./core.php";
    echoHeader();
?>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script>
  $(function() {
    $( "#slider" ).slider({
        min: 1,
        max: 10,
        change: function(event, ui){
            $("#slider-display").html(ui.value);
        }
    });
  });
</script>

<article id="main" style="width:100%;">
    <header>
        <h2>Mentor Maps Survey</h2>
        <h3 style="color:#c1c1c1">Your answers will be collected to improve MentorMaps</h3> 
    </header>
    <section class="wrapper style5" style="width:100%;">
        <div style="display:block;width:100%;text-align:center;margin:auto;padding-top:10px; padding-bottom:10px">
            <h3>Rate your experience</h3>
            <div id="slider-wrapper" style="width:50%;margin:auto;">
                <div id="slider"></div><div id="slider-display"></div>
            </div>
                <script>
                    $("#slider-display").html(ui.value);
                </script>
            <hr />
            <h3>Would you recommend MentorMaps to a friend?</h3>
            <div class="row uniform" style="display: inline-block;">
                <div class="3u 12u$">
                    <input type="radio" id="yes" name="yesno">
                    <label for="yes">Yes</label>

                    <input type="radio" id="no" name="yesno">
                    <label for="no">No</label>
                </div>
            </div>
            <hr />
            <h3 style="padding-top:10px; padding-bottom:10px">What features did you like or use the most?</h3>
            <div align='center' style="padding-top:10px; padding-bottom:10px">
                <input type="text" name="team-name" id="team-name" placeholder="Write Response" style="width: 60%"/>
            </div>
            <hr />
            <h3 style="padding-top:10px; padding-bottom:10px">What features did you dislike or never use?</h3>
            <div align='center' style="padding-top:10px; padding-bottom:10px">
                <input type="text" name="team-name" id="team-name" placeholder="Write Response" style="width: 60%"/>
            </div>
            <hr />
            <h3 style="padding-top:10px; padding-bottom:10px">What features would you like to see added?</h3>
            <div align='center' style="padding-top:10px; padding-bottom:10px">
                <input type="text" name="team-name" id="team-name" placeholder="Write Response" style="width: 60%"/>
            </div>
            </div>
        </section>
    </article>
            <footer id="footer">
                <ul class="copyright">
                    <li>&copy; Joseph Sirna 2015</li>
                </ul>
            </footer>
        </div>
    </body>
</html>