$("#submitTeamRegistrationForm").click(function(){
	var team_number = document.getElementById("team-number").value;
	var team_name = document.getElementById("team-name").value;
	var team_email = document.getElementById("team-email").value;
	var team_address = document.getElementById("team-address").value;
	var team_phone = document.getElementById("team-phone").value;
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;
	
	if(team_number==""||team_name==""||team_email==""||team_address==""||team_phone==""||pass1==""||pass2==""){
		alert("you did not fill in a required field");
	}
	
	if(!pass1==pass2){
		alert("passwords do not match");
	}
	
	$.ajax({
		type: 'POST',
		url: "./registerteam.php",
		dataType : 'html',
		data: {
			'team-name': team_name,
			'team-email': team_email,
			'team-address': team_address,
			'team-phone': team_phone,
			'pass1': pass1,
			'pass2': pass2,
			'team-number': team_number,
			
			'FLLcheck': document.getElementById("FLLcheck").checked,
			'FTCcheck': document.getElementById("FTCcheck").checked,
			'FRCcheck': document.getElementById("FRCcheck").checked,
			
			'skill-mechanical-engineering': document.getElementById("skill-mechanical-engineering").checked,
			'skill-manufacturing': 			document.getElementById("skill-manufacturing").checked,
			'skill-programming': 			document.getElementById("skill-programming").checked,
			'skill-design': 				document.getElementById("skill-design").checked,
			'skill-strategy': 				document.getElementById("skill-strategy").checked,
			'skill-scouting': 				document.getElementById("skill-scouting").checked,
			'skill-business': 				document.getElementById("skill-business").checked,
			'skill-fundraising': 			document.getElementById("skill-fundraising").checked,
			'skill-marketing': 				document.getElementById("skill-marketing").checked,
			'skill-other':					document.getElementById("skill-other").checked,
			'other-text-box': 				document.getElementById("other-text-box").value,
			'comments':						document.getElementById("comments").value
		},
		success: function(data){
			document.getElementById("register-section").innerHTML = "Successfully Registered, you can log in <a href=\"./login.php\">here</a>";
			console.log("request successful");
		},
		error: function(xhr, textStatus, errorThrown) {
           alert("An error occurred: " + xhr.statusText + " : " + errorThrown);
		   console.log("An error occurred: " + xhr.statusText + " : " + errorThrown);
		}
	});
});

$("#submitMentorRegistrationForm").click(function(){
	var team_number = document.getElementById("team-number").value;
	var mentor_name = document.getElementById("mentor-name").value;
	var mentor_email = document.getElementById("mentor-email").value;
	var mentor_address = document.getElementById("mentor-address").value;
	var mentor_phone = document.getElementById("mentor-phone").value;
	var mentor_age = document.getElementById("mentor-age").value;
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;
	
	console.log(document.getElementById("FLLcheck").checked);
	
	$.ajax({
		type: 'POST',
		url: "./registermentor.php",
		data: {
			'mentor-name': mentor_name,
			'mentor-email': mentor_email,
			'mentor-address': mentor_address,
			'mentor-phone': mentor_phone,
			'mentor-age': mentor_age,
			'pass1': pass1,
			'pass2': pass2,
			'team-number': team_number,
			
			'FLLcheck': document.getElementById("FLLcheck").checked,
			'FTCcheck': document.getElementById("FTCcheck").checked,
			'FRCcheck': document.getElementById("FRCcheck").checked,
			
			'skill-mechanical-engineering': document.getElementById("skill-mechanical-engineering").checked,
			'skill-manufacturing': 			document.getElementById("skill-manufacturing").checked,
			'skill-programming': 			document.getElementById("skill-programming").checked,
			'skill-design': 				document.getElementById("skill-design").checked,
			'skill-strategy': 				document.getElementById("skill-strategy").checked,
			'skill-scouting': 				document.getElementById("skill-scouting").checked,
			'skill-business': 				document.getElementById("skill-business").checked,
			'skill-fundraising': 			document.getElementById("skill-fundraising").checked,
			'skill-marketing': 				document.getElementById("skill-marketing").checked,
			'skill-other':					document.getElementById("skill-other").checked,
			'other-text-box': 				document.getElementById("other-text-box").value,
			'bio':							document.getElementById("bio").value
		},
		success: function(data){
			document.getElementById("register-section").innerHTML = "Successfully Registered, you can log in <a href=\"./login.php\">here</a>";
			console.log("request successful");
		},
		error: function(xhr, textStatus, errorThrown) {
           alert("An error occurred: " + xhr.statusText + " : " + errorThrown);
		   console.log("An error occurred: " + xhr.statusText + " : " + errorThrown);
		}
	});
});

$("#skill-other").change(function(){
	 if (this.checked) {
		document.getElementById("other-text-box").style.visibility="visible";
	 }else{
		document.getElementById("other-text-box").style.visibility="hidden";
	 }
});