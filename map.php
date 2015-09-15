<?php
$unbiased = false;
$noaccount = false;
if(isset($_GET['opt'])){
    if($_GET['opt'] == 'unbiased'){
        $unbiased = true;
    } else if($_GET['opt'] == 'noaccount'){
        $noaccount = true;
    }
}

function utf8_converter($array){
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
            $item = utf8_encode($item);
        }
    });
    return $array;
}

require "./db.php";
$address_array = array();

if(!$noaccount){
    require "./logincheck.php";
    //get the logged in user's account type from the session variable
    $email = $_SESSION['email'];
    $sql = "SELECT `TYPE` FROM `logins` WHERE `EMAIL` = '$email'";
    $type = "UNDEFINED";
    $result = $db->query($sql);
    while($r=mysqli_fetch_assoc($result)){
        $type = $r['TYPE'];
    }
    //get the user's address
    $sql = "SELECT `ADDRESS` FROM `data` WHERE `EMAIL` = '$email'";
    $my_address = "UNDEFINED";
    $result = $db->query($sql);
    while($r=mysqli_fetch_assoc($result)){
        $my_address=$r['ADDRESS'];
    }
    //store all of the opposite kinds of addresses
    if($unbiased==false){
        if($type=="MENTOR"){
            echo '<!--you are a mentor, displaying all results for teams-->';
            $sql = "SELECT `ADDRESS` FROM `data` WHERE ACCOUNT_TYPE = 'TEAM';";
        }else{
            echo '<!--you are a team, displaying all results for mentors-->';
            $sql = "SELECT `ADDRESS` FROM `data` WHERE ACCOUNT_TYPE = 'MENTOR';";
        }
    }else{
        echo '<!--you are using an unbiased map, displaying all results in db-->';
        $sql = "SELECT `ADDRESS` FROM `data`;";
    }
}else{
    $sql = "SELECT `ADDRESS` FROM `data`;";
}

$result = $db->query($sql);
while($r=mysqli_fetch_assoc($result)){
    array_push($address_array, $r['ADDRESS']);
}

$verif_data = array();
$result=$db->query("SELECT * FROM `logins`");
while($r=mysqli_fetch_assoc($result)){
    if($r['VERIFIED']=='true'){
        array_push($verif_data, $r['EMAIL']);
    }
}

if(!$noaccount){
    if(!in_array($_SESSION['email'], $verif_data)){
        echo '<script>alert("Warning: your account is not verified. please verify your account to show up on the map.");</script>';
    }
}

//populate an array with the entire database's contents so they can be accessed in javascript
$result=$db->query("SELECT * FROM `data`;");
$all_data = array();
while($r=mysqli_fetch_assoc($result)){
    $current = array(
        'name'          => $r['NAME'],
        'skills_json'   => $r['SKILLS_JSON'],
        'team_number'   => $r['TEAM_NUMBER'],
        'comments'      => $r['COMMENTS'],
        'phone'         => $r['PHONE'],
        'email'         => $r['EMAIL'],
        'address'       => $r['ADDRESS'],
        'type'          => $r['TYPE'],
        'experience'    => $r['AGE'],
        'account_type'  => $r['ACCOUNT_TYPE'],
    );
    if(in_array($current['email'], $verif_data))
        array_push($all_data, $current);
}

$geoLookup = array();
$r=$db->query("SELECT LATITUDE, LONGITUDE, ADDRESS FROM `data`;");
while($i=mysqli_fetch_assoc($r)){
    $current = array(
        'latitude' => $i['LATITUDE'],
        'longitude' => $i['LONGITUDE'],
        'address' => $i['ADDRESS']
    );
    array_push($geoLookup, $current);
}

echo '<script>var marker_map = [];</script>';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <style>
            .driving-button {
                content:url('./img/ic_directions_car_white_48dp_2x.png');
            }

            .driving-button:hover{
                content:url('./img/ic_directions_car_red_48dp_2x.png');
            }

            .open-profile{
                content:url("./img/ic_open_in_new_white_48dp_2x.png");
            }

            .open-profile:hover{
                content:url("./img/ic_open_in_new_red_48dp_2x.png");
            }

            .li-team-tile{
                color:#191919;
                background-color:#FFFFFF;
                padding: .2em 1em;
                border: 2px solid #191919;
                margin:0 0 7px 0;
            }

            .li-team-tile:hover{
                background-color:#E8E8E8;
                border-color:#303030;
            }

            #map-canvas {
                height:100%;
            }
        </style>
        <link rel="shortcut icon" href="http://mentormaps.net/favicon.ico"/>
        <title>
            Mentor Maps
        </title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <script src="compare.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAiDYjxvrOGR6epXYDkO3XaZeT37OEix_Q"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <script>
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;
        function recenterMap(address){
            var Flat = 0;
            var Flng = 0;
            $.each(geoLookup, function(key, value){
                var geoLocation = geoLookup[key];
                if(address==geoLocation.address){
                    Flat = parseFloat(geoLocation.latitude);
                    Flng = parseFloat(geoLocation.longitude);
                }
            });
            if(Flat==0||Flng==0||isNaN(Flat)||isNaN(Flng)){
                Flat = 0;
                Flng = 0;
                alert("error getting lat/lng from geolookup array");
            }
            map.setCenter(new google.maps.LatLng(Flat, Flng), 2);
        }
        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            map = new google.maps.Map(document.getElementById('map-canvas'),{zoom: 11});
            directionsDisplay.setMap(map);
            <?php
            if($noaccount){
                echo 'centerMapNoAccount(map, 33.878652, -117.997470);';
            }else{
                if(!$unbiased){
                    echo 'centerMap(map, "'. $my_address .'");';
                }else{
                    echo 'centerMapNoAccount(map, 33.878652, -117.997470);';
                }
            }
                
            ?>
            directionsDisplay.setMap(map);
            <?php
                $allteams = array();
                foreach($address_array as $address){
                    $teamjson = "UNDEFINED";
                    $sql = "SELECT * FROM `data` WHERE `ADDRESS` = '$address';";
                    $result=$db->query($sql);
                    if($result==false){
                        break;
                    }
                    while($r=mysqli_fetch_assoc($result)){
                        $a = array(
                                'name'                  => $r['NAME'        ],
                                'searching_skills_json' => $r['SKILLS_JSON' ],
                                'team_number'           => $r['TEAM_NUMBER' ],
                                'comments'              => $r['COMMENTS'    ],
                                'phone'                 => $r['PHONE'       ],
                                'email'                 => $r['EMAIL'       ],
                                'address'               => $r['ADDRESS'     ],
                                'type'                  => $r['TYPE'        ],
                                'account_type'          => $r['ACCOUNT_TYPE']
                            );
                        if(in_array($a['email'], $verif_data))
                            array_push($allteams, $a);
                        $teamjson = json_encode(utf8_converter($a));
                    }
                    if(in_array($a['email'], $verif_data))
                        echo 'marker_map.push(codeAddress(map, "'.$address.'", '.$teamjson.'));'. PHP_EOL;
                }
            ?>
        }

        function calcRoute(start, end) {
            var request = {
                origin: start,
                destination: end,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(result);
                }
            });
        }
        
    function centerMapNoAccount(map, lat, lng){
        map.setCenter(new google.maps.LatLng(lat, lng), 2);
    }

    function centerMap(map, address){
        var Flat = 0;
        var Flng = 0;
        $.each(geoLookup, function(key, value){
            var geoLocation = geoLookup[key];
            if(address==geoLocation.address){
                Flat = parseFloat(geoLocation.latitude);
                Flng = parseFloat(geoLocation.longitude);
            }
        });
        map.setCenter(new google.maps.LatLng(Flat, Flng), 2);

        var marker = new google.maps.Marker({
            map: map,
            position: {lat: Flat, lng: Flng},
            icon: './img/mentorflag.png'
        });
        var infowindow = new google.maps.InfoWindow({
            content: "Your location"
        });
        google.maps.event.addListener(marker, 'mouseover', function() {
            infowindow.open(map, this);
        });
        google.maps.event.addListener(marker, 'mouseout', function() {
            infowindow.close();
        });
    }
    function codeAddress(map, address, teamdata) {
        var typedata = $.parseJSON(teamdata['type']);
        var iconurl = "./img/undef.png";
        console.log(teamdata);
        if(teamdata['account_type']=='TEAM'){
            if(typedata['ftc']=='true'){
                iconurl = 'img/white.png';
            }
            if(typedata['fll']=='true'){
                iconurl = 'img/blue.png';
            }
            if(typedata['frc']=='true'){
                iconurl = 'img/red.png';
            }
            if(typedata['vex']=='true'){
                iconurl = 'img/orange.png';
            }
        }else{
            //the does1 variable checks whether the account is affiliated with more than one type (FRC & FTC, VEX & FRC, etc)
            var does1 = false;
            if(typedata['ftc']=='true'){
                does1 = true;
                iconurl = 'img/whitem.png';
            }
            if(typedata['fll']=='true'){
                if(does1==true){
                    iconurl = 'img/greenm.png';
                }else{
                    does1 = true;
                    iconurl = 'img/bluem.png';
                }
            }
            if(typedata['frc']=='true'){
                if(does1==true){
                    iconurl = 'img/greenm.png';
                }else{
                    does1 = true;
                    iconurl = 'img/redm.png';
                }
            }
            if(typedata['vex']=='true'){
                if(does1==true){
                    iconurl = 'img/greenm.png';
                }else{
                    does1 = true;
                    iconurl = 'img/orangem.png';
                }
            }
        }
        var Flat = 0;
        var Flng = 0;
        $.each(geoLookup, function(key, value){
            var geoLocation = geoLookup[key];
            if(address==geoLocation.address){
                Flat = parseFloat(geoLocation.latitude);
                Flng = parseFloat(geoLocation.longitude);
            }
        });
        var marker = new google.maps.Marker({
            map: map,
            position: {lat: Flat, lng: Flng},
            icon: iconurl
        });
        var infowindow = new google.maps.InfoWindow({
            content: "" + teamdata['name'] + ", " + teamdata['team_number']
        });
      
        google.maps.event.addListener(marker, 'click', function(){
            $("#img-container").html("");
            if(typedata['fll']=='true'){
                document.getElementById("img-container").innerHTML += "<img src=\"img/fll.png\" width=\"160px\" height=\"160px\" style=\"padding-left:1%;\"/>";
            }
            if(typedata['ftc']=='true'){
                document.getElementById("img-container").innerHTML += "<img src=\"img/ftc.png\" width=\"160px\" height=\"160px\" style=\"padding-left:1%;\"/>";
            }
            if(typedata['frc']=='true'){
                document.getElementById("img-container").innerHTML += "<img src=\"img/frc.png\" width=\"160px\" height=\"160px\" style=\"padding-left:1%;\"/>";
            }
            if(typedata['vex']=='true'){
                document.getElementById("img-container").innerHTML += "<img src=\"img/vex.png\" width=\"160px\" height=\"160px\" style=\"padding-left:1%;\"/>";
            }
            document.getElementById("team-info-label").innerHTML = '<div style="font-size:24px;display:inline;"><img onclick="calcRoute(\'<?php echo $my_address; ?>\', \''+address+'\');" class="driving-button"/></div><a href="./profile.php?p='+teamdata['email']+'" target="_blank"><img class="open-profile"/></a>';
            
            var searchingFor = "";
            var ssjson = $.parseJSON(teamdata['searching_skills_json']);
            $.each(ssjson, function(key, value){
                if(key == 'skill-other'){
                        searchingFor = searchingFor + "other ("+teamdata['other_detail']+")";
                }else{
                    if(value=='true'){
                        searchingFor = searchingFor + key + "<br />";
                    }
                }
            });
            });
            google.maps.event.addListener(marker, 'mouseover', function() {
                infowindow.open(map, this);
            });
            google.maps.event.addListener(marker, 'mouseout', function() {
                infowindow.close();
            });

            return {'address': address, 'marker': marker};
        }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    </head>
    <body>
        <div id="page-wrapper">
                <header id="header">
                    <h1>
                        <a href="./index.php">
                            Mentor Maps
                        </a>
                    </h1>
                        <nav id="nav">
                             <ul>
                                <li class="special">
                                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                                    <div id="menu">
                                        <ul>
                                            <li>
                                                <a href="./profile.php">
                                                    Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="./dashboard.php">
                                                    Dashboard
                                                </a>
                                            </li>
                                            <li>
                                                <a href="./survey.php">
                                                    Survey
                                                </a>
                                            </li>
                                            <li>
                                                <?php if(!$unbiased){ ?>
                                                <a href="./map.php?opt=unbiased">
                                                    (advanced) view unbiased map
                                                </a>
                                                <?php }else{ ?>
                                                <a href="./map.php">
                                                    view regular map
                                                </a>
                                                <?php } ?>
                                            </li>
                                            <li>
                                                <a href="./logout.php">
                                                    Log Out
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </header>
                    <article id="footer" style="padding-top:30px;">
                        <div id="maybe-this-will-work-wrapper"><!--holy crap, it worked-->
                            <div id="map-and-search-wrapper" style="display:inline-block;width:100%;color:black;">
                                <div id="team-list-wrapper">
                                    <script>
                                        document.getElementById('team-list-wrapper').setAttribute('style', 'text-align:left;height:' + parseInt(parseInt(window.innerHeight) - parseInt((window.innerHeight / 4))) + "px" + ";float:left;background-color:teal;width:15%;color:white;");
                                    </script>
                                    <ul style="margin: 0;padding: 0;list-style-type:none;line-height:2em;overflow:scroll;overflow-x:hidden;height:100%;" id="team-list">
                                        <!--li team elements go here (appended with javascript)-->
                                    </ul>
                                </div>
                                <div id="search-wrapper">
                                    <script>
                                        document.getElementById('search-wrapper').setAttribute('style', 'height:' + parseInt(parseInt(window.innerHeight) - parseInt((window.innerHeight / 4))) + "px" + ";text-align: center;float:right;background-color:teal;width:15%;color:white;text-align:left;");
                                        function updateRangeDisplay(){
                                            $("#range-display").html($("#slidey-thing").val());
                                        }
                                    </script>
                                    <div style="line-height:2em;overflow:scroll;overflow-x:hidden;height:100%;">
                                        <ul style="list-style-type:none;" id="list-thing">
                                            <li>
                                                Search Filter
                                            </li>
                                            <li>
                                                Range <input id="slidey-thing" type="range" max="99" min="1" onchange="updateRangeDisplay();"/><div id="range-display" style="display:inline;">50</div>
                                            </li>
                                            <li>
                                                <button onclick="refreshListing();">
                                                    Update List
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>                        
                                <div id="map-section">
                                    <script>
                                        document.getElementById("map-section").style.height= window.innerHeight - (window.innerHeight / 4) + "px";
                                    </script>
                                    <div id="map-canvas"></div>
                                </div>
                            </div>
                            <script>
                                <?php
                                    echo 'var alldata = ' . json_encode(utf8_converter($all_data)) . ';' . PHP_EOL;
                                    echo 'var allteams = ' . json_encode(utf8_converter($allteams)) . ';' . PHP_EOL;
                                    echo 'var geoLookup = ' . json_encode(utf8_converter($geoLookup)) . ';' . PHP_EOL;
                                ?>

                                var rad = function(x) {
                                    return x * Math.PI / 180;
                                };

                                var getDistance = function(p1lat, p1lng, p2lat, p2lng) {
                                    var R = 6378137; // Earth’s mean radius in meter
                                    var dLat = rad(p2lat - p1lat);
                                    var dLong = rad(p2lng - p1lng);
                                    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(rad(p1lat)) * Math.cos(rad(p2lat)) * Math.sin(dLong / 2) * Math.sin(dLong / 2);
                                    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                                    var d = R * c;
                                    return ((d * 3.28) / 5280); // returns the distance in miles you damn commie
                                };
                                <?php if(!$noaccount){ ?>
                                var me;
                                for(var i=0;i<alldata.length;i++){
                                    var current_item = alldata[i];
                                    if(current_item['address'] == '<?php echo $my_address; ?>'){
                                        me = current_item;
                                        break;
                                    }
                                }
                                <?php } ?>
                    
                                var globalRet = 0;//workaround because the return statement below doesn't do what it's supposed to
                                function getLatLngArrayFromAddress(address){
                                    $.each(geoLookup, function(key, value){
                                        var geoLocation = geoLookup[key];
                                        if(address==geoLocation.address){
                                            var Flat = parseFloat(geoLocation.latitude);
                                            var Flng = parseFloat(geoLocation.longitude);
                                            var ret = {latitude : Flat, longitude : Flng};
                                            globalRet = ret;
                                            return ret;
                                        }
                                    });
                                }
                    
                                function listTeams(){
                                    $("#team-list").html("");
                                    for(var i=0;i<allteams.length;i++){
                                        var team = allteams[i];
                                        $("#team-list").append("<li onclick='recenterMap(\""+team['address']+"\");' class='li-team-tile'>"+(i+1)+" | "+team['name']+"</li>");
                                    }
                                }

                                function refreshListing(){
                                    $("#team-list").html("");
                                        var teamscore_map = [];
                                        for(var i=0;i<allteams.length;i++){
                                            var team = allteams[i];
                                            <?php if(!$noaccount){ ?>
                                                var searchingfor = $.parseJSON(me['skills_json']);
                                            <?php }else{ ?>
                                                var searchingfor = {};
                                            <?php } ?>
                                            var offered = $.parseJSON(team['searching_skills_json']);
                                            var p1array = getLatLngArrayFromAddress(team['address']);
                                            var p1lat = globalRet.latitude;//TODO find out why the return statement doesn't work
                                            var p1lng = globalRet.longitude;
                                            <?php if(!$noaccount){ ?>
                                                var p2array = getLatLngArrayFromAddress(me['address']);
                                                var p2lat = globalRet.latitude;
                                                var p2lng = globalRet.longitude;
                                            <?php }else{ ?>
                                                var p2lat = 33.878652;
                                                var p2lng = -117.997470;
                                            <?php } ?>
                                            var distance = getDistance(p1lat, p1lng, p2lat, p2lng);
                                            if(!(distance > $("#slidey-thing").val())){
                                                var process_teamtype = $.parseJSON(me['type']);
                                                var process_mentortypes = $.parseJSON(team['type']);
                                                var teamtype;
                                                var mentortypes = [];
                                                for(var e in process_mentortypes){
                                                    if(process_mentortypes[e]=='true'){
                                                        mentortypes.push(e);
                                                    }
                                                }
                                                for(var e in process_teamtype){
                                                    if(process_teamtype[e]=='true'){
                                                        teamtype = e;
                                                        break;
                                                    }
                                                }
                                                var distance_weight = 6.4;
                                                var compare_result = compare(searchingfor, offered, teamtype, mentortypes, distance, distance_weight);
                                                teamscore_map.push({team, compare_result});
                                            }
                                        }
                        
                                        var comparator = function(a,b){
                                            return b.compare_result - a.compare_result;
                                        };
                        
                                        teamscore_map = teamscore_map.sort(comparator);
                        
                                        console.log(teamscore_map);

                                        var teamListIndex = 0;
                                        console.log("teamscore_map length: " + teamscore_map.length);
                                        for(var teamscore_map_index in teamscore_map){
                                            var team = teamscore_map[teamscore_map_index]['team'];
                                            var result = teamscore_map[teamscore_map_index].compare_result;
                                            if(result != 0 && !isNaN(result)){
                                                teamListIndex++;
                                                $("#team-list").append("<li onclick='recenterMap(\""+team['address']+"\");' class='li-team-tile'>"+teamListIndex+" | "+team['name']+"</li>");
                                                console.log("marker_map length: " + marker_map.length);
                                                $.each(marker_map, function(key, value){
                                                var m = marker_map[key];
                                                if(m.address==team.address){
                                                    m.marker.setIcon("http://googlemapsmarkers.com/v1/"+teamListIndex+"/0066FF");
                                                }
                                            });
                                        }
                                    }
                                }
                                $(document).ready(function() {
                                    <?php if($noaccount){ ?>
                                        listTeams();
                                    <?php }else{ ?>
                                        refreshListing();
                                    <?php } ?>
                                });
                            </script>
                        </div>
                    <style>
                        .paddedImgHolder{
                            padding-top:10px;
                        }
                    </style>
                    <?php if(isset($type)){
                            if($type=="TEAM"){ ?>
                        <div style="width:100%;background-color:teal;height:62px;"><img class="paddedImgHolder" src="img/redm.png"/>FRC | <img class="paddedImgHolder" src="img/whitem.png"/> FTC | <img class="paddedImgHolder" src="img/bluem.png"/>FLL | <img class="paddedImgHolder" src="img/orangem.png" /> VEX | <img class="paddedImgHolder" src="img/greenm.png" /> MULTI</div>
                      <?php }else{ ?>
                        <div style="width:100%;background-color:teal;height:62px;"><img class="paddedImgHolder" src="img/red.png"/>FRC | <img class="paddedImgHolder" src="img/white.png"/> FTC | <img class="paddedImgHolder" src="img/blue.png"/>FLL | <img class="paddedImgHolder" src="img/orange.png" /> VEX</div>
                      <?php }
                          }else{
                            ?>
                            <div style="width:100%;background-color:teal;height:62px;"><img class="paddedImgHolder" src="img/red.png"/>FRC | <img class="paddedImgHolder" src="img/white.png"/> FTC | <img class="paddedImgHolder" src="img/blue.png"/>FLL | <img class="paddedImgHolder" src="img/orange.png" /> VEX</div>
                            <?php
                          } ?>
                        <div style="white-space:nowrap;">
                            <div class="inner" id="team-info" style="padding-top:20px;text-align:center;">
                                <section id="team-info-section">
                                    <div id="team-info-label"></div>
                                    <div class="row uniform">
                                        <div class="12u 12u$(small)" id="img-container"></div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <br/>
                        <button onclick="window.location = './survey.php';">
                            Take Our Survey
                        </button>
                    </article>
                    <footer id="footer">
                        <ul class="copyright">
                            <li>
                                &copy; FRC Team 3309, 2015
                            </li>
                        </ul>
                    </footer>
            </div>
    </body>
</html>