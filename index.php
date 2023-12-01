<?php require("./mysql.php"); ?>
<!doctype html>
<html>
<head>
	<title>Thomas Tsoi - Toronto, ON</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="opensans.css" type="text/css" />
	<link rel="stylesheet" href="roboto.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

</head>
<body>
<div id="page">
	<div id="side_left">
		<div id="badge">
			<h1 id="site-title">Thomas Tsoi</h1>
			<div id="location">
				Toronto, ON
			</div>
			<div id="roles">
				<span>Full Stack Developer</span> |
				<span>Data Engineer</span> |
				<span>Linguist</span> |
				<span>Educator</span> |
				<span>Globetrotter</span>
			</div>
		</div>
	</div>
	
	<div id="main_"><div id="main">
	
		<h1 class="sectiontitle">Objective</h1>
		
		<div id="pquote">
			<div id="clipper">
					<img src="images/thomas-tsoi.jpg">
			</div>
			
			<div id="quotebox">
				<img class="quote_open" src="images/quote_close.png">
				I am seeking a challenging role as a full-time full-stack developer.
				<img class="quote_close" src="images/quote_open.png">
			</div>
			
			<div class="clear"></div>
		</div><!-- pquote -->
		
		<h1 class="sectiontitle" id="bookmark_skills">Skills</h1>
		
		<?php
		include 'part_skills.php';
		?>
		
		<h1 class="sectiontitle" id="bookmark_portfolio">Portfolio</h1>
		
		<?php
		include 'part_portfolio.php';
		?>
		
		<h1 class="sectiontitle" id="bookmark_resume">Resume</h1>
		
		<?php
		include 'part_resume.php';
		?>
		
	
		<?php for ($i=0;$i<50;$i++){?>
		<div>Line <?php echo $i+1;?></div>
		<?php }?>
	</div></div><!-- main -->
	
	<div id="side_right">
		<div id="profilelinks">
			<a class="profile" href="https://linkedin.com/in/tsoithomas"><img src="images/link_linkedin.svg"></a>
			<a class="profile" href="https://profile.indeed.com/p/waichuenthomast-gkp5xsp"><img src="images/link_indeed.svg"></a>
			<a class="profile" href="https://github.com/tsoithomas"><img src="images/link_github.svg"></a>
			<a class="profile" href="https://leetcode.com/thomastsoi/"><img src="images/link_leetcode.svg"></a>
			<a class="profile" href="mailto://tsoithomas@outlook.com"><img src="images/link_email_me.svg"></a>
			
			<div class="clear"></div>
			
		</div>
	</div>
	
	<div id="bookmarks">
		<a class="bookmark"><span class="label">About</span><img src="images/button_about.png"></a>
		<a class="bookmark"><span class="label">Skills</span><img src="images/button_skills.png"></a>
		<a class="bookmark portfolio"><span class="label">Portfolio</span><img src="images/button_portfolio.png"></a>
		<a class="bookmark"><span class="label">Resume</span><img src="images/button_resume.png"></a>
		<a class="bookmark contact"><span class="label">Contact</span><img src="images/button_contact.png"></a>
		
	</div>
	
</div><!-- page -->

</body>
</html>