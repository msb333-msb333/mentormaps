//custom array contains function, nothing special
function contains(a, obj) {
    for (var i = 0; i < a.length; i++) {
        if (a[i] === obj) {
            return true;
        }
    }
    return false;
}

//algorithm for comparing accounts; returns a value 0-1 based on compatibility
function compare(mySkills, theirSkills, myTypes, theirTypes, distance, distance_weight) {
    var skills_searching_for = [];
    var skills_offered = [];

    for (var mySkillIndex in mySkills) {
        if (mySkills[mySkillIndex] == 'true') {
            skills_searching_for.push(mySkillIndex);
        }
    }

    for (var theirSkillIndex in theirSkills) {
        if (theirSkills[theirSkillIndex] == 'true') {
            skills_offered.push(theirSkillIndex);
        }
    }

    //assign a variable that counts the number of skills that the two accounts share
    var matches = 0;
    for (var i = 0; i < skills_searching_for.length; i++) {
        var element = skills_searching_for[i];
        if (skills_offered.indexOf(element) != -1) {
            matches++;
        }
    }

    //divides the number of shared skills by the number of total skills of the account to compare
    var skills_score = matches / skills_searching_for.length;

    //the type score can be 0 or 1 and filters incompatible account types (FRC, FTC, FLL, VEX, etc)
    var type_score = 0;
    for(var myType in myTypes){
        for(var theirType in theirTypes){
            if(myType == theirType){
                type_score = 1;
            }
        }
    }

    console.log("my types");
    console.log(myTypes);

    console.log("their types");
    console.log(theirTypes);

    //just some code to make the algorithm easier to understand
    var numerator = skills_score * type_score;
    var denominator = distance * distance_weight;

    return numerator / denominator;
}