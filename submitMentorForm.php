<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	require "./db.php";
	
	$mentor_name = $_POST['mentor-name'];
	$mentor_email = $_POST['mentor-email'];
	$mentor_address = $_POST['mentor-address'];
	$mentor_phone = $_POST['mentor-phone'];
	$mentor_bio = $_POST['bio'];
	
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
	
	
	echo $mentor_name;
}else{
	echo 'boo GET';
}
?>