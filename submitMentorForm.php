<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	require "./db.php";
	require "./security/salt.php";
	
	$mentor_name = mysql_real_escape_string($_POST['mentor-name']);
	$mentor_email = mysql_real_escape_string($_POST['mentor-email']);
	$mentor_address = mysql_real_escape_string($_POST['mentor-address']);
	$mentor_phone = mysql_real_escape_string($_POST['mentor-phone']);
	$mentor_bio = mysql_real_escape_string($_POST['bio']);
	$mentor_age = mysql_real_escape_string($_POST['mentor-age']);
	$pass1 = mysql_real_escape_string($_POST['pass1']);
	$pass2 = mysql_real_escape_string($_POST['pass2']);
	$team_number = mysql_real_escape_string($_POST['team-number']]);
	
	if(!($pass1 == $pass2)){
		echo("password does not match");
	}
	
	$pref_fll = $_POST['FLLcheck'];
	$pref_ftc = $_POST['FTCcheck'];
	$pref_frc = $_POST['FRCcheck'];
	
	$skill_mech = $_POST['skill-mechanical-engineering'];
	$skill_prog = $_POST['skill-programming'];
	$skill_strat = $_POST['skill-strategy'];
	$skill_bus = $_POST['skill-business'];
	$skill_mark = $_POST['skill-marketing'];
	$skill_manu = $_POST['skill-manufacturing'];
	$skill_design = $_POST['skill-design'];
	$skill_scout = $_POST['skill-scouting'];
	$skill_fr = $_POST['skill-fundraising'];
	$skill_other = $_POST['skill-other'];
	$skill_other_desc = $_POST['other-text-box'];
	
	$json = array('skill-mechanical-engineering' => $skill_mech,
				  'skill-programming' => $skill_prog,
				  'skill-strategy' => $skill_strat,
				  'skill-business' => $skill_bus,
				  'skill-marketing' => $skill_mark,
				  'skill-manufacturing' => $skill_manu,
				  'skill-design' => $skill_design,
				  'skill-scouting' => $skill_scout,
				  'skill-fundraising' => $skill_fr,
				  'skill-other' => $skill_other
				  );
	
	$json_encoded_skills = json_encode($json);
	
	$pref = "UNDEFINED";
	if($pref_fll===true){
		$pref="FLL";
	}else if($pref_ftc===true){
		$pref="FTC";
	}else{
		$pref="FRC";
	}
	
	$salt = createSalt($mentor_email);
	$concatPass = $mentor_pass . $salt;
	$pass_hash = md5($concatPass);
	
	$sql = "INSERT INTO `logins` (`EMAIL`, `PASSWORD`) VALUES ('" . $mentor_email . "', '" . $pass_hash . "');";
	
	$sql = "";
	
	$sql .= "INSERT INTO `mentors` (``, ``, ``, ``, ``, ``)";
	
	echo $mentor_name;
}else{
	echo 'boo GET';
}
?>