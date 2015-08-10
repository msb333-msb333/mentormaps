<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
header('Content-Type: application/json');
	require "./db.php";
	require "./security/salt.php";
	
	$team_age = mysql_escape_mimic($_POST['team-age']);	
	$team_name = mysql_escape_mimic($_POST['team-name']);	
	$team_email = mysql_escape_mimic($_POST['team-email']);
	$team_address = mysql_escape_mimic($_POST['team-address']);
	$team_phone = mysql_escape_mimic($_POST['team-phone']);
	$comments = mysql_escape_mimic($_POST['comments']);
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$team_number = mysql_escape_mimic($_POST['team-number']);
	
	$team_age=str_replace("<script", "im a dirty little hacker: ", $team_age);
	$team_name=str_replace("<script", "im a dirty little hacker: ", $team_name);
	$team_email=str_replace("<script", "im a dirty little hacker: ", $team_email);
	$team_address=str_replace("<script", "im a dirty little hacker: ", $team_address);
	$team_phone=str_replace("<script", "im a dirty little hacker: ", $team_phone);
	$comments=str_replace("<script", "im a dirty little hacker: ", $comments);
	$team_number=str_replace("<script", "im a dirty little hacker: ", $team_number);
	
	$pref_fll = $_POST['FLLcheck'];
	$pref_ftc = $_POST['FTCcheck'];
	$pref_frc = $_POST['FRCcheck'];
	$pref_vex = $_POST['VEXcheck'];
	
	$skill_mech = $_POST['skill-mechanical-engineering'];
	$skill_prog = $_POST['skill-programming'];
	$skill_strat = $_POST['skill-strategy'];
	$skill_bus = $_POST['skill-business'];
	$skill_mark = $_POST['skill-marketing'];
	$skill_manu = $_POST['skill-manufacturing'];
	$skill_design = $_POST['skill-design'];
	$skill_scout = $_POST['skill-scouting'];
	$skill_fr = $_POST['skill-fundraising'];
	$skill_other = $_POST['skill-other'];
	$skill_other_desc = mysql_escape_mimic($_POST['other-text-box']);
	
	$skill_other_desc=str_replace("<script", "im a dirty little hacker: ", $skill_other_desc);
	
	$json = array('skill-mechanical-engineering' => $skill_mech,
				  'skill-programming' => $skill_prog,
				  'skill-strategy' => $skill_strat,
				  'skill-business' => $skill_bus,
				  'skill-marketing' => $skill_mark,
				  'skill-manufacturing' => $skill_manu,
				  'skill-design' => $skill_design,
				  'skill-scouting' => $skill_scout,
				  'skill-fundraising' => $skill_fr,
				  'skill-other' => $skill_other,
				  'skill_other_desc' => $skill_other_desc
				  );
	
	$json_encoded_skills = json_encode($json);
					
	$pref = json_encode(array(  'pref_fll' => $pref_fll,
								'pref_ftc' => $pref_ftc,
								'pref_frc' => $pref_frc,
								'pref_vex' => $pref_vex));
	
	$team_pass = mysql_escape_mimic($pass1);
	$salt = createSalt($team_email);
	$concatPass = $team_pass . $salt;
	$pass_hash = md5($concatPass);
	$sql = "INSERT INTO `logins` (`EMAIL`, `PASSWORD`, `TYPE`) VALUES ('" . $team_email . "', '" . $pass_hash . "', 'TEAM');";	
	$db->query($sql);
	
	//var conversions cause im too lazy to change the js
	$email = $team_email;
	$address = $team_address;
	$name = $team_name;
	$phone = $team_phone;
	$type = $pref;
	$skills_json = $json_encoded_skills;
	$age = $team_age;
	
	$sql = "INSERT INTO `data` (`ACCOUNT_TYPE`, `NAME`, `SKILLS_JSON`, `TEAM_NUMBER`, `COMMENTS`, `PHONE`, `EMAIL`, `ADDRESS`, `TYPE`, `AGE`) VALUES ('TEAM', '".$name."', '".$skills_json."', '".$team_number."', '".$comments."', '".$phone."', '".$email."', '".$address."', '".$type."', '".$age."');";
	
	$db->query($sql);
	echo "{\"status\":\"ok\"}";
}else{
	require "./core.php";
	echoHeader();
?>
				<!-- Main -->
					<article id="main">
						<header>
							<h2>Register as a Team</h2>
							<p><!--text here :D--></p>	
						</header>
						<section class="wrapper style5">
							<div class="inner">
								<section id="register-section">
									<h4>Team Registration</h4>
									<div>
										<div class="row uniform">
											<div class="6u 12u$(xsmall)">
												<input type="text" name="team-name" id="team-name" placeholder="Team Name" />
											</div>
											<div class="6u$ 12u$(xsmall)">
												<input type="email" name="team-email" id="team-email" placeholder="Email" />
											</div>
											<div class="6u 12u$(small)">
												<input type="password" name="pass1" id="pass1" placeholder="Password" />
											</div>
											<div class="6u 12u$(small)">
												<input type="password" name="pass2" id="pass2" placeholder="Retype Password" />
											</div>
											<div class="6u 12u$(small)">
												<input type="text" name="team-number" id="team-number" placeholder="Team Number" />
											</div>
											<div class="6u 12u$(xsmall)">
												<input type="text" name="team-address" id="team-address" placeholder="Address" />
											</div>
											<div class="6u 12u$(xsmall)">
												<input type="text" name="team-address" id="team-age" placeholder="Team Age (Optional)" />
											</div>
											<div class="6u 12u$(xsmall)">
												<input type="text" name="team-phone" id="team-phone" placeholder="Phone Number (Optional)" />
											</div>
											<div class="3u 12u$(small)">
												<input type="radio" id="FLLcheck" name="typeChecks" checked>
												<label for="FLLcheck">FLL</label>
											</div>
											<div class="3u 12u$(small)">
												<input type="radio" id="FTCcheck" name="typeChecks">
												<label for="FTCcheck">FTC</label>
											</div>
											<div class="3u 12u$(small)">
												<input type="radio" id="FRCcheck" name="typeChecks">
												<label for="FRCcheck">FRC</label>
											</div>
											<div class="3u 12u$(small)">
												<input type="radio" id="VEXcheck" name="typeChecks">
												<label for="VEXcheck">VEX</label>
											</div>
											<div class="6u 12u$(small)">
												Searching for...
											</div>
											<div class="6u 12u$(small)">
												<br />&nbsp;
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-mechanical-engineering" name="mechanical-engineering">
												<label for="skill-mechanical-engineering">Mechanical Engineering</label>
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-manufacturing" name="manufacturing">
												<label for="skill-manufacturing">Manufacturing</label>
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-programming" name="programming">
												<label for="skill-programming">Programming</label>
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-design" name="design">
												<label for="skill-design">Design</label>
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-strategy" name="strategy">
												<label for="skill-strategy">Strategy</label>
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-scouting" name="scouting">
												<label for="skill-scouting">Scouting</label>
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-business" name="business">
												<label for="skill-business">Business</label>
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-fundraising" name="fundraising">
												<label for="skill-fundraising">Fundraising</label>
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-marketing" name="marketing">
												<label for="skill-marketing">Marketing</label>
											</div>
											<div class="6u 12u$(small)">
												<input type="checkbox" id="skill-other" name="other">
												<label for="skill-other">Other</label>
											</div>
											<div class="6u 12u$(small)"></div>
											<div class="6u 12u$(small)" style="visibility: hidden;">
												<input type="text" id="other-text-box" name="other-text-box" placeholder="define 'other'">
											</div>
											<div class="12u$">
												<textarea name="comments" id="comments" placeholder="Write something about your team" rows="6"></textarea>
											</div>
											<!--<div class="6u$ 12u$(small)">
												<div class="g-recaptcha" data-sitekey="6Le4JAoTAAAAAEVE_IFxMAiK2vdgoiQoo9R5SCTN"></div>
											</div>-->
											<div class="12u$">
												<button id="submitTeamRegistrationForm" class="button special">Become a Team</button>
											</div>
										</div>
									</div>
								</section>
							</div>
						</section>
					</article>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Joseph Sirna 2015</li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="./customjquery.js"></script>

	</body>
</html>
<?php
}
?>