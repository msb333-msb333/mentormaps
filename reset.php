<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    require "./pages/default_header.html";
    if(isset($_GET['key'])){
        require "./db.php";

        $sql = "SELECT * FROM `logins` WHERE `KEY` = '".$_GET['key']."'";
        $result=$db->query($sql);
        while($r=mysqli_fetch_assoc($result)){
            $email = $r['EMAIL'];
        }
        if(isset($email)){
        ?>
        <script src="./assets/js/jquery.min.js"></script>
        <script>
            function checkAndSubmit(){
                var p1 = document.getElementById("newpass").value;
                var p2 = document.getElementById("newpass2").value;
                if(!(p1==p2)){
                    alert("passwords do not match");
                    return;
                }
                $.ajax({
                    url: './reset.php',
                    type: 'POST',
                    async: true,
                    data: {
                        'newpass': p1,
                        'email': '<?php echo $email; ?>'
                    },
                    success: function(data){
                        window.location = "./login.php";
                    }
                });
            }
        </script>
        <?php

            echo '<h1>Reset password for ' . $email . '</h1><br/>'
            ?>
                type: <input type="password" id="newpass"><br/>
                retype: <input type="password" id="newpass2"><br/>
                <button onclick="checkAndSubmit();">reset password</button>
            <?php
        }else{
            die("Sorry, no email is associated with that key");
        }
    }else{
        die("No key defined<br/>Perhaps you'd like to go back <a href='./index.php'>home</a>?");
    }
    require "./pages/default_footer.html";
}else{
    require "./db.php";
    require "./security/salt.php";

    $pass_hash = md5(mysql_escape_mimic($_POST['newpass']) . createSalt($_POST['email']));

    $sql = "UPDATE `logins` SET `PASSWORD` = '$pass_hash' WHERE `EMAIL` = '".$_POST['email']."';";
    $db->query($sql);
}
?>