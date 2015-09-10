<html>
    <head>
        <link rel="shortcut icon" href="http://mentormaps.net/favicon.ico"/>
        <title>Mentor Maps</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-e-RpEFPKNX-hDqBs--zoYYCk2vmXdZg"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="https://parse.com/downloads/javascript/parse-1.6.0.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    </head>
    <body class="landing">
            <div id="page-wrapper">
                    <header id="header">
                        <h1><a href="./index.php">Mentor Maps</a></h1>
                        <nav id="nav">
                            <ul>
                                <li class="special">
                                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                                    <div id="menu">
                                        <ul>
                                            <li><a href="./index.php">Home</a></li>
                                            <li><a href="./register.php">Sign Up</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </header>
                    <article id="main">
                        <header>
                            <h2>Register as a Mentor</h2>
                        </header>
                        <section class="wrapper style5">
                            <div class="inner">
                                <section id="register-section">
                                    <h4 style="font-size:32px;">Mentor Registration</h4>
                                    <div>
                                        <div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" title="Full Name" id="name" placeholder="Full Name" />
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <input type="email" title="Email" id="email" placeholder="Email" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" title="Password" id="pass1" placeholder="Password" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" title="Retype Password" id="pass2" placeholder="Retype Password" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="text" title="Team Number" id="teamNumber" placeholder="Team Number (Optional)" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="text" title="Years Mentored" id="age" placeholder="Years Mentored" />
                                            </div>

                                            <?php include "./pages/address_form.html"; ?>

                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" title="Phone Number" name="phone" id="mentor-phone" placeholder="Phone Number (Optional)" />
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="checkbox" id="FLLcheck" name="typeChecks">
                                                <label for="FLLcheck">FLL</label>
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="checkbox" id="FTCcheck" name="typeChecks">
                                                <label for="FTCcheck">FTC</label>
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="checkbox" id="FRCcheck" name="typeChecks">
                                                <label for="FRCcheck">FRC</label>
                                            </div>
                                            <div class="3u 12u$(small)">
                                                <input type="checkbox" id="VEXcheck" name="typeChecks">
                                                <label for="VEXcheck">VEX</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <br />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <br />
                                            </div>

                                            <h4 style="font-size:23px;">
                                                Mentor Skillset
                                            </h4>
                                            <div class="6u 12u$(small)">
                                                <br />&nbsp;
                                            </div>

                                            <?php include("./pages/skillset_form.html"); ?>

                                            <div class="12u$">
                                                <textarea name="bio" maxlength="200" title="Write something about yourself" id="bio" placeholder="Write something about yourself" rows="6"></textarea>
                                            </div>
                                            <div class="12u$">
                                                <input type="checkbox" id="EulaAgreement"></input>
                                                <label for="EulaAgreement">I agree to the <a target="_blank" href="./tos.php">terms of service</a> and certify that I am of 18 years of age or older</label>
                                            </div>
                                            <div class="12u$">
                                                <button id="submitMentorRegistrationForm" class="button special">Become a Mentor</button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </section>
                    </article>

                <!-- Footer -->
                    <footer id="footer">
                        <ul class="copyright">
                            <li>&copy; FRC Team 3309, 2015</li>
                        </ul>
                    </footer>

            </div>
    </body>
    <script src="./customjquery.js"></script>
    <script src="./geocoder.js"></script>
    <script>
        Parse.initialize("883aq7xdHmsFK7htfN2muJ5K3GE6eXWDiW7WwdYh", "jpoT2BB11qnlhNVUkrdovj9ACj3Ejctu2iaFMJr5");

        function createSkillsArray(){
            var data = {
                engineering_mechanical:         $("#engineering-mechanical").is(":checked"),
                engineering_electrical:         $("#engineering-electrical").is(":checked"),

                programming_c:                  $("#programming-c").is(":checked"),
                programming_java:               $("#programming-java").is(":checked"),
                programming_csharp:             $("#programming-csharp").is(":checked"),
                programming_python:             $("#programming-python").is(":checked"),
                programming_robotc:             $("#programming-robotc").is(":checked"),
                programming_nxt:                $("#programming-nxt").is(":checked"),
                programming_labview:            $("#programming-labview").is(":checked"),
                programming_easyc:              $("#programming-easyc").is(":checked"),
                programming_ev3:                $("#programming-ev3").is(":checked"),

                cad:                            $("#skill-cad").is(":checked"),
                design:                         $("#skill-design").is(":checked"),
                strategy:                       $("#skill-strategy").is(":checked"),
                scouting:                       $("#skill-scouting").is(":checked"),
                business:                       $("#skill-business").is(":checked"),
                fundraising:                    $("#skill-fundraising").is(":checked"),
                marketing:                      $("#skill-marketing").is(":checked"),
                other:                          $("#skill-other").is(":checked"),
                other_desc:                     $("#other-text-box").is(":checked")
            };
            return JSON.stringify(data);
        }

        function createTypeArray(){
            var data = {
                frc: $("#FRCcheck").is(":checked"),
                ftc: $("#FTCcheck").is(":checked"),
                fll: $("#FLLcheck").is(":checked"),
                vex: $("#VEXcheck").is(":checked")
            };
            return JSON.stringify(data);
        }

        function createAddress(){
            var address =   $("#address-line-1").val();
            var city =      $("#address-city").val();
            var state =     $("#address-state").val();
            var zip =       $("#zip").val();
            var country =   $("#address-country").val();
            return address + ", " + city + ", " + zip + ", " + state + ", " + country;//TODO don't add commas if the address parts are not set
        }

        function addUserData(email){
            var UDClass = Parse.Object.extend("UserData");
            var ud = new UDClass();
            
            var address = createAddress();

            ud.set("email", email);
            ud.set("skillsJSON", createSkillsArray());
            ud.set("typeJSON", createTypeArray());
            ud.set("address", address);
            ud.set("name", $("#name").val());
            ud.set("teamNumber", $("#teamNumber").val());
            ud.set("comments", $("#bio").val());
            ud.set("phone", $("#phone").val());
            ud.set("age", $("#age").val());
            ud.set("accountType", "MENTOR");
            ud.set("registrantName", "undefined");

            ud.save(null, {
                success: function(ud){
                    geocode(address);
                },
                error: function(ud, error){
                    alert('Failed to add user data, error code: ' + error.message);
                }
            });
        }

        
        $("#submitMentorRegistrationForm").click(function(){
            var email = $("#email").val();
            var pass1 = $("#pass1").val();
            var pass2 = $("#pass2").val();

            if(!pass1==pass2){
                alert("passwords do not match");
                return;
            }

            //TODO required fields

            var user = new Parse.User();
            user.set("username", email);
            user.set("email", email);
            user.set("password", pass1);
            user.signUp(null, {
                success: function(user){
                    addUserData(email);
                },
                error: function(user, error){
                    alert("an error occurred; check the console");
                    console.log(error);
                }
            });
        });
        $(function(){
            $("#engineering-types-list").toggle();
            $("#programming-types-list").toggle();
        });
    </script>
</html>