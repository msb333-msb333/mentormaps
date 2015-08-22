<?php
require "./db.php";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <style>
            #map-canvas {
                height:100%;
            }
        </style>
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
    <script>
        function initialize() {
            var map = new google.maps.Map(document.getElementById('map-canvas'),{zoom: 11});
            centerMap(map, '1021 N Hensel Dr, La Habra, CA');
        }
        
    function centerMap(map, address){
        var Flat = 12;
        var Flng = 11;
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
                                                <a href="./index.php">
                                                    Home
                                                </a>
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
                                    <ul style="margin: 0;padding: 0;list-style-type:none;overflow-y:scroll;line-height:2em;overflow:scroll;overflow-x:hidden;height:100%;" id="team-list">
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
                                    <div style="overflow-y:scroll;line-height:2em;overflow:scroll;overflow-x:hidden;height:100%;">
                                        <ul style="list-style-type:none;" id="list-thing">
                                            <li>
                                                Team Search Filter
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
                                    var ret = ((d * 3.28) / 5280);
                                    return ret; // returns the distance in miles you damn commie
                                };
                                
                                var me;
                                for(var i=0;i<alldata.length;i++){
                                    var current_item = alldata[i];
                                    if(current_item['address'] == '<?php echo $my_address; ?>'){
                                        me = current_item;
                                        break;
                                    }
                                }
                    
                                var globalRet = 0;
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
                    
                                function refreshListing(){
                                    $("#team-list").html("");
                                        var teamscore_map = [];
                                        for(var i=0;i<allteams.length;i++){
                                            var team = allteams[i];
                                            var searchingfor = $.parseJSON(me['skills_json']);
                                            var offered = $.parseJSON(team['searching_skills_json']);
                                            var p1array = getLatLngArrayFromAddress(team['address']);
                                            var p1lat = globalRet.latitude;
                                            var p1lng = globalRet.longitude;
                                            var p2array = getLatLngArrayFromAddress(me['address']);
                                            var p2lat = globalRet.latitude;
                                            var p2lng = globalRet.longitude;
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
                                        }
                        
                                        teamscore_map = teamscore_map.sort(comparator);
                        
                                        console.log(teamscore_map);

                                        var teamListIndex = 0;
                                        console.log("teamscore_map length: " + teamscore_map.length);
                                        for(var e in teamscore_map){
                                            var team = teamscore_map[e]['team'];
                                            var result = teamscore_map[e].compare_result;
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
                                    refreshListing();
                                });
                            </script>
                        </div>
                    <style>
                        .paddedImgHolder{
                            padding-top:10px;
                        }
                    </style>
                    <?php if($type=="TEAM"){ ?>
                        <div style="width:100%;background-color:teal;height:62px;"><img class="paddedImgHolder" src="img/redm.png"/>FRC | <img class="paddedImgHolder" src="img/whitem.png"/> FTC | <img class="paddedImgHolder" src="img/bluem.png"/>FLL | <img class="paddedImgHolder" src="img/orangem.png" /> VEX | <img class="paddedImgHolder" src="img/greenm.png" /> MULTI</div>
                    <?php }else{ ?>
                        <div style="width:100%;background-color:teal;height:62px;"><img class="paddedImgHolder" src="img/red.png"/>FRC | <img class="paddedImgHolder" src="img/white.png"/> FTC | <img class="paddedImgHolder" src="img/blue.png"/>FLL | <img class="paddedImgHolder" src="img/orange.png" /> VEX</div>
                    <?php } ?>
                        <div style="white-space:nowrap;">
                            <div class="inner" id="team-info" style="padding-top:20px;text-align:center;">
                                <section id="team-info-section">
                                    <div class="6u 6u$(small)">
                                        <b>
                                            <div id="team-info-label" style="font-size:35px;">
                                                Team Info
                                            </div>
                                        </b>
                                    </div>
                                    <div class="row uniform">
                                        <div class="12u 12u$(small)" id="img-container"></div>
                                        <div class="6u 3u$(small)" id="name-container"></div>
                                        <div class="6u 3u$(small)" id="address-container"></div>
                                        <div class="6u 3u$(small)" id="searching-skills-container"></div>
                                        <div class="6u 3u$(small)" style="width:30%;overflow:hidden;" id="comments-container"></div>
                                        <div class="6u 3u$(small)" id="phone-container"></div>
                                        <div class="6u 3u$(small)" id="email-container"></div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div>
                            <button onclick="window.location = './survey.php';">
                                Take Our Survey
                            </button>
                        </div>
                    </article>
                    <footer id="footer">
                        <ul class="copyright">
                            <li>
                                &copy; Joseph Sirna 2015
                            </li>
                        </ul>
                    </footer>
            </div>
    </body>
</html>