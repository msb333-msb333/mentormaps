<!DOCTYPE HTML>
<html>
<head>
    <link rel="shortcut icon" href="http://mentormaps.net/favicon.ico"/>
    <title>
        Mentor Maps
    </title>
    <meta charset="utf-8"/>
    <script src="./assets/js/mousetrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
    <!--[if lte IE 8]>
    <script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ie8.css"/><![endif]-->
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ie9.css"/><![endif]-->
    <script>
        function login() {
            window.location = "./login.php";
        }

        function register() {
            window.location = "./register.php";
        }

        Mousetrap.bind("&", function () {
            $("#banner").html('<div onclick="window.location = \'http://en.wikipedia.org/wiki/Aubergine\'">&#x1f346;</div>');
            $("#menu").html("<ul><li>Aubergine</li></ul>");
        });
    </script>
</head>
<body class="landing">
<div id="page-wrapper">
    <header id="header" class="alt">
        <h1>
            <a href="index.php">Mentor Maps</a>
        </h1>
        <nav id="nav">
            <ul>
                <li class="special">
                    <a href="#menu" class="menuToggle">
                                    <span>
                                        Menu
                                    </span>
                    </a>

                    <div id="menu">
                        <ul>
                            <li>
                                <a href="./map.php">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="./register.php">
                                    Sign Up
                                </a>
                            </li>
                            <li>
                                <a href="./login.php">
                                    Log In
                                </a>
                            </li>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <section id="banner">
        <div class="inner">
            <h2>
                Mentor Maps
            </h2>

            <p>
                a useful tool to connect <b><em>FIRST</em> & VEX</b> teams with mentors
            </p>
            <ul class="actions">
                <li>
                    <a href="#" class="button special" onclick="register();">
                        Sign Up
                    </a>
                </li>
                <li>
                    <a href="#" class="button special" onclick="login();">
                        Log in
                    </a>
                </li>
            </ul>
        </div>
        <a href="#one" class="more scrolly">
            Learn More
        </a>
    </section>
    <!--careful, you're wandering into lorem ipsum territory now-->
    <section id="one" class="wrapper style1 special">
        <div class="inner">
            <header class="major">
                <h2>Find the people that will guide your team with MentorMaps</h2>

                <p>MentorMaps was developed by FRC Team 3309 to make every team/mentor's life just a little bit easier
                    <br/>
                    <button onclick="window.location = './map.php?opt=noaccount';">try it now</button>
                </p>
            </header>
        </div>
    </section>

    <!-- Two -->
    <section id="two" class="wrapper alt style2">
        <section class="spotlight">
            <div class="image"><img src="images/pic01.jpg"/></div>
            <div class="content">
                <h2>Nicely displays local <i>FIRST</i> and VEX teams on a Google Map!<br/></h2>

                <p>Instead of going through several complicated services to find a team or mentor, MentorMaps
                    beautifully displays collected data for any user to view.</p>
            </div>
        </section>
        <section class="spotlight">
            <div class="image"><img src="images/pic02.jpg" /></div>
            <div class="content">
                <h2>Calculates what mentor you need or what team you can help!<br/></h2>

                <p> By comparing what skills a mentor has and what type of mentor a team needs, MentorMaps matches teams
                    and mentors with exactly what you're looking for.</p>
            </div>
        </section>
        <section class="spotlight">
            <div class="image"><img src="images/pic03.jpg" /></div>
            <div class="content">
                <h2>Merging LinkedIn and Social Media for <i>FIRST</i> and VEX Teams<br/></h2>

                <p>Combining profile-matching algorithms and a job posting-like environment together to easily search,
                    find, and connect with teams or mentors close to you!</p>
            </div>
        </section>
    </section>

    <!-- Three -->
    <section id="three" class="wrapper style3 special">
        <div class="inner">
            <header class="major">
                <h2>The value of Mentorship</h2>
            </header>
            <ul class="features">
                <li>
                    <h3><br><br>"Mentors are the lubrication that keeps a team well oiled. "</h3>

                    <p> - <i>Rick Sisk, FIRST Senior Mentor</i></p>
                </li>
                <li>
                    <h3>"FIRST Robotics mentors inspire students to apply their academics in developing robots utilizing
                        unique and memorable techniques."</h3>

                    <p> - <i>Evan Smith, Lead Mentor for Team 3309 "The Friarbots"</i></p>
                </li>
                <li>
                    <h3>"...Every single student needs someone who they can look up to and work with to build a great
                        foundation for themselves and, as mentors, we provide that opportunity for them..."</h3>

                    <p> - <i>Pauline Tasci, Mentor and Student Alum of Team 3476 "Code Orange"</i></p>
                </li>
                <li>
                    <h3><br>"Mentors create a spark of knowledge in a student to see their ideas transformed into
                        reality."</h3>

                    <p> - <i>Paul Capparelli, Four-year FLL Lead Coach</i></p>
                </li>
            </ul>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="wrapper style4">
        <div class="inner">
            <header>
                <h2>Ready to sign up?</h2>

                <p>Just hit the red button.</p>
            </header>
            <ul class="actions vertical">
                <li><a href="./register.php" class="button fit special">Yeah!</a></li>
            </ul>
        </div>
    </section>

    <footer id="footer">
        <ul class="copyright">
            <li><?php require "copy.php"; echoCopy(); ?></li>
        </ul>
    </footer>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<!--[if lte IE 8]>
<script src="assets/js/ie/respond.min.js"></script><![endif]-->
</body>
</html>