<?php function echoResetPasswordEmail($key, $SITE_ROOT){ return '
<html>
	<head>
		<style>
			@import url(https://fonts.googleapis.com/css?family=Open+Sans:700,400);
			#container{
				width:600px;
				position: absolute;
				border-style: solid;
				border-width: 1px;
			}
			#header, #footer{
				float:left;
				width:100%;
			}
			#body{
				float: left;
			}
			h1, p{
				font-family: \'OpenSans\', sans-serif;
			}
			h1{
				font-size: 24px;
				padding-left: 10px;
			}
			p{
				font-size: 18px;
				padding-left: 10px;
				text-decoration: none;
			}
			a{
				text-decoration: none;
			}
			a:visited{
				text-decoration: none;
				color: black;
			}
		</style>
	</head>
	<div id="container">
		<div id="header">
			<img src="<?php echo $SITE_ROOT; ?>/images/mentorheader.jpg"/>
		</div>
		<div id="body">
			<h1>Your account has submitted a password request.</h1>
			<p>To reset your password, click this <a href="'.$SITE_ROOT.'reset.php?key='.$key.'">link.</a></p>
			<p>
				<br/>
				From,<br/>
				The MentorMaps Programming Team<br/>
				Team 3309
				<br/>
				<br/>
				<a href=\'http://www.team3309.org\'>Team 3309 Website</a> | <a href=\'https://www.facebook.com/friarbots\'>Team 3309 Facebook Page</a>
			</p>
		</div>
			
		<div id="footer">
			<img src="<?php echo $SITE_ROOT; ?>/images/mentorfooter.jpg"/>
		</div>
	</div>
</html>';
}