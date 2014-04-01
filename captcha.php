<?php
/*
*	Proud captcha by Szymon Filipczyk
*/
$time_start = microtime(true); 

session_start();

	// http://openfontlibrary.org/en/font/on-the-wall
	$font = "OnTheWall2.ttf";
	
	// Avitable characters for captcha
	$characters = "1234567890";
	
	// Captcha global varibles
	$captcha_length = 6;
	$captcha_width = 256;	//128	256
	$captcha_height = 64;	//32	64
	$font_size = 30;		//10	30
	$image = imagecreatetruecolor($captcha_width, $captcha_height);

	// Add lines into captcha
	$lines = imagecolorallocate ( $image, rand(0, 255), rand(0, 255), rand(0, 255));
		for($i = 1; $i <= rand(20, 80); $i++)
			imageline($image, 0, rand(rand(-200,100),imagesy($image)+120),imagesx($image),rand(rand(-200,100),imagesy($image)+110), $lines);
	
	// Add random chars
	for($i = 1; $i <= rand(10,500); $i++) {
		$char = $characters[rand(0, strlen($characters)-1)];
		$char_distance_fake += rand(1,10);
		$kolor = imagecolorallocate($image, rand(100,220), rand(100,220), rand(100,220));
		if (file_exists($font))
			imagettftext($image, $font_size + rand(-5, 5), rand(-30, 30), $char_distance_fake, rand(0, $captcha_height), $kolor, $font, $char);
		else
			imagestring($image, rand(1,5), $char_distance_fake, rand(0, 64), $char, $kolor);
	}

	// Add blur effect for lines and backgound random image
	for ($i = 0; $i <= rand(2,3); $i++)
    	imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);

	// Add random img effects 
	imagefilter($image, IMG_FILTER_BRIGHTNESS, rand(-10, 25));
	imagefilter($image, IMG_FILTER_CONTRAST ,rand(-25, 25));
	imagefilter($image, IMG_FILTER_COLORIZE);
	
	// Add password captcha chars into captcha
	for($i = 1; $i <= $captcha_length; $i++) {
		$char = $characters[rand(0, strlen($characters)-1)];
		$password .= $char;
		$char_distance += $captcha_width / ( $captcha_length + 5 ) + rand(0,10);
		$kolor = imagecolorallocate($image, rand(100,250), rand(100,250), rand(100,250));
		if (file_exists($font))
			imagettftext($image, $font_size, rand(-30, 30), $char_distance, rand($font_size, $captcha_height - $font_size), $kolor, $font, $char);
		else
			imagestring($image, rand(1,5), $char_distance, rand(5, $captcha_height-15), $char, $kolor);
	}

	// Add random img effects 
	imagefilter($image, IMG_FILTER_BRIGHTNESS, rand(-10, 25));
	imagefilter($image, IMG_FILTER_CONTRAST, rand(-25, 0));
	imagefilter($image, IMG_FILTER_COLORIZE);
	
	// Get final image
	header('Content-Type: image/jpeg');
	imagejpeg($image);
	imagedestroy($image);
	
	$time_end = microtime(true);
	
	// Save in session captcha password
	$_SESSION['captcha'] = $password;
	$_SESSION['captcha_generation_time'] = ($time_end - $time_start)/60;
?>