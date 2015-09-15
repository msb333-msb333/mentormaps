function submitAddress(address){
    console.log("address: " + address);
      geocoder = new google.maps.Geocoder();
      geocoder.geocode({
              'address': address
      },
      function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            var pos = results[0].geometry.location;
            var latitude = pos.lat();
            var longitude = pos.lng();
            console.log(address + " | " + latitude + " | " + longitude);
            $.ajax({
                type: 'POST',
                url: './storeaddress.php',
                data : {
                    'address' : address,
                    'latitude' : latitude,
                    'longitude' : longitude
                },
                success: function(){
                    console.log("address info submitted successfully");
                    $("#register-section").html("Successfully Registered, please check your email and follow the link to verify your account");
                }
            });
          }else{
              alert("Google Maps was unable to find a latitude or longitude for that address");
              console.log("submitting default address");
              submitDefaultAddress();
          }
        });
    }

function submitDefaultAddress(){
    $.ajax({
        type: 'POST',
        url: './storeaddress.php',
        data : {
            'address' : "ERROR, please update address in <a href='./profile.php'>profile</a>",
            'latitude' : 33,
            'longitude' : -117
        },
        success: function(){
            $("#register-section").html("Partially Registered, please verify your account and visit your <a href='./profile.php'>profile</a> to update your address");
        },
        error: function(){
            $("#register-section").html("Wow, you really screwed up; this should never happen. Contact an Administrator.<div style='color:rgba(0,0,0,0.4);'>oh man, you really did it now</div>");
        }
    });
}

//verify that the user has checked the EULA agreement checkbox
function checkEULA(){
    if(!($('#EulaAgreement').is(':checked'))){
        alert("You must agree to the EULA");
        return false;
    }else{
        return true;
    }
}

//dispatches async ajax request to submit team data, request is handled in a php if/else statement in the corresponding dispatch page
$("#submitTeamRegistrationForm").click(function(){
    if(!(checkEULA())){
        return;
    }
    
    var team_address = $("#address-line-1").val() + ", " + $("#address-city").val() + ", " + $("#address-state").val() + ", " + $("#zip").val() + ", " + $("#address-country").val();
    
    var pass1 =      $("#pass1").val();
    var pass2 =      $("#pass2").val();
    var teamage =    $("#team-age").is(":checked");

    if(teamage){
        teamage = "Rookie Team";
    }else{
        teamage = "Experienced Team";
    }
    
    var required_fields = ["#pass1", "#pass2", "#team-number", "#team-email", "#team-name", "#rname", "#zip", "#address-country", "#address-state", "#address-city"];

    var allFieldsFilledOut = true;
    for(var fieldIndex in required_fields){
        var field = required_fields[fieldIndex];
        if($(field).val()==""){
            allFieldsFilledOut = false;
            $(field).css({"border" : "2px solid red"});
        }
    }

    if(!allFieldsFilledOut){
        alert("you did not fill in a required field");
        return;
    }

    //checks for mismatched passwords
    if(!(pass1.toString()==pass2.toString())){
        alert("passwords do not match");
        $("#pass1").css({"border" : "2px solid orange"});
        $("#pass2").css({"border" : "2px solid orange"});
        return;
    }

    var checkboxes = [
        'fll',
        'ftc',
        'frc',
        'vex',
        'skill-engineering',
        'engineering-mechanical',
        'engineering-electrical',
        'skill-programming',
        'programming-c',
        'programming-java',
        'programming-csharp',
        'programming-python',
        'programming-robotc',
        'programming-nxt',
        'programming-labview',
        'programming-easyc',
        'programming-ev3',
        'skill-cad',
        'skill-manufacturing',
        'skill-design',
        'skill-strategy',
        'skill-scouting',
        'skill-business',
        'skill-fundraising',
        'skill-marketing',
        'skill-other'
    ];
    var fields = [
        'pass1',
        'pass2',
        'rname',
        'team-name',
        'team-email',
        'team-phone',
        'team-number',
        'skill-other-desc',
        'comments'
    ];

    var info = {};
    info['team-address'] = team_address;
    info['team-age'] = teamage;

    for(var index in fields){
        var fieldName = fields[index];
        info[fieldName] = $("#"+fieldName).val();
    }

    for(var index in checkboxes){
        var cbname = checkboxes[index];
        info[cbname] = $("#"+cbname).is(":checked");
    }

    $.ajax({
        type:                               'POST',
        url:                                "./registerteam.php",
        data: info,
        success: function(){
            console.log("basic acct info submitted successfully");
            submitAddress(team_address);
        },
        error: function(xhr, textStatus, errorThrown) {
            //TODO make this error-catching system more reliable
            if(errorThrown="SyntaxError: Unexpected token a"){
                alert("a user already has that email address");
            }else{
                //display the error if one occured in the form of a js alert
                alert("An error occurred: " + xhr.statusText + " : " + errorThrown);
                console.log("An error occurred: " + xhr.statusText + " : " + errorThrown);
            }
        }
    }); 
});

$("#submitMentorRegistrationForm").click(function(){
    if(!(checkEULA())){
        return;
    }
    
    var mentor_address = $("#address-line-1").val() + ", " + $("#address-city").val() + ", " + $("#address-state").val() + ", " + $("#zip").val() + ", " + $("#address-country").val();
    
    var pass1 =             $("#pass1").val();
    var pass2 =             $("#pass2").val();
    
    var required_fields = ["#mentor-name", "#mentor-email", "#pass1", "#pass2", "#zip", "#address-country", "#address-state", "#address-city"];

    var allFieldsFilledOut = true;
    for(var fieldIndex in required_fields){
        var field = required_fields[fieldIndex];
        if($(field).val()==""){
            if(allFieldsFilledOut){
                $.scrollTo($(field));
            }
            allFieldsFilledOut = false;
            $(field).css({"border" : "2px solid red"});
        }else{
            $(field).css({"border" : ""});
        }
    }

    if(!allFieldsFilledOut){
        alert("you did not fill in a required field");
        return;
    }
    
    if(!(pass1.toString()==pass2.toString())){
        alert("passwords do not match");
        $("#pass1").css({"border" : "2px solid orange"});
        $("#pass2").css({"border" : "2px solid orange"});
        return;
    }

    var fields = [
        'mentor-name',
        'mentor-email',
        'mentor-phone',
        'pass1',
        'pass2',
        'team-number',
        'age',
        'bio',
        'skill-other-desc'
    ];
    var checkboxes = [
        'fll',
        'ftc',
        'frc',
        'vex',
        'skill-engineering',
        'engineering-mechanical',
        'engineering-electrical',
        'skill-manufacturing',
        'skill-programming',
        'skill-cad',
        'programming-c',
        'programming-java',
        'programming-csharp',
        'programming-python',
        'programming-robotc',
        'programming-nxt',
        'programming-labview',
        'programming-easyc',
        'programming-ev3',
        'skill-design',
        'skill-strategy',
        'skill-scouting',
        'skill-business',
        'skill-fundraising',
        'skill-marketing',
        'skill-other'
    ];

    var info = {};
    info["mentor-address"] = mentor_address;
    for(var index in fields){
        var fieldname = fields[index];
        info[fieldname] = $("#" + fieldname).val();
    }

    for(var index in checkboxes){
        var cbname = checkboxes[index];
        info[cbname] = $("#" + cbname).is(":checked");
    }

    $.ajax({
        type:                               'POST',
        url:                                "./registermentor.php",
        data:                               info,
        success: function(){
            submitAddress(mentor_address);
        },
        error: function(xhr, textStatus, errorThrown) {
           if(errorThrown="SyntaxError: Unexpected token a"){
                alert("a user already has that email address");
            }else{
                alert("An error occurred: " + xhr.statusText + " : " + errorThrown);
                console.log("An error occurred: " + xhr.statusText + " : " + errorThrown);
            }
        }
    });
});

//enables collapsable lists for skillsets
$("#skill-programming").change(function(){
    $("#programming-types-list").toggle();
});

$("#skill-engineering").change(function(){
        $("#engineering-types-list").toggle();
});