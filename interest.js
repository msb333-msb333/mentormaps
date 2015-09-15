function updateInterest(interest, email, from, level){
    console.log("val of int param: " + interest);
    if(level==1){
        if(interest){
            console.log("int is true, adding " + email + " to myint");
            myInterests.lv1.push(email);
            theirInterests.lv1.push(from);
        }else{
            console.log("int is false, removing " + email + " from myint");
            myInterests.lv1.splice(myInterests.lv1.indexOf(email), 1);
            theirInterests.lv1.splice(theirInterests.lv1.indexOf(from), 1);
        }
    }else{
        if(interest){
            console.log("int is true, adding " + email + " to myint");
            myInterests.lv2.push(email);
            theirInterests.lv2.push(from);
        }else{
            console.log("int is false, removing " + email + " from myint");
            myInterests.lv2.splice(myInterests.lv2.indexOf(email), 1);
            theirInterests.lv2.splice(theirInterests.lv2.indexOf(from), 1);
        }
    }

    console.log("new myint: " + myInterests);
    console.log("new theirint: " + theirInterests);

    $.ajax({
        url: './updateinterest.php',
        type: 'POST',
        data: {
            'theirEmail': email,
            'myEmail': "<?php echo $_SESSION['email']; ?>",
            'theirIntJSON': JSON.stringify(theirInterests),
            'myIntJSON': JSON.stringify(myInterests)
        }
    });
}