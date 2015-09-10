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
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
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
                <!-- Main -->
                    <article id="main">
                        <section class="wrapper style5">
                            <div class="inner">
                                <section>
                                    <h4>Login</h4>
                                        <div class="row uniform">
                                            <div class="6u 12u$(small)">
                                                <input type="text" name="username" id="username-field" placeholder="email" />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                &nbsp;
                                                <br />
                                                <br />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="password" name="password" id="password-field" placeholder="password" />
                                            </div>
                                            <div id="wrong-password" class="6u 12u$(small)">
                                                &nbsp;
                                                <br />
                                                <br />
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <button class="button special" id="login-button">login</button>
                                            </div>
                                        </div>
                                </section>
                            </div>
                        </section>
                    </article>
                    <footer id="footer">
                        <ul class="copyright">
                            <li>&copy; FRC Team 3309, 2015</li>
                        </ul>
                    </footer>
            </div>
    </body>
    <script src="https://parse.com/downloads/javascript/parse-1.6.0.js"></script>
    <script>
    $("#login-button").click(function(){
        Parse.initialize("883aq7xdHmsFK7htfN2muJ5K3GE6eXWDiW7WwdYh", "jpoT2BB11qnlhNVUkrdovj9ACj3Ejctu2iaFMJr5");
        Parse.User.logOut();

        var user = $("#username-field").val();
        var pass = $("#password-field").val();

        Parse.User.logIn(user, pass, {
            success:function(user){
                alert("logged in successfully as " + user);
                console.log(user);
            },
            error:function(user, error){
                alert("failed to login; error: " + error);
                console.log(error);
            }
        });
    });
    
    </script>
</html>