<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	file_put_contents("./result.txt", "1st step");
	
	require "./db.php";
	require "./security/salt.php";
	
	file_put_contents("./result.txt", "2nd step");
	
	$team_name = mysql_escape_mimic($_POST['team-name']);	
	$team_email = mysql_escape_mimic($_POST['team-email']);
	$team_address = mysql_escape_mimic($_POST['team-address']);
	$team_phone = mysql_escape_mimic($_POST['team-phone']);
	$comments = mysql_escape_mimic($_POST['comments']);
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
	
	$team_pass = mysql_escape_mimic($pass1);
	
	$salt = createSalt($team_email);
	$concatPass = $team_pass . $salt;
	$pass_hash = md5($concatPass);
	
	file_put_contents("./result.txt", "made pass hash");
	
	$sql = "INSERT INTO `logins` (`EMAIL`, `PASSWORD`, `TYPE`) VALUES ('" . $team_email . "', '" . $pass_hash . "', 'TEAM');";	
	$db->query($sql);
	
	file_put_contents("./result.txt", "queried logins db");
	
	$sql = "INSERT INTO `teams` (`ADDRESS`, `COMMENTS`, `EMAIL`, `NAME`, `PHONE`, `SEARCHING_SKILLS_JSON`, `TEAM_NUMBER`) VALUES ('".$team_address."', '".$comments."', '".$team_email."', '".$team_name."', '".$team_phone."', '".$json_encoded_skills."', '".$team_number."')";
	$db->query($sql);

	file_put_contents("./result.txt", "finished, returning json");
	
	$a = array('message' => 'registered successfully');
	echo json_encode($a);
}else{
	echo json_encode(array('error' => 'request was not POST'));
}
?>