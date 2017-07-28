<?php
	session_start();
	require_once 'DB.php';
	require_once 'lang.php';
	
	$jezik = "en";
	if($_SESSION['lang']=="rs") {
		$jezik = "rs";
	}
	$_SESSION['lang'] = $jezik;

	$db = DB::getInstance();
	$lang = $lang[$jezik];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Snežana Crnoglavac Art</title>
	
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet" />
	<link href="style.min.css" rel="stylesheet" type="text/css" />
	<link rel="icon" type="image/png" href="images/favicon.png" />
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	
	<meta name="description" content="Official presentational website/blog of young artist Snezana Crnoglavac. For more information about me or my work, visit my website." />
	<meta name="keywords" content="Snezana Crnoglavac, Art, Snezana Art, Snezana Crnoglavac Art, Paintings, Sculptures, Drawings, Slike, Skulpture, Crtezi" />

	<meta name="author" content="Infinity Studio" />
	<meta name="copyright" content="Infinity Studio" />
	<meta name="application-name" content="Snežana Crnoglavac Art" />

	<meta property="fb:app_id" content="1905874692962285" />
	<meta property="og:title" content="Snežana Crnoglavac Art" />
	<meta property="og:type" content="website" />
	<meta property="og:video" content="http://www.snezana-art.com/images/bg.mp4" />
	<meta property="og:video:secure_url" content="https://www.snezana-art.com/images/bg.mp4" />
	<meta property="og:image" content="https://www.snezana-art.com/ogimage.png" />
	<meta property="og:url" content="https://www.snezana-art.com" />
	<meta property="og:description" content="Official presentational website/blog of young artist Snezana Crnoglavac. For more information about me or my work, visit my website." />

	<meta name="twitter:card" content="summary" />
	<meta name="twitter:title" content="Snežana Crnoglavac Art" />
	<meta name="twitter:description" content="Official presentational website/blog of young artist Snezana Crnoglavac. For more information about me or my work, visit my website." />
	<meta name="twitter:image" content="https://www.snezana-art.com/ogimage.png" />
	
	<script>
	  	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  	ga('create', 'UA-60339880-7', 'auto');
	  	ga('send', 'pageview');
	</script>
</head>
<body>
	<input type="hidden" value="<?= $jezik;?>" id="language">
	<img src="images/loading.gif" class="hidden" id="removeLoadingGif">
	<div id="loading"></div>
	
	<div id="popupgallery">
		<i class="close"></i>
		<div class="wrapper"></div>
	</div>

	<div id="viewGalleryImage">
		<input type="hidden" id="vgInfo" gid="" img="">
		<i class="close"></i>
		<i id="prev"></i>
		<i id="next"></i>
		<div class="center">
			<div class="size">
				<div class="img" id="vgImg" style=""></div>
				<span id="vgDesc"></span>
			</div>
		</div>
	</div>

	<header id="header">
		<div id="menuOnSmall"><i></i><span>Menu</span></div>
		<nav>
			<ul id="menu">
				<li class="c1"><a href="#home"><?=$lang['home']?></a></li>
				<li class="c2"><a href="#exhibitions"><?=$lang['exhibitions']?></a></li>
				<li class="c3"><a href="#about"><?=$lang['about']?></a></li>
				<li class="c4"><a href="#critics"><?=$lang['critics']?></a></li>
				<li class="c5"><a href="#gallery"><?=$lang['gallery']?></a></li>
				<li class="c6"><a href="#contact"><?=$lang['contact']?></a></li>
			</ul>
		</nav>

		<div class="socialnetworks">
			<a href="https://www.facebook.com/sneza.crnoglavac.art/" target="_blank"><i class="facebook mr-10">
			</i></a><a href="https://www.instagram.com/sneza.jsu/" target="_blank"><i class="instagram"></i></a>
		</div>

		<!--<div class="lang rs">Serbian</div>-->
		<div onClick="changeLang('<?=$jezik;?>');" class="lang <?=$jezik;?>" onmouseover="this.getElementsByTagName('span')[0].innerText = '<?=$lang['switch']?>';" onmouseleave="this.getElementsByTagName('span')[0].innerText = '<?=$lang['lang']?>';"><span><?=$lang['lang']?></span></div>
	</header>
	
	<main id="home">
		<video poster="images/background.jpg"  id="bgvid" playsinline autoplay muted loop>
			<source src="images/bg.mp4" type="video/mp4">
		</video>

		<div>
			<img class="logo" src="images/signature.png" alt="Snežana Crnoglavac">

			<a href="#gallery"><input type="button" value="<?=$lang['see-gallery']?>" class="button mr-20"></a>
			<a href="#contact"><input type="button" value="<?=$lang['contact-me']?>" class="button"></a>

		</div>
	</main>
	
	<section id="exhibitions">
		<div class="content width">
			<h2><?= $lang['exhibitions']?></h2>
			<div class="split">
			<?php
				$q = $db->query("SELECT * FROM objave",array());
				if($q->count()!=0) {
					foreach($q->results() as $exb) {
						echo "<div class='post'>
							<h3>{$exb->title}</h3>
							<span>{$exb->text}</span>
						</div>";
					}
				} else {

				}
			?>
			</div>
			<!--<div style="margin-top: 40px; text-align: center;">
				<input type="button" class="button-dark" name="" value="<?=$lang['read-more']?>">
			</div>-->
		</div>
	</section>	

	<section id="about">
		<div class="content width">
			<h2><?=$lang['about']?></h2>
			<div><img src="images/sneza.jpg" alt="Snezana Crnoglavac"/><span class="fw">
					<span><?=$lang['text-biography']?></span>
				</span>
			</div>
		</div>
	</section>

	<section id="critics">
		<div class="content width">
			<h2><?=$lang['critics']?></h2>
			<div class="split">
				<?php
					$q = $db->query("SELECT * FROM critics ORDER BY CHAR_LENGTH(`text`) DESC;",array());
					if($q->count()==0) {
						foreach($q->results() as $cri) {
							echo "<div class='post'>
								<h3>{$exb->title}</h3>
								<span>{$exb->text}</span>
							</div>";
						}
					} else if($q->count()==1) {

					} else {
						echo "<div class='half mr-20'>";
						$count = 0;
						foreach($q->results() as $cri) {
							$count++;
							if($count % 2 != 0) {
								echo "<div class='post'>
									<h3>{$cri->name}</h3>
									<span>{$cri->text}</span>
								</div>";
							}
						}
						echo "</div><div class='half'>";
						$count = 0;
						foreach($q->results() as $cri) {
							$count++;
							if($count % 2 == 0) {
								echo "<div class='post'>
									<h3>{$cri->name}</h3>
									<span>{$cri->text}</span>
								</div>";
							}
						}	
						echo "</div>";
					}
				?>
				<!--<div style="margin-top: 40px; text-align: center;">
					<input type="button" class="button-dark" name="" value="<?=$lang['read-more']?>">
				</div>-->
			</div>
		</div>
	</section>

	<section id="gallery">
		<div class="flex">
			<div>
				<input type="button" class="button mr-20" value="<?=$lang['view-paintings']?>" onClick="viewGallery(1);">
				<input type="button" class="button mr-20 m1" value="<?=$lang['view-sculptures']?>" onClick="viewGallery(2);">
				<input type="button" class="button m2" value="<?=$lang['view-drawings']?>" onClick="viewGallery(3);">
			</div>
		</div>
	</section>

	<section id="contact">
		<div class="content contact-width">
			<h2><?=$lang['contact']?></h2>
			<div class="contact-width">
				<div id="c-loading"></div>
				<div class="infomessage" style="display: none;" id="contactInfoMsg">
					<div class="img"></div>
					<div class="text"></div>
				</div>

				<div class="split">
					<div class="half mr-20">
						<label><?=$lang['full-name']?></label>
						<input type="text" id="fullName" class="inputtext width-100">
					</div><div class="half">
						<label><?=$lang['email']?></label>
						<input type="text" id="emailAdress" class="inputtext width-100">
					</div>
				</div>
				<label><?=$lang['message']?></label>
				<textarea rows="5" class="width-100" id="message"></textarea>
				<input type="button" class="button-dark mt-20 floatr" onClick="sendEmail();" value="<?=$lang['send']?>">
				<div class="clear"></div>
			</div>
		</div>
	</section>

	<footer>
		<div class="floatl">Snežana Crnoglavac Art © <?=date('Y')?>. <?=$lang['copyright']?></div>
		<div class="floatr"><?=$lang['infstudio']?> <a href="https://www.infstudio.com" target="_blank"><strong>Infnity Studio</strong></a></div>		
	</footer>

</body>
<!--<script type="text/javascript" src="lib/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="lib/script.js"></script>-->
<script type="text/javascript" src="lib/javascript.min.js"></script>
</html>