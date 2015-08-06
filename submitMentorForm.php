<?php
header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	require "./db.php";
	require "./security/salt.php";
	
	$mentor_name = mysql_escape_mimic($_POST['mentor-name']);	
	$mentor_email = mysql_escape_mimic($_POST['mentor-email']);
	$mentor_address = mysql_escape_mimic($_POST['mentor-address']);
	$mentor_phone = mysql_escape_mimic($_POST['mentor-phone']);
	$mentor_bio = mysql_escape_mimic($_POST['bio']);
	$mentor_age = mysql_escape_mimic($_POST['mentor-age']);
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$team_number = mysql_escape_mimic($_POST['team-number']);
	
	$mentor_name=str_replace("<script>", "im a dirty little hacker: ", $mentor_name);
	$mentor_email=str_replace("<script>", "im a dirty little hacker: ", $mentor_email);
	$mentor_address=str_replace("<script>", "im a dirty little hacker: ", $mentor_address);
	$mentor_phone=str_replace("<script>", "im a dirty little hacker: ", $mentor_phone);
	$mentor_bio=str_replace("<script>", "im a dirty little hacker: ", $mentor_bio);
	$mentor_age=str_replace("<script>", "im a dirty little hacker: ", $mentor_age);
	$team_number=str_replace("<script>", "im a dirty little hacker: ", $team_number);
	
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
	
	$skill_other_desc=str_replace("<script>", "im a dirty little hacker: ", $skill_other_desc);
	
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

	$mentor_pass = mysql_escape_mimic($pass1);	
	$salt = createSalt($mentor_email);
	$concatPass = $mentor_pass . $salt;
	$pass_hash = md5($concatPass);
	$sql = "INSERT INTO `logins` (`EMAIL`, `PASSWORD`, `TYPE`) VALUES ('" . $mentor_email . "', '" . $pass_hash . "', 'MENTOR');";
	$db->query($sql);
	$sql = "INSERT INTO `mentors` (`OTHER_DETAIL`, `EMAIL`, `ADDRESS`, `AGE`, `BIO`, `NAME`, `PHONE`, `PREF_AFFILIATION`, `SPECIALIZATIONS_JSON`, `TEAM_NUMBER`) VALUES ('".$skill_other_desc."', '".$mentor_email."', '".$mentor_address."', '".$mentor_age."', '".$mentor_bio."', '".$mentor_name."', '".$mentor_phone."', '".$pref."', '".$json_encoded_skills."', '".$team_number."')";
	$db->query($sql);

	echo "{\"status\":\"ok\"}";
}else{
	echo json_encode(array('error' => 'method was not POST'));
}
?>