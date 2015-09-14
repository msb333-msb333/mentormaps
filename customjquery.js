//submit a geocode request to google once so as to not overload per second limit
function getLatLngFromAddress(address){
    console.log("address: " + address);
      geocoder = new google.maps.Geocoder();
      geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        submitLatLng(results[0].geometry.location, address);
      } else {
        alert("Google Maps was unable to find the lat/lng for that address");
        return;
      }
    });
}

//just a semantic function to make the code easier to understand
function submitAddress(address){
    getLatLngFromAddress(address);
}

//store the latitude and longitude for the given address in the database
function submitLatLng(pos, address){
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
    var team_number =  document.getElementById("team-number"    ).value;
    var team_name =    document.getElementById("team-name"      ).value;
    var team_email =   document.getElementById("team-email"     ).value;
    var rname =         document.getElementById("rname"         ).value;
    
    var address1 =     document.getElementById("address-line-1" ).value;
    var address2 =     document.getElementById("address-city"   ).value;
    var address3 =     document.getElementById("address-state"  ).value;
    var address4 =     document.getElementById("address-country").value;
    var zip =           document.getElementById("zip").value;
    
    var team_address = address1 + ", " + address2 + ", " + address3 + ", " + zip + ", " + address4;
    
    var team_phone = document.getElementById("team-phone"       ).value;
    var pass1 =      document.getElementById("pass1"            ).value;
    var pass2 =      document.getElementById("pass2"            ).value;
    var teamage =    document.getElementById("team-age"         ).checked;

    if(teamage){
        teamage = "Rookie Team";
    }else{
        teamage = "Experienced Team";
    }
    
    //checks that the user has filled out all required fields
    if(team_number==""||team_name==""||team_email==""||pass1==""||pass2==""){
        alert("you did not fill in a required field");
        return;
    }

    //checks for mismatched passwords
    if(!(pass1.toString()==pass2.toString())){
        alert("passwords do not match");
        return;
    }
    
    //submit ajax request to store the data,
    //  this will probably get replaced with some parse api code at one point
    $.ajax({
        type:                               'POST',
        url:                                "./registerteam.php",
        data: {
            'rname' : rname,
            'team-name':                    team_name,
            'team-email':                   team_email,
            'team-address':                 team_address,
            'team-phone':                   team_phone,
            'pass1':                        pass1,
            'pass2':                        pass2,
            'team-number':                  team_number,
            'team-age' :                    teamage,
            
            'FLLcheck':                     document.getElementById("FLLcheck"                    ).checked,
            'FTCcheck':                     document.getElementById("FTCcheck"                    ).checked,
            'FRCcheck':                     document.getElementById("FRCcheck"                    ).checked,
            'VEXcheck':                     document.getElementById("VEXcheck"                    ).checked,
            
            'skill-engineering':            document.getElementById("skill-engineering"           ).checked,
            
            'engineering-mechanical' :      document.getElementById("engineering-mechanical"      ).checked,
            'engineering-electrical' :      document.getElementById("engineering-electrical"      ).checked,
            
            'skill-manufacturing':          document.getElementById("skill-manufacturing"         ).checked,
            
            'skill-programming':            document.getElementById("skill-programming"           ).checked,
            
            'programming-c':                document.getElementById("programming-c"               ).checked,
            'programming-java':             document.getElementById("programming-java"            ).checked,
            'programming-csharp':           document.getElementById("programming-csharp"          ).checked,
            'programming-python':           document.getElementById("programming-python"          ).checked,
            'programming-robotc':           document.getElementById("programming-robotc"          ).checked,
            'programming-nxt':              document.getElementById("programming-nxt"             ).checked,
            'programming-labview':          document.getElementById("programming-labview"         ).checked,
            'programming-easyc':            document.getElementById("programming-easyc"           ).checked,
            'programming-ev3':              document.getElementById("programming-ev3"             ).checked,
            
            'skill-cad':                    document.getElementById("skill-cad"                   ).checked,
            
            'skill-design':                 document.getElementById("skill-design"                ).checked,
            'skill-strategy':               document.getElementById("skill-strategy"              ).checked,
            'skill-scouting':               document.getElementById("skill-scouting"              ).checked,
            'skill-business':               document.getElementById("skill-business"              ).checked,
            'skill-fundraising':            document.getElementById("skill-fundraising"           ).checked,
            'skill-marketing':              document.getElementById("skill-marketing"             ).checked,
            'skill-other':                  document.getElementById("skill-other"                 ).checked,
            
            'other-text-box':               document.getElementById("other-text-box"              ).value,
            'comments':                     document.getElementById("comments"                    ).value
        },
        success: function(data){
            //replace the form with a success message
            document.getElementById("register-section").innerHTML = "Successfully Registered, please check your email and follow the link to verify your account";
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
    submitAddress(team_address);
});

$("#submitMentorRegistrationForm").click(function(){
    if(!(checkEULA())){
        return;
    }
    var team_number =  document.getElementById("team-number"    ).value;
    var mentor_name =  document.getElementById("mentor-name"    ).value;
    var mentor_email = document.getElementById("mentor-email"   ).value;
    
    var address1 =     document.getElementById("address-line-1" ).value;
    var address2 =     document.getElementById("address-city"   ).value;
    var address3 =     document.getElementById("address-state"  ).value;
    var address4 =     document.getElementById("address-country").value;
    var zip = document.getElementById("zip").value;
    var age      =     document.getElementById("age"            ).value;
    
    var mentor_address = address1 + ", " + address2 + ", " + address3 + ", " + zip + ", " + address4;
    
    var mentor_phone = document.getElementById("mentor-phone"   ).value;
    var pass1 = document.getElementById("pass1"                 ).value;
    var pass2 = document.getElementById("pass2"                 ).value;
    
    if(mentor_name==""||mentor_email==""||pass1==""||pass2==""){
        alert("you did not fill in a required field");
        return;
    }
    
    if(!(pass1.toString()==pass2.toString())){
        alert("passwords do not match");
        return;
    }

    $.ajax({
        type:                               'POST',
        url:                                "./registermentor.php",
        data: {
            'mentor-name':                  mentor_name,
            'mentor-email':                 mentor_email,
            'mentor-address':               mentor_address,
            'mentor-phone':                 mentor_phone,
            'pass1':                        pass1,
            'pass2':                        pass2,
            'team-number':                  team_number,
            'age' :                         age,
            
            'FLLcheck':                     document.getElementById("FLLcheck"              ).checked,
            'FTCcheck':                     document.getElementById("FTCcheck"              ).checked,
            'FRCcheck':                     document.getElementById("FRCcheck"              ).checked,
            'VEXcheck':                     document.getElementById("VEXcheck"              ).checked,
            
            'skill-engineering':            document.getElementById("skill-engineering"     ).checked,
            
            'engineering-mechanical' :      document.getElementById("engineering-mechanical").checked,
            'engineering-electrical' :      document.getElementById("engineering-electrical").checked,
            
            'skill-manufacturing':          document.getElementById("skill-manufacturing"   ).checked,
            'skill-programming':            document.getElementById("skill-programming"     ).checked,
            'skill-cad':                    document.getElementById("skill-cad"             ).checked,
            
            'programming-c':                document.getElementById("programming-c"         ).checked,
            'programming-java':             document.getElementById("programming-java"      ).checked,
            'programming-csharp':           document.getElementById("programming-csharp"    ).checked,
            'programming-python':           document.getElementById("programming-python"    ).checked,
            'programming-robotc':           document.getElementById("programming-robotc"    ).checked,
            'programming-nxt':              document.getElementById("programming-nxt"       ).checked,
            'programming-labview':          document.getElementById("programming-labview"   ).checked,
            'programming-easyc':            document.getElementById("programming-easyc"     ).checked,
            'programming-ev3':              document.getElementById("programming-ev3"       ).checked,
            
            'skill-design':                 document.getElementById("skill-design"          ).checked,
            'skill-strategy':               document.getElementById("skill-strategy"        ).checked,
            'skill-scouting':               document.getElementById("skill-scouting"        ).checked,
            'skill-business':               document.getElementById("skill-business"        ).checked,
            'skill-fundraising':            document.getElementById("skill-fundraising"     ).checked,
            'skill-marketing':              document.getElementById("skill-marketing"       ).checked,
            'skill-other':                  document.getElementById("skill-other"           ).checked,
            
            'other-text-box':               document.getElementById("other-text-box"        ).value,
            'bio':                          document.getElementById("bio"                   ).value
        },
        success: function(data){
            document.getElementById("register-section").innerHTML = "Successfully Registered, please check your email and follow the link to verify your account";
            console.log("request successful");
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
    
    submitAddress(mentor_address);
});

//brings up the other text box if the other checkbox is checked
$("#skill-other").change(function(){
     if (this.checked) {
        document.getElementById("other-text-box").style.visibility="visible";
     }else{
        document.getElementById("other-text-box").style.visibility="hidden";
     }
});

//enables collapsable lists for skillsets
$("#skill-programming").change(function(){
    $("#programming-types-list").toggle();
});

$("#skill-engineering").change(function(){
        $("#engineering-types-list").toggle();
});