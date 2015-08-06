<?php
header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	require "./db.php";
	require "./security/salt.php";
	
	$team_name = mysql_escape_mimic($_POST['team-name']);	
	$team_email = mysql_escape_mimic($_POST['team-email']);
	$team_address = mysql_escape_mimic($_POST['team-address']);
	$team_phone = mysql_escape_mimic($_POST['team-phone']);
	$comments = mysql_escape_mimic($_POST['comments']);
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$team_number = mysql_escape_mimic($_POST['team-number']);
	
	$team_name=str_replace("<script>", "im a dirty little hacker: ", $team_name);
	$team_email=str_replace("<script>", "im a dirty little hacker: ", $team_email);
	$team_address=str_replace("<script>", "im a dirty little hacker: ", $team_address);
	$team_phone=str_replace("<script>", "im a dirty little hacker: ", $team_phone);
	$comments=str_replace("<script>", "im a dirty little hacker: ", $comments);
	$team_number=str_replace("<script>", "im a dirty little hacker: ", $team_number);
	
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
	$skill_other_desc = mysql_escape_mimic($_POST['other-text-box']);
	
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
	if($pref_fll==true){
		$pref="FLL";
	}else if($pref_ftc==true){
		$pref="FTC";
	}else{
		$pref="FRC";
	}
	
	$team_pass = mysql_escape_mimic($pass1);
	$salt = createSalt($team_email);
	$concatPass = $team_pass . $salt;
	$pass_hash = md5($concatPass);
	$sql = "INSERT INTO `logins` (`EMAIL`, `PASSWORD`, `TYPE`) VALUES ('" . $team_email . "', '" . $pass_hash . "', 'TEAM');";	
	$db->query($sql);
	$sql = "INSERT INTO `teams` (`OTHER_DETAIL`, `TYPE`, `ADDRESS`, `COMMENTS`, `EMAIL`, `NAME`, `PHONE`, `SEARCHING_SKILLS_JSON`, `TEAM_NUMBER`) VALUES ('".$skill_other_desc."', '".$pref."', '".$team_address."', '".$comments."', '".$team_email."', '".$team_name."', '".$team_phone."', '".$json_encoded_skills."', '".$team_number."')";
	$db->query($sql);
	echo "{\"status\":\"ok\"}";
}else{
	echo json_encode(array('error' => 'request was not POST'));
}
?>