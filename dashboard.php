<?php
require "./db.php";
require "./core.php";
require "./logincheck.php";
$user = $_GET['p'];
checkIfUserLoggedIn($user);

$sql = "SELECT * FROM `assoc` WHERE email = '$user';";
$result = $db->query($sql);
$json = '{}';
while($r=mysqli_fetch_assoc($result)){
    $json = $r['data'];
}
echoHeader();
?>
<script>
    var json = '<?php echo $json; ?>';
</script>