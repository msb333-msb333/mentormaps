function passworkCheck(pass1, pass2){
    return (pass1.toString()==pass2.toString());
}

function createSkillsArray(){
            var data = {
                engineering_mechanical:         $("#engineering-mechanical").is(":checked"),
                engineering_electrical:         $("#engineering-electrical").is(":checked"),

                programming_c:                  $("#programming-c").is(":checked"),
                programming_java:               $("#programming-java").is(":checked"),
                programming_csharp:             $("#programming-csharp").is(":checked"),
                programming_python:             $("#programming-python").is(":checked"),
                programming_robotc:             $("#programming-robotc").is(":checked"),
                programming_nxt:                $("#programming-nxt").is(":checked"),
                programming_labview:            $("#programming-labview").is(":checked"),
                programming_easyc:              $("#programming-easyc").is(":checked"),
                programming_ev3:                $("#programming-ev3").is(":checked"),

                cad:                            $("#skill-cad").is(":checked"),
                design:                         $("#skill-design").is(":checked"),
                strategy:                       $("#skill-strategy").is(":checked"),
                scouting:                       $("#skill-scouting").is(":checked"),
                business:                       $("#skill-business").is(":checked"),
                fundraising:                    $("#skill-fundraising").is(":checked"),
                marketing:                      $("#skill-marketing").is(":checked"),
                other:                          $("#skill-other").is(":checked"),
                other_desc:                     $("#other-text-box").is(":checked")
            };
            return JSON.stringify(data);
        }

        function createTypeArray(){
            var data = {
                frc: $("#FRCcheck").is(":checked"),
                ftc: $("#FTCcheck").is(":checked"),
                fll: $("#FLLcheck").is(":checked"),
                vex: $("#VEXcheck").is(":checked")
            };
            return JSON.stringify(data);
        }

        function createAddress(){
            var address =   $("#address-line-1").val();
            var city =      $("#address-city").val();
            var state =     $("#address-state").val();
            var zip =       $("#zip").val();
            var country =   $("#address-country").val();
            return address + ", " + city + ", " + zip + ", " + state + ", " + country;//TODO don't add commas if the address parts are not set
        }

        function addUserData(email, accountType, registrantName){
            var UDClass = Parse.Object.extend("UserData");
            var ud = new UDClass();
            
            var address = createAddress();

            ud.set("email", email);
            ud.set("skillsJSON", createSkillsArray());
            ud.set("typeJSON", createTypeArray());
            ud.set("address", address);
            ud.set("name", $("#name").val());
            ud.set("teamNumber", $("#teamNumber").val());
            ud.set("comments", $("#bio").val());
            ud.set("phone", $("#phone").val());
            ud.set("age", $("#age").val());
            ud.set("accountType", accountType);
            ud.set("registrantName", registrantName);

            ud.save(null, {
                success: function(ud){
                    geocode(address);
                },
                error: function(ud, error){
                    alert('Failed to add user data, error code: ' + error.message);
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