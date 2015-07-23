<?php
header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	file_put_contents("./result.txt", "1st step");
	
	require "./db.php";
	require "./security/salt.php";
	
	file_put_contents("./result.txt", "2nd step");
	
	$mentor_name = mysql_escape_mimic($_POST['mentor-name']);	
	$mentor_email = mysql_escape_mimic($_POST['mentor-email']);
	$mentor_address = mysql_escape_mimic($_POST['mentor-address']);
	$mentor_phone = mysql_escape_mimic($_POST['mentor-phone']);
	$mentor_bio = mysql_escape_mimic($_POST['bio']);
	$mentor_age = mysql_escape_mimic($_POST['mentor-age']);
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$team_number = mysql_escape_mimic($_POST['team-number']);
	
	if(!($pass1 === $pass2)){
		echo("password does not match");
		file_put_contents("./result.txt", "DONT MATCH");
	}
	
	file_put_contents("./result.txt", "MATCH");
	
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
	
	file_put_contents("./result.txt", "json encoded");
	
	$pref = "UNDEFINED";
	if($pref_fll===true){
		$pref="FLL";
	}else if($pref_ftc===true){
		$pref="FTC";
	}else{
		$pref="FRC";
	}
	file_put_contents("./result.txt", "set prefs");
	
	$mentor_pass = mysql_escape_mimic($pass1);
	
	$salt = createSalt($mentor_email);
	$concatPass = $mentor_pass . $salt;
	$pass_hash = md5($concatPass);
	
	file_put_contents("./result.txt", "made pass hash");
	
	$sql = "INSERT INTO `logins` (`EMAIL`, `PASSWORD`, `TYPE`) VALUES ('" . $mentor_email . "', '" . $pass_hash . "', 'MENTOR');";
	
	$db->query($sql);
	
	$sql = "";
	$sql .= "INSERT INTO `mentors` (`EMAIL`, `ADDRESS`, `AGE`, `BIO`, `NAME`, `PHONE`, `PREF_AFFILIATION`, `SPECIALIZATIONS_JSON`, `TEAM_NUMBER`) VALUES ('".$mentor_email."', '".$mentor_address."', '".$mentor_age."', '".$mentor_bio."', '".$mentor_name."', '".$mentor_phone."', '".$pref."', '".$json_encoded_skills."', '".$team_number."')";
	$db->query($sql);

	file_put_contents("./result.txt", "DONE; DING DING DING DING");
	echo json_encode(array('message' => 'registered successfully'));
}else{
	echo json_encode(array('error' => 'method was not POST'));
}
?>