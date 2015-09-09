//custom array contains function, nothing special
function contains(a, obj) {
    for (var i = 0; i < a.length; i++) {
        if (a[i] === obj) {
            return true;
        }
    }
    return false;
}

//alogorithm for comparing teams; returns a value 0-1 based on compatibility
//paramters are js arrays
function compare(team_skills, mentor_skills, team_type, mentor_types, distance, distance_weight){
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

    //assign a variable that counts the number of skills that the two accounts share
    var matches = 0;
    for(var i=0;i<skills_searching_for.length;i++){
        var element = skills_searching_for[i];
        if(skills_offered.indexOf(element) > -1){
            matches++;
        }
    }
    //divides the number of shared skills by the number of total skills of the account to compare
    var skills_score = matches / skills_searching_for.length;

    //the type score can be 0 or 1 and filters incompatible account types (FRC, FTC, FLL, VEX, etc)
    var type_score = 0;
    if(contains(mentor_types, team_type)){
        type_score = 1;
    }

    //just some code to make the algorithm easier to understand
    var numerator = skills_score * type_score;
    var denominator = distance * distance_weight;
    
    return numerator / denominator;
}