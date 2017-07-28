<?php
	session_start();

	require_once 'DB.php';
	$db = DB::getInstance();

	$lang = $_SESSION['lang'];

	$action = $_POST['action'];

	if($action=="sendEmail") {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$text = nl2br($_POST['msg']);
		if($name==""||$email==""||$text=="") {
			echo "2";
		} else {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$to = "office@snezana-art.com";
				$subject = "New message from website";
				$txt = "Sender: $name<br><p>$text</p>";
				
				$headers = "From: $email" . "\r\n" .
				"Reply-To: $email" . "\r\n" .
				"Content-Type: text/html; charset=utf-8\r\n";
				
				ini_set("SMTP","mail.reikonkarate.com");
				ini_set('smtp_port', 587);
				ini_set('sendmail_from', $email);
				mail($to,$subject,$txt,$headers);
				echo "1";
			} else {
				echo "3";
			}
		}
	}

	if($action=="changeImage") {
		$img = $_POST['img'];
		$gid = $_POST['gid'];
		$pn = $_POST['pn'];
		
		$slike = array();
		$q = $db->query("SELECT * FROM gallery WHERE `page` = '$gid' ORDER BY id DESC",array());
		if($q->count()!=0) {
			foreach($q->results() as $gal) {
				$slike[] = $gal->link;
			}
		}

		$brslika = count($slike);
		
		$f = null;
		if($brslika==1){
			echo $img;
		} else {
			$c = 0;
			foreach($slike as $s) {
				if($s==$img)
					$f = $c;
				$c++;
			}

			if($pn==1) {
				if($f==0) {
					$send = $brslika-1;
				} else {
					$send = $f - 1;
				}
			} else {
				if($f==$brslika-1) {
					$send = 0;
				} else {
					$send = $f + 1;
				}
			}
			echo $slike[$send];
		}
	}

	if($action=="getImageDesc") {
		$img = $_POST['url'];
		$q = $db->query("SELECT * FROM gallery WHERE `link` = '$img'",array());

		if($lang=="en")
			$notfound = "This image doesn't have a description.";
		else 
			$notfound = "Slika nema opis.";

		if($q->count()!=0) {
			if($lang=="en")
				$desc =  $q->first()->desc;
			else
				$desc = $q->first()->desc_rs;

			if($desc=="")
				echo $notfound;
			else
				echo $desc;
		} else {
			echo $notfound;
		}
	}

	if($action=="viewGallery") {
		$gal = $_POST['gid'];
		echo "<div class='half'>";
		$q = $db->query("SELECT * FROM gallery WHERE page = $gal ORDER BY id DESC",array());
		if($q->count()!=0) {
			$c = 0;
			foreach($q->results() as $gal) {
				$c++;
				if($c%2!=0)
					echo "<img src='{$gal->link}'>";
			}
		}
		echo "</div><div class='half'>";
		if($q->count()!=0) {
			$c = 0;
			foreach($q->results() as $gal) {
				$c++;
				if($c%2==0)
					echo "<img src='{$gal->link}'>";
			}
		}
		echo "</div>";
	}

	if($action=="switchLang") {
		$lang = $_POST['lang'];
		if($lang=="rs") {
			$_SESSION['lang'] = "en";
		} else {
			$_SESSION['lang'] = "rs";
		}
	}