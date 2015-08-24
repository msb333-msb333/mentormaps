<?php
require "./db.php";
require "./core.php";
require "./logincheck.php";

if(isset($_GET['p'])){
    $user = $_GET['p'];
    checkIfUserLoggedIn($user);

    $sql = "SELECT * FROM `assoc` WHERE email = '$user';";
    $result = $db->query($sql);
    $interested_in = '[]';
    $interested_in_me = '[]';
    while($r=mysqli_fetch_assoc($result)){
        $interested_in = $r['interested-in'];
        $interested_in_me = $r['interested-in-me'];
    }
}else{
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=./dashboard.php?p=".$_SESSION['email']."\">";
}
echoHeaderDash();
?>
            <script>
                var interested_in = <?php echo $interested_in; ?>;
                var interested_in_me = <?php echo $interested_in_me; ?>;
            </script>
            <article id="main">
                <header>
                    <h2>
                        Your Dashboard
                    </h2>
                </header>
                <section class="wrapper style5">
                    <div class="inner">
                        <section id="main-section" style="color:black;display:inline-block;width:100%;">
                            <table style="color:black;width:40%;float:left;">
                                <tr>
                                    <th>Who's Interested In Me:</th>
                                </tr>
                                <script>
                                    $.each(interested_in_me, function(key, value){
                                        document.write("<tr><td>"+value+"<a href='./profile.php?p="+value+"'>&nbsp;<img src='./ic_open_in_new_black_24dp_2x.png' width='24px'></img></a></td></tr>");
                                    });
                                </script>
                            </table>

                            <table style="color:black;width:40%;float:right;">
                                <tr>
                                    <th>Who I'm Interested In:</th>
                                </tr>
                                <script>
                                    $.each(interested_in, function(key, value){
                                        document.write("<tr><td>"+value+"<a href='./profile.php?p="+value+"'>&nbsp;<img src='./ic_open_in_new_black_24dp_2x.png' width='24px'></img></a></td></tr>");
                                    });
                                </script>
                            </table>

                            
                        </section>
                    </div>
                </section>
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