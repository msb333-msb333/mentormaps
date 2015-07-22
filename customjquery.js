$("#submitTeamRegistrationForm").click(function(){
	console.log("button pressed");
	$.ajax({
		type: 'POST',
		url: "./submitTeamForm.php",
		data: {
			'team-name': document.getElementById("team-name").value,
			'team-email': document.getElementById("team-email").value,
			'team-address': document.getElementById("team-address").value,
			'team-phone': document.getElementById("team-phone").value,
			'pass1': document.getElementById("pass1").value,
			'pass2': document.getElementById("pass2").value,
			'team-number': document.getElementById("team-number").value,
			
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
			console.log("success");
			alert(data);
		},
		error: function(xhr, textStatus, errorThrown) {
           alert("An error occurred");
		}
	});
});

//dont touch this please
$("#submitMentorRegistrationForm").click(function(){
	console.log("button pressed");
	$.ajax({
		type: 'POST',
		url: "./submitMentorForm.php",
		data: {
			'mentor-name': document.getElementById("mentor-name").value,
			'mentor-email': document.getElementById("mentor-email").value,
			'mentor-address': document.getElementById("mentor-address").value,
			'mentor-phone': document.getElementById("mentor-phone").value,
			'mentor-age': document.getElementById("mentor-age").value,
			'pass1': document.getElementById("pass1").value,
			'pass2': document.getElementById("pass2").value,
			'team-number': document.getElementById("team-number").value,
			
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
			console.log("success");
			alert(data);
		},
		error: function(xhr, textStatus, errorThrown) {
           alert("An error occurred");
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