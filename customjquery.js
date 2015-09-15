function submitAddress(address){
    console.log("address: " + address);
      geocoder = new google.maps.Geocoder();
      geocoder.geocode( { 'address': address}, function(results, status) {
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
            }
        });
      } else {
        alert("Google Maps was unable to find the lat/lng for that address");
        return;
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
    
    $.ajax({
        type:                               'POST',
        url:                                "./registerteam.php",
        data: {
            'rname' :                       $("#rname").val(),
            'team-name':                    $("#team-name").val(),
            'team-email':                   $("#team-email").val(),
            'team-address':                 team_address,
            'team-phone':                   $("#team-phone").val(),
            'pass1':                        pass1,
            'pass2':                        pass2,
            'team-number':                  $("#team-number").val(),
            'team-age' :                    teamage,
            
            'FLLcheck':                     $("#FLLcheck").is(":checked"),
            'FTCcheck':                     $("#FTCcheck").is(":checked"),
            'FRCcheck':                     $("#FRCcheck").is(":checked"),
            'VEXcheck':                     $("#VEXcheck").is(":checked"),
            
            'skill-engineering':            $("#skill-engineering").is(":checked"),
            
            'engineering-mechanical' :      $("#engineering-mechanical").is(":checked"),
            'engineering-electrical' :      $("#engineering-electrical").is(":checked"),
            
            'skill-programming':            $("#skill-programming").is(":checked"),
            
            'programming-c':                $("#programming-c").is(":checked"),
            'programming-java':             $("#programming-java").is(":checked"),
            'programming-csharp':           $("#programming-csharp").is(":checked"),
            'programming-python':           $("#programming-python").is(":checked"),
            'programming-robotc':           $("#programming-robotc").is(":checked"),
            'programming-nxt':              $("#programming-nxt").is(":checked"),
            'programming-labview':          $("#programming-labview").is(":checked"),
            'programming-easyc':            $("#programming-easyc").is(":checked"),
            'programming-ev3':              $("#programming-ev3").is(":checked"),
            
            'skill-cad':                    $("#skill-cad").is(":checked"),
            'skill-manufacturing':          $("#skill-manufacturing").is(":checked"),
            'skill-design':                 $("#skill-design").is(":checked"),
            'skill-strategy':               $("#skill-strategy").is(":checked"),
            'skill-scouting':               $("#skill-scouting").is(":checked"),
            'skill-business':               $("#skill-business").is(":checked"),
            'skill-fundraising':            $("#skill-fundraising").is(":checked"),
            'skill-marketing':              $("#skill-marketing").is(":checked"),
            'skill-other':                  $("#skill-other").is(":checked"),
            
            'other-text-box':               $("#other-text-box").val(),
            'comments':                     $("#comments").val()
        },
        success: function(data){
            submitAddress(team_address);
            $("#register-section").innerHTML = "Successfully Registered, please check your email and follow the link to verify your account";
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
    //wrap up by storing the user's address    
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

    $.ajax({
        type:                               'POST',
        url:                                "./registermentor.php",
        data: {
            'mentor-name':                  $("#mentor-name").val(),
            'mentor-email':                 $("#mentor-email").val(),
            'mentor-address':               mentor_address,
            'mentor-phone':                 $("#mentor-phone").val(),
            'pass1':                        pass1,
            'pass2':                        pass2,
            'team-number':                  $("#team-number").val(),
            'age' :                         $("#age").val(),
            
            'FLLcheck':                     $("#FLLcheck").is(":checked"),
            'FTCcheck':                     $("#FTCcheck").is(":checked"),
            'FRCcheck':                     $("#FRCcheck").is(":checked"),
            'VEXcheck':                     $("#VEXcheck").is(":checked"),
            
            'skill-engineering':            $("#skill-engineering").is(":checked"),
            
            'engineering-mechanical' :      $("#engineering-mechanical").is(":checked"),
            'engineering-electrical' :      $("#engineering-electrical").is(":checked"),
            
            'skill-manufacturing':          $("#skill-manufacturing").is(":checked"),
            'skill-programming':            $("#skill-programming").is(":checked"),
            'skill-cad':                    $("#skill-cad").is(":checked"),
            
            'programming-c':                $("#programming-c").is(":checked"),
            'programming-java':             $("#programming-java").is(":checked"),
            'programming-csharp':           $("#programming-csharp").is(":checked"),
            'programming-python':           $("#programming-python").is(":checked"),
            'programming-robotc':           $("#programming-robotc").is(":checked"),
            'programming-nxt':              $("#programming-nxt").is(":checked"),
            'programming-labview':          $("#programming-labview").is(":checked"),
            'programming-easyc':            $("#programming-easyc").is(":checked"),
            'programming-ev3':              $("#programming-ev3").is(":checked"),
            
            'skill-design':                 $("#skill-design").is(":checked"),
            'skill-strategy':               $("#skill-strategy").is(":checked"),
            'skill-scouting':               $("#skill-scouting").is(":checked"),
            'skill-business':               $("#skill-business").is(":checked"),
            'skill-fundraising':            $("#skill-fundraising").is(":checked"),
            'skill-marketing':              $("#skill-marketing").is(":checked"),
            'skill-other':                  $("#skill-other").is(":checked"),

            'other-text-box':               $("#other-text-box").val(),
            'bio':                          $("#bio").val()
        },
        success: function(data){
            submitAddress(mentor_address);
            $("#register-section").innerHTML = "Successfully Registered, please check your email and follow the link to verify your account";
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