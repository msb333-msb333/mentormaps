<?php
$unbiased = false;
$noaccount = false;
if (isset($_GET['opt'])) {
    if ($_GET['opt'] == 'unbiased') {
        $unbiased = true;
    } else if ($_GET['opt'] == 'noaccount') {
        $noaccount = true;
    }
}

function utf8_converter($array){
    array_walk_recursive($array, function (&$item, $key) {
        if (!mb_detect_encoding($item, 'utf-8', true)) {
            $item = utf8_encode($item);
        }
    });
    return $array;
}

require "./db.php";
$address_array = array();

if (!$noaccount) {
    require "./logincheck.php";
    //get the logged in user's account type from the session variable
    $email = $_SESSION['email'];
    $type = "UNDEFINED";
    $result = $db->query("SELECT `TYPE` FROM `logins` WHERE `EMAIL` = '$email'");
    while ($r = mysqli_fetch_assoc($result)) {
        $type = $r['TYPE'];
    }
    //get the user's address
    $my_address = "UNDEFINED";
    $result = $db->query("SELECT `ADDRESS` FROM `data` WHERE `EMAIL` = '$email'");
    while ($r = mysqli_fetch_assoc($result)) {
        $my_address = $r['ADDRESS'];
    }
} else {
    $my_address = "";
}

$verif_data = array();
$result = $db->query("SELECT * FROM `logins`");
while ($r = mysqli_fetch_assoc($result)) {
    if ($r['VERIFIED'] == 'true') {
        array_push($verif_data, $r['EMAIL']);
    }
}

if (!in_array($_SESSION['email'], $verif_data) && !$noaccount) {
    echo '<script>alert("Warning: your account is not verified. please verify your account to show up on the map.");</script>';
}

//populate an array with the entire database's contents so they can be accessed in javascript
$result = $db->query("SELECT * FROM `data`;");
$all_data = array();
while ($r = mysqli_fetch_assoc($result)) {
    $current = array(
        'name' => $r['NAME'],
        'skills_json' => $r['SKILLS_JSON'],
        'team_number' => $r['TEAM_NUMBER'],
        'comments' => $r['COMMENTS'],
        'phone' => $r['PHONE'],
        'email' => $r['EMAIL'],
        'address' => $r['ADDRESS'],
        'type' => $r['TYPE'],
        'experience' => $r['AGE'],
        'account_type' => $r['ACCOUNT_TYPE']
    );
    if (in_array($current['email'], $verif_data))
        array_push($all_data, $current);
}

$geoLookup = array();
$r = $db->query("SELECT LATITUDE, LONGITUDE, ADDRESS FROM `data`;");
while ($i = mysqli_fetch_assoc($r)) {
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
        .legend{
            height:3em;
            width:100%;
            background-color: teal;
            display:block;
            margin:0 0 0 0;/*yeah, a negative margin. don't judge; css is hard*/
            padding:0;
        }
        .driving-button {
            content: url("./img/ic_directions_car_white_48dp_2x.png");
        }

        .driving-button:hover {
            content: url("./img/ic_directions_car_red_48dp_2x.png");
        }

        .open-profile {
            content: url("./img/ic_open_in_new_white_48dp_2x.png");
        }

        .open-profile:hover {
            content: url("./img/ic_open_in_new_red_48dp_2x.png");
        }

        .team-name{
            /*for once these ui designers know what a real font looks like*/
            /*font-family:'comic sans ms';*/

            font-family:'verdana';
            color: #191919;
            background-color: #FFFFFF;
            padding: .2em 1em;
            border: 5px solid #191919;
            margin: 0 0 7px 0;

        }

        .team-info-label{
            font-size:24px;
            display:inline;
        }

        .paddedImgHolder {
            padding: 0.2em 0 0 0;
        }

        .li-team-tile {
            color: #191919;
            background-color: #FFFFFF;
            padding: .2em 1em;
            border: 2px solid #191919;
            margin: 5px 5px 5px 5px;
            border-radius: 10px;
            cursor:pointer;
        }

        .li-team-tile:hover {
            background-color: #E8E8E8;
            border-color: #303030;
        }

        .result-list{
            text-align:left;
            height:100%;
            float:left;
            background-color: teal;
            width:15%;
            color:white;
            margin: 0;
            padding: 0;
            list-style-type:none;
            cursor:default;
            line-height:2em;
            overflow:scroll;
            overflow-x:hidden;
            overflow-y:auto;
        }

        .search-filter{
            cursor:default;
            line-height:2em;
            overflow:scroll;
            overflow-x:hidden;
            height:100%;
            margin: 0;
            padding: 0;
            float:right;
            background-color: teal;
            width:15%;
            color:white;
            list-style-type:none;
            overflow-y:auto;
        }

        #map-and-search-wrapper{
            display:inline-block;
            width:100%;
            color:black;
            height:75vh;
            padding:0;
            margin:0;
        }

        .toggler {
            cursor:pointer;
        }

        .toggler:hover{
            background:rgba(255, 255, 255, 0.2);
        }

        .img-padding{
            width:160px;
            height:160px;
            padding-left:1%;
        }

        .frc-image{
            content:url('./img/frc.png');
        }

        .vex-image{
            content:url('./img/vex.png');
        }

        .ftc-image{
            content:url('./img/ftc.png');
        }

        .fll-image{
            content:url('./img/fll.png');
        }

        #map-canvas {
            height:100%;
        }
    </style>
    <link rel="shortcut icon" href="https://mentormaps.net/favicon.ico"/>
    <title>
        Mentor Maps
    </title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://mentormaps.net/assets/css/main.css"/>
    <script src="https://mentormaps.net/compare.js"></script>
    <script src="https://mentormaps.net/assets/js/jquery.min.js"></script>
    <script src="https://mentormaps.net/assets/js/jquery.scrollex.min.js"></script>
    <script src="https://mentormaps.net/assets/js/jquery.scrolly.min.js"></script>
    <script src="https://mentormaps.net/assets/js/skel.min.js"></script>
    <script src="https://mentormaps.net/assets/js/util.js"></script>
    <script src="https://mentormaps.net/assets/js/main.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiDYjxvrOGR6epXYDkO3XaZeT37OEix_Q"></script>
    <!--[if lte IE 8]><script src="https://mentormaps.net/assets/js/ie/html5shiv.js"></script><![endif]-->
    <!--[if lte IE 8]><script src="https://mentormaps.net/assets/js/ie/respond.min.js"></script><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="https://mentormaps.net/assets/css/ie8.css"/><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="https://mentormaps.net/assets/css/ie9.css"/><![endif]-->
    <script>
        <?php
        echo 'var alldata = ' . json_encode(utf8_converter($all_data)) . ';' . PHP_EOL;
        echo 'var geoLookup = ' . json_encode(utf8_converter($geoLookup)) . ';' . PHP_EOL;
        ?>
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;

        var me = "not found";
        for (var i = 0; i < alldata.length; i++) {
            var current_item = alldata[i];
            if (current_item['address'] == '<?php echo $my_address; ?>') {
                me = current_item;
                break;
            }
        }

        //case if the me variable is not matched to an entry in the database
        if(me == "not found"){
            me = {
                'name' : 'no_account',
                'skills_json': 'no_account',
                'team_number': 'no_account',
                'comments': 'no_account',
                'phone': 'no_account',
                'email': 'no_account',
                'address': 'no_account',
                'type': 'no_account',
                'experience': 'no_account',
                'account_type': 'no_account'
            };
        }

        function recenterMap(address) {
            var Flat = 0;
            var Flng = 0;
            $.each(geoLookup, function (key, value) {
                var geoLocation = geoLookup[key];
                if (address == geoLocation.address) {
                    Flat = parseFloat(geoLocation.latitude);
                    Flng = parseFloat(geoLocation.longitude);
                }
            });
            if (Flat == 0 || Flng == 0 || isNaN(Flat) || isNaN(Flng)) {
                Flat = 0;
                Flng = 0;
                alert("error getting lat/lng from geolookup array");
            }
            map.setCenter(new google.maps.LatLng(Flat, Flng));
            map.setZoom(16);
        }
        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            map = new google.maps.Map(document.getElementById('map-canvas'), {zoom: 11});
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
            for(var index in alldata){
                var dataEntry = alldata[index];
                if(dataEntry.address != '<?php echo $my_address; ?>') {
                    marker_map.push(codeAddress(map, dataEntry.address, dataEntry));
                }
            }
        }

        function calcRoute(start, end) {
            var request = {
                origin: start,
                destination: end,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function (result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(result);
                }
            });
        }

        function centerMapNoAccount(map, lat, lng) {
            map.setCenter(new google.maps.LatLng(lat, lng), 2);
        }

        function centerMap(map, address) {
            var Flat = 0;
            var Flng = 0;
            $.each(geoLookup, function (key, value) {
                var geoLocation = geoLookup[key];
                if (address == geoLocation.address) {
                    Flat = parseFloat(geoLocation.latitude ),
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
            google.maps.event.addListener(marker, 'mouseover', function () {
                infowindow.open(map, this);
            });
            google.maps.event.addListener(marker, 'mouseout', function () {
                infowindow.close();
            });
        }

        function showDetails(teamEmail){
            for(var index in alldata){
                var team = alldata[index];
                if(team['email']==teamEmail){
                    var typedata = $.parseJSON(team.type);
                    $('#img-container').html('');
                    if (typedata['fll'] == 'true') {
                        $('#img-container').html($('#img-container').html() + "<img class='img-padding fll-image'/>");
                    }
                    if (typedata['ftc'] == 'true') {
                        $('#img-container').html($('#img-container').html() + "<img class='img-padding ftc-image'/>");
                    }
                    if (typedata['frc'] == 'true') {
                        $('#img-container').html($('#img-container').html() + "<img class='img-padding frc-image'/>");
                    }
                    if (typedata['vex'] == 'true') {
                        $('#img-container').html($('#img-container').html() + "<img class='img-padding vex-image'/>");
                    }
                    $('#team-info-label').html('<div class="team-info-label"><div class="team-name">'+team['name']+'</div><img onclick="calcRoute(\'<?php echo $my_address; ?>\', \'' + team['address'] + '\');" class="driving-button"/></div><a href="./profile.php?p=' + team['email'] + '" target="_blank"><img class="open-profile"/></a>');
                }
            }
        }

        function codeAddress(map, address, teamdata) {
            var typedata = $.parseJSON(teamdata.type);
            var iconurl = "./img/undef.png";
            if (teamdata['account_type'] == 'TEAM') {
                if (typedata['ftc'] == 'true') {
                    iconurl = 'img/white.png';
                }
                if (typedata['fll'] == 'true') {
                    iconurl = 'img/blue.png';
                }
                if (typedata['frc'] == 'true') {
                    iconurl = 'img/red.png';
                }
                if (typedata['vex'] == 'true') {
                    iconurl = 'img/orange.png';
                }
            } else {
                //the does1 variable checks whether the account is affiliated with more than one type (FRC & FTC, VEX & FRC, etc)
                var does1 = false;
                if (typedata['ftc'] == 'true') {
                    does1 = true;
                    iconurl = 'img/whitem.png';
                }
                if (typedata['fll'] == 'true') {
                    if (does1 == true) {
                        iconurl = 'img/greenm.png';
                    } else {
                        does1 = true;
                        iconurl = 'img/bluem.png';
                    }
                }
                if (typedata['frc'] == 'true') {
                    if (does1 == true) {
                        iconurl = 'img/greenm.png';
                    } else {
                        does1 = true;
                        iconurl = 'img/redm.png';
                    }
                }
                if (typedata['vex'] == 'true') {
                    if (does1 == true) {
                        iconurl = 'img/greenm.png';
                    } else {
                        does1 = true;
                        iconurl = 'img/orangem.png';
                    }
                }
            }
            var Flat = 0;
            var Flng = 0;
            $.each(geoLookup, function (key, value) {
                var geoLocation = geoLookup[key];
                if (address == geoLocation.address) {
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

            google.maps.event.addListener(marker, 'click', function () {
                showDetails(teamdata['email']);
            });
            google.maps.event.addListener(marker, 'mouseover', function () {
                infowindow.open(map, this);
            });
            google.maps.event.addListener(marker, 'mouseout', function () {
                infowindow.close();
            });

            return {'address': address, 'marker': marker};
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        function updateRangeDisplay() {
            $("#range-display").html($("#slidey-thing").val());
        }

        function profileRedirect(profile){
            window.location = './profile.php?p=' + profile;
        }
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
                                <?php if (!$unbiased) { ?>
                                    <a href="./map.php?opt=unbiased">
                                        (advanced) view unbiased map
                                    </a>
                                <?php } else { ?>
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
    <article class="wrapper style4" style="padding-top:0;text-align:center;">
        <div id="map-and-search-wrapper">
            <ul class="result-list" id="team-list">
                <!--li team elements go here (appended with javascript)-->
            </ul>

            <ul class="search-filter" id="list-thing">
                <li>
                    Search Filter
                </li>
                <li>
                    Range <input id="slidey-thing" type="range" max="99" min="1" onchange="updateRangeDisplay();" />
                    <div id="range-display" style="display:inline;">
                        50
                    </div>
                </li>
                <li>
                    <div class="toggler" onclick="$('#prog_aff_list').toggle();">Program Affiliation</div>
                    <ul id="prog_aff_list">
                        <input type="checkbox" id="frc"/>
                        <label for="frc">FRC</label>
                        <input type="checkbox" id="ftc"/>
                        <label for="ftc">FTC</label>
                        <input type="checkbox" id="fll"/>
                        <label for="fll">FLL</label>
                        <input type="checkbox" id="vex"/>
                        <label for="vex">VEX</label>
                        <script>
                            var types = $.parseJSON(me.type);
                            for(type in types){
                                if(types[type] == 'true'){
                                    $("#"+type).prop("checked", true);
                                }
                            }
                            $('#prog_aff_list').toggle();
                        </script>
                    </ul>

                </li>
                <li>
                    <div class="toggler" onclick="$('#exp_list').toggle();">Experience</div>
                    <ul id="exp_list">
                        <?php if($type=="TEAM"){ ?>
                            <input id="exp_slider" type="range" min="1" max="10" onchange="updateExpDisplay();"/>
                            <script>var acct = "team";</script>
                        <?php }else{ ?>
                            <input id="exp_slider" type="range" min="0" max="1" onchange="updateExpDisplay();"/>
                            <script>var acct = "mentor";</script>
                        <?php } ?>
                        <div id="exp_display"></div><div id="details_display"></div>
                        <script>
                            function updateExpDisplay(){
                                var exp = $("#exp_slider").val();
                                if(acct=='team') {
                                    $("#details_display").html(exp > 1 ? ' years of experience' : ' year of Experience');
                                    $("#exp_display").html(exp);
                                }else{
                                    $("#exp_display").html(exp==0 ? 'Rookie Team' : 'Experienced Team');
                                }
                            }

                            $('#exp_list').toggle();
                        </script>
                    </ul>
                </li>
                <li>
                    <button onclick="refreshListing();">
                        Update List
                    </button>
                </li>
            </ul>

            <div id="map-canvas"></div>
        </div>
        <script>
            var rad = function (x) {
                return x * Math.PI / 180;
            };

            var getDistance = function (p1lat, p1lng, p2lat, p2lng) {
                var R = 6378137; // Earth’s mean radius in meter
                var dLat = rad(p2lat - p1lat);
                var dLong = rad(p2lng - p1lng);
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(rad(p1lat)) * Math.cos(rad(p2lat)) * Math.sin(dLong / 2) * Math.sin(dLong / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c;
                return ((d * 3.28) / 5280); // returns the distance in miles you damn commie
            };

            function getLatLngArrayFromAddress(address) {
                var ret = {lat:33.878652, lng:-117.997470};//default lat & lng
                $.each(geoLookup, function (key, value) {
                    var geoLocation = geoLookup[key];
                    if (address == geoLocation.address) {
                        ret = {latitude: parseFloat(geoLocation.latitude), longitude: parseFloat(geoLocation.longitude)};
                    }
                });
                return ret;
            }

            function listTeams(){
                $("#team-list").html("");
                for(var i=0;i<alldata.length;i++){
                    var team = alldata[i];
                    $("#team-list").append("<li onclick='recenterMap(\""+team['address']+"\");' class='li-team-tile'>"+(i+1)+" | "+team['name']+"</li>");
                }
            }

            function getSpecifiedTypes(){
                var ret = {};
                var types = [
                    'frc',
                    'ftc',
                    'fll',
                    'vex'
                ];
                for(var index in types){
                    var type = types[index];
                    ret[type] = $("#"+type).is(":checked");
                }
                return ret;
            }

            function refreshListing() {
                if(me.type=='no_account'){
                    alert("your account was not paired in the database so the compatability algorithm will not work");
                    listTeams();
                }else {
                    $('#team-list').html("");
                    var teamscore_map = [];
                    for (var i = 0; i < alldata.length; i++) {
                        var team = alldata[i];
                        if (!(team.address == '<?php echo $my_address; ?>') && team.account_type != me.account_type) {
                            var searchingfor = $.parseJSON(me['skills_json']);
                            var offered = $.parseJSON(team['skills_json']);
                            var p1array = getLatLngArrayFromAddress(team['address']);
                            var p1lat = p1array.latitude;
                            var p1lng = p1array.longitude;
                            var p2array = getLatLngArrayFromAddress(me['address']);
                            var p2lat = p2array.latitude;
                            var p2lng = p2array.longitude;
                            var distance = getDistance(p1lat, p1lng, p2lat, p2lng);

                            if (!(distance > $("#slidey-thing").val())) {
                                var myTypes = [];
                                var theirTypes = [];

                                var prelim_myTypes = getSpecifiedTypes();
                                for(var index in prelim_myTypes){
                                    var type = prelim_myTypes[index];
                                    if(type == true){
                                        myTypes.push(index);
                                    }
                                }

                                var prelim_theirTypes = $.parseJSON(team.type);
                                for(var index in prelim_theirTypes){
                                    var type = prelim_theirTypes[index];
                                    if(type == 'true'){
                                        theirTypes.push(index);
                                    }
                                }

                                var distance_weight = 1;
                                var compare_result = compare(searchingfor, offered, myTypes, theirTypes, distance, distance_weight);
                                if(!isNaN(team.experience)){
                                    mul = team.experience;
                                }
                                if($("#exp_display").html()==team.experience){
                                    mul = 100;
                                }else{
                                    mul = 1;
                                }
                                if(mul==0||mul<0||isNaN(mul)&&'team'=='<?php echo $type; ?>'){
                                    mul = 0.1;
                                }
                                var res = (compare_result * mul);
                                teamscore_map.push({team: team, compare_result: res});
                            }
                        }
                    }
                    var comparator = function (a, b) {
                        return b.compare_result - a.compare_result;
                    };

                    teamscore_map = teamscore_map.sort(comparator);

                    var teamListIndex = 0;
                    for (var teamscore_map_index in teamscore_map) {
                        var team = teamscore_map[teamscore_map_index]['team'];
                        var result = teamscore_map[teamscore_map_index].compare_result;
                        if (result != 0 && !isNaN(result)) {
                            teamListIndex++;
                            $("#team-list").append("<li onclick='recenterMap(\"" + team['address'] + "\");showDetails(\"" + team['email'] + "\");' class='li-team-tile'>" + (teamListIndex) + " | " + team['name'] + "</li>");
                            $.each(marker_map, function (key, value) {
                                var m = marker_map[key];
                                if (m.address == team.address) {
                                    m.marker.setIcon("https://googlemapsmarkers.com/v1/" + teamListIndex + "/0066FF");
                                }
                            });
                        }
                    }
                }
            }
            $(document).ready(function () {
                <?php if($noaccount){ ?>
                    listTeams();
                <?php }else{ ?>
                    refreshListing();
                <?php } ?>
            });
        </script>
        <?php

        function echoTeamLegend(){
            echo '<div class="legend"><img class="paddedImgHolder" src="img/redm.png"/>FRC | <img class="paddedImgHolder" src="img/whitem.png"/> FTC | <img class="paddedImgHolder" src="img/bluem.png"/>FLL | <img class="paddedImgHolder" src="img/orangem.png"/> VEX | <img class="paddedImgHolder" src="img/greenm.png"/> MULTI</div>';
        }

        function echoMentorLegend(){
            echo '<div class="legend"><img class="paddedImgHolder" src="img/red.png"/>FRC | <img class="paddedImgHolder" src="img/white.png"/> FTC | <img class="paddedImgHolder" src="img/blue.png"/>FLL | <img class="paddedImgHolder" src="img/orange.png"/> VEX</div>';
        }

        if (isset($type)) {
            if ($type == "TEAM") {
                echoTeamLegend();
            } else {
                echoMentorLegend();
            }
        } else {
            echoMentorLegend();
        } ?>
        <div class="inner" id="team-info" style="white-space:nowrap;padding-top:20px;text-align:center;">
            <div id="team-info-label">
                <!--populated with buttons for driving directions and a link to the profile of the selected account-->
            </div>
            <div  class="12u 12u$(small)" id="img-container">
                <!--populated by images based on the selected account's affiliate programs-->
            </div>
        </div>
        <br/>
        <button onclick="window.location = './survey.php';">
            Take Our Survey
        </button>
    </article>
    <footer id="footer" style="background: #2e3842; padding: 3rem 0 0 0;">
        <ul class="copyright">
            <li>
                <?php echoCopy(); ?>
            </li>
        </ul>
    </footer>
</div>
</body>
</html>