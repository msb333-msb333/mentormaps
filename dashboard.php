<?php
require "./db.php";
require "./core.php";
require "./logincheck.php";
$user = $_GET['p'];
checkIfUserLoggedIn($user);

$sql = "SELECT * FROM `assoc` WHERE email = '$user';";
$result = $db->query($sql);
$interested_in = '{}';
$interested_in_me = '{}';
while($r=mysqli_fetch_assoc($result)){
    $interested_in = $r['interested-in'];
    $interested_in_me = $r['interested-in-me'];
}
//echoHeader();
?>
<script>
    var interested_in = '<?php echo $interested_in; ?>';
    var interested_in_me = '<?php echo $interested_in_me; ?>';
</script>