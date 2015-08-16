<?php
    require "./core.php";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Mentor Maps</title>
        <meta charset="utf-8" />
        <script src="./assets/js/mousetrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <script>
            function login(){
                window.location="./login.php";
            }

            function register(){
                window.location = "./register.php";
            }

            Mousetrap.bind("&", function() {
                $("#banner").html('<div onclick="window.location = \'http://en.wikipedia.org/wiki/Aubergine\'">&#x1f346;</div>');
                $("#menu").html("<ul><li>Aubergine</li></ul>");
            });
        </script>
    </head>
    <body class="landing">

        <!-- Page Wrapper -->
            <div id="page-wrapper">

                <!-- Header -->
                    <header id="header" class="alt">
                        <h1><a href="index.html">Mentor Maps</a></h1>
                        <nav id="nav">
                            <ul>
                                <li class="special">
                                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                                    <div id="menu">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="./register.php">Sign Up</a></li>
                                            <li><a href="./login.php">Log In</a></li>
                                            <li><a href="./logout.php">Log Out</a></li>
                                            <li><a href="<?php
                                               echoProfileLink();
                                            ?>">Profile</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </header>

                <!-- Banner -->
                    <section id="banner">
                        <div class="inner">
                            <h2>Mentor Maps</h2>
                            <p>a useful tool to connect <b><em>FIRST</em></b> teams with mentors</p>
                            <ul class="actions">
                                <li><a href="#" class="button special" onclick="register();">Register</a></li>
                                <li><a href="#" class="button special" onclick="login();">Log in</a></li>
                                <!--<img src="./images/face.png"/>-->
                            </ul>
                        </div>
                        <a href="#one" class="more scrolly">Learn More</a>
                    </section>

                <!-- One -->
                    <section id="one" class="wrapper style1 special">
                        <div class="inner">
                            <header class="major">
                                <h2>Arcu aliquet vel lobortis ata nisl<br />
                                eget augue amet aliquet nisl cep donec</h2>
                                <p>Aliquam ut ex ut augue consectetur interdum. Donec amet imperdiet eleifend<br />
                                fringilla tincidunt. Nullam dui leo Aenean mi ligula, rhoncus ullamcorper.</p>
                            </header>
                            <ul class="icons major">
                                <li><span class="icon fa-diamond major style1"><span class="label">Lorem</span></span></li>
                                <li><span class="icon fa-heart-o major style2"><span class="label">Ipsum</span></span></li>
                                <li><span class="icon fa-code major style3"><span class="label">Dolor</span></span></li>
                            </ul>
                        </div>
                    </section>

                <!-- Two -->
                    <section id="two" class="wrapper alt style2">
                        <section class="spotlight">
                            <div class="image"><img src="images/pic01.jpg" alt="" /></div><div class="content">
                                <h2>Magna primis lobortis<br />
                                sed ullamcorper</h2>
                                <p>Aliquam ut ex ut augue consectetur interdum. Donec hendrerit imperdiet. Mauris eleifend fringilla nullam aenean mi ligula.</p>
                            </div>
                        </section>
                        <section class="spotlight">
                            <div class="image"><img src="images/pic02.jpg" alt="" /></div><div class="content">
                                <h2>Tortor dolore feugiat<br />
                                elementum magna</h2>
                                <p>Aliquam ut ex ut augue consectetur interdum. Donec hendrerit imperdiet. Mauris eleifend fringilla nullam aenean mi ligula.</p>
                            </div>
                        </section>
                        <section class="spotlight">
                            <div class="image"><img src="images/pic03.jpg" alt="" /></div><div class="content">
                                <h2>Augue eleifend aliquet<br />
                                sed condimentum</h2>
                                <p>Aliquam ut ex ut augue consectetur interdum. Donec hendrerit imperdiet. Mauris eleifend fringilla nullam aenean mi ligula.</p>
                            </div>
                        </section>
                    </section>

                <!-- Three -->
                    <section id="three" class="wrapper style3 special">
                        <div class="inner">
                            <header class="major">
                                <h2>Accumsan mus tortor nunc aliquet</h2>
                                <p>Aliquam ut ex ut augue consectetur interdum. Donec amet imperdiet eleifend<br />
                                fringilla tincidunt. Nullam dui leo Aenean mi ligula, rhoncus ullamcorper.</p>
                            </header>
                            <ul class="features">
                                <li class="icon fa-paper-plane-o">
                                    <h3>Arcu accumsan</h3>
                                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                                </li>
                                <li class="icon fa-laptop">
                                    <h3>Ac Augue Eget</h3>
                                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                                </li>
                                <li class="icon fa-code">
                                    <h3>Mus Scelerisque</h3>
                                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                                </li>
                                <li class="icon fa-headphones">
                                    <h3>Mauris Imperdiet</h3>
                                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                                </li>
                                <li class="icon fa-heart-o">
                                    <h3>Aenean Primis</h3>
                                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                                </li>
                                <li class="icon fa-flag-o">
                                    <h3>Tortor Ut</h3>
                                    <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
                                </li>
                            </ul>
                        </div>
                    </section>

                <!-- CTA -->
                    <section id="cta" class="wrapper style4">
                        <div class="inner">
                            <header>
                                <h2>Arcue ut vel commodo</h2>
                                <p>Aliquam ut ex ut augue consectetur interdum endrerit imperdiet amet eleifend fringilla.</p>
                            </header>
                            <ul class="actions vertical">
                                <li><a href="#" class="button fit special">Activate</a></li>
                                <li><a href="#" class="button fit">Learn More</a></li>
                            </ul>
                        </div>
                    </section>

                <!-- Footer -->
                    <footer id="footer">
                        <ul class="icons">
                            <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                            <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                            <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
                            <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
                        </ul>
                        <ul class="copyright">
                            <li>&copy; Joseph Sirna 2015</li>
                        </ul>
                    </footer>

            </div>

        <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.scrollex.min.js"></script>
            <script src="assets/js/jquery.scrolly.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/main.js"></script>

    </body>
</html>