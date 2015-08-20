<?php
require "./logincheck.php";
if($_SERVER['REQUEST_METHOD']=='GET'){
    require "./core.php";
    $email = $_SESSION['email'];
    echoHeader();
?>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script>
var exp = 1;

function redirect(){
    window.location = "./index.php";
}

function submit(){
    var experience = exp;
    var yf = document.getElementById("yes").checked;
    var email = '<?php echo $email; ?>';
    var recFriend = true;
    if(yf!=true){
        recFriend = false;
    }

    var why                 = document.getElementById("why").value;
    var recFeatures         = document.getElementById("recFeaturesField").value;
    var dislikedFeatures    = document.getElementById("dislikedFeaturesField").value;
    var toAddFeatures       = document.getElementById("toAddFeaturesField").value;

$.ajax({
    url: './survey.php',
    type: 'POST',
    data : {
        'why' : why,
        'recFeatures' : recFeatures,
        'dislikedFeatures' : dislikedFeatures,
        'toAddFeatures' : toAddFeatures,
        'recFriend' : recFriend,
        'email' : email
    },
    success:function(data){
        document.getElementById("page-section").innerHTML = "<div align=\"center\">Reponse Recorded&nbsp;<button onclick='redirect();'>OK</button></div>";
    }
});


}

  $(function() {
    $( "#slider" ).slider({
        min: 1,
        max: 10,
        change: function(event, ui){
            $("#slider-display").html(ui.value + " / 10");
            exp = ui.value;
        }
    });
  });
</script>

<article id="main" style="width:100%;">
    <header>
        <h2>Mentor Maps Survey</h2>
        <h3 style="color:#c1c1c1">Your answers will be collected to improve MentorMaps</h3> 
    </header>
    <section id="page-section" class="wrapper style5" style="width:100%;">
        <div style="width:100%;text-align:center;margin:auto;padding-top:10px;padding-bottom:10px">
            <h3>Rate your experience</h3>
            <div id="slider-wrapper" style="width:50%;margin:auto;">
                <div id="slider"></div><div id="slider-display"></div>
            </div>
                <script>
                    $("#slider-display").html("1 / 10");
                </script>
            <hr />
            <h3>Would you recommend MentorMaps to a friend?</h3>
            <div class="row uniform" style="text-align:center;display:inline-block;">
                <div class="12u 12u$">
                    <input type="radio" id="yes" name="yesno"/>
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="yesno"/>
                    <label for="no">No</label>
                    <textarea type="text" id="why" placeholder="Why?" rows="2"></textarea>
                </div>
                
                <script>
                    $("#why").hide();
                    
                    $("#no").change(function(){
                        $("#why").show();
                    });
                    $("#yes").change(function(){
                        $("#why").hide();
                    });
                </script>
            </div>
            <hr />
            <h3 style="padding-top:10px; padding-bottom:10px">What feature did you like or use the most?</h3>
            <div style="padding-top:10px; padding-bottom:10px;text-align:center;display:inline-block;">
                <select id="recFeaturesField">
                    <option value="" disabled selected style="display:none;">Please Choose</option>
                    <option value="algorithm">Team/Mentor Compatibility Algorithm</option>
                    <option value="sponsor_filter">Search by Sponsor Filter</option>
                    <option value="map">Map to see teams/mentors in your area.</option>
                    <option value="messaging">Messaging System</option>
                </select>
            </div>
            <hr />
            <h3 style="padding-top:10px; padding-bottom:10px">What feature did you dislike or never use?</h3>
            <div style="padding-top:10px; padding-bottom:10px;text-align:center;display:inline-block;">
                <select id="dislikedFeaturesField">
                    <option value="" disabled selected style="display:none;">Please Choose</option>
                    <option value="algorithm">Team/Mentor Compatibility Algorithm</option>
                    <option value="sponsor_filter">Search by Sponsor Filter</option>
                    <option value="map">Map to see teams/mentors in your area.</option>
                    <option value="messaging">Messaging System</option>
                </select>
            </div>
            <hr />
            <h3 style="padding-top:10px; padding-bottom:10px">What features would you like to see added?</h3>
            <div align='center' style="padding-top:10px; padding-bottom:10px">
                <textarea type="text" name="team-name" id="toAddFeaturesField" placeholder="Write Response" style="width: 60%"></textarea>
            </div>
            <button id="submit" onclick="submit();" class="button">submit</button>
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
<?php
}else{
require "./db.php";

//get vars from POST
$recFriend = $_POST['recFriend'];
$recFeatures = $_POST['recFeatures'];
$toAddFeatures = $_POST['toAddFeatures'];
$dislikedFeatures = $_POST['dislikedFeatures'];
$email = $_POST['email'];
$why = $_POST['why'];

//make sure we're not being attacked by mysql escaping the strings
$recFeatures = mysql_escape_mimic($recFeatures);
$toAddFeatures = mysql_escape_mimic($toAddFeatures);
$dislikedFeatures = mysql_escape_mimic($dislikedFeatures);
$why = mysql_escape_mimic($why);

$recFeatures = str_replace("<script", "im a dirty little hacker: ", $recFeatures);
$toAddFeatures = str_replace("<script", "im a dirty little hacker: ", $toAddFeatures);
$dislikedFeatures = str_replace("<script", "im a dirty little hacker: ", $dislikedFeatures);
$why = str_replace("<script", "im a dirty little hacker: ", $why);

if($why==""){
    $why = "NULL";
}

//add the result as a new row
$sql = "INSERT INTO `survey_results` (WHY, EMAIL, REC_FRIEND, TO_ADD_FEATURES, REC_FEATURES, DISLIKED_FEATURES) VALUES ('$why', '$email', '$recFriend', '$toAddFeatures', '$recFeatures', '$dislikedFeatures');";
file_put_contents("./query.txt", $sql);
$db->query($sql);
echo '{"status":"queried successfully"}';
}
?>