function contains(a, obj) {
	for (var i = 0; i < a.length; i++) {
		if (a[i] === obj) {
			return true;
		}
	}
	return false;
}

function compare(team_skills, mentor_skills, team_type, mentor_types, distance){
	var skills_searching_for = [];
	var skills_offered = [];

	for(var e in team_skills){
		if(team_skills[e] == 'true'){
			skills_searching_for.push(e);
		}
	}

	for(var e in mentor_skills){
		if(mentor_skills[e] == 'true'){
			skills_offered.push(e);
		}
	}

	var matches = 0;
	for(var i=0;i<skills_searching_for.length;i++){
		var element = skills_searching_for[i];
		if(skills_offered.indexOf(element) > -1){
			matches++;
		}
	}

	var skills_score = matches / skills_searching_for.length;
	var type_score = 0;
	if(contains(mentor_types, team_type)){
		type_score = 1;
	}

	var numerator = skills_score * type_score;
	var next = numerator / distance;

	console.log("team type: " + team_type);
	console.log("mentor types: " + mentor_types);
	console.log("Searching for: " + skills_searching_for);
	console.log("Skills Offered: " + skills_offered);
	console.log("type score: " + type_score);
	console.log("skills score: " + skills_score);
	console.log("matches: " + matches );
	console.log("numerator: " + numerator);
	console.log("distance: " + distance);

	console.log("result: " + next);
	
	return next;
}