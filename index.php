<?php

 $memberId = $_GET['memberId'];
 $imageC = $_GET['image'];
 $profilePic2 = $_GET['pfp'];
 $color2 = $_GET['color'];
 $apiKey = '68ce5eb0fbe64760b84aff266da27c8a';

//Get Destiny MembershipID
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, 'https://www.bungie.net/Platform/User/GetMembershipsById/'.$memberId.'/-1/');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('X-API-Key: ' . $apiKey));

    $json = json_decode(curl_exec($ch2),true, 512, JSON_BIGINT_AS_STRING);


    foreach ($json['Response']['destinyMemberships'] as &$membership) {
    $membershipType = $membership['membershipType'];
    if ($membershipType == 4) {
        $member = $membership['membershipId'];
        $memberName = $membership['displayName'];
    }
}


// Profile Picture
    $profilePic = $json['Response']['bungieNetUser']['profilePicturePath'];
    $bgPic = $json['Response']['bungieNetUser']['profileThemeName'];

 //Get Stats
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.bungie.net/Platform/Destiny2/4/Account/'.$member.'/Stats/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-Key: ' . $apiKey));
 
    $json2 = json_decode(curl_exec($ch),true, 512, JSON_BIGINT_AS_STRING);

    $results = curl_exec($ch);

//Get Kill and Death Amount
    $kill = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['kills']['basic']['value'];
    $deaths = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['deaths']['basic']['value'];
    $score = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['score']['basic']['value'];
    $wins = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['activitiesWon']['basic']['value'];
    $winloss = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['winLossRatio']['basic']['displayValue'];

//Get K/D
    $kd = $kill / $deaths;
//Round K/D
    $kd1 = number_format($kd, 2, '.', '');

// Get Clan
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, 'https://www.bungie.net/Platform/GroupV2/User/4/'.$member.'/0/1/');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('X-API-Key: ' . $apiKey));

    $json3 = json_decode(curl_exec($ch2),true, 512, JSON_BIGINT_AS_STRING);

    $clan = $json3['Response']['results'][0]['group']['name'];


//Make Image

    header("Content-type: image/png");
    $string = $kd1;
    $string5 = 'K/D: ';

    $string2 = $kill;
    $string4 = 'Kills: ';

    $string3 = $memberName;
    
    $string8 = $clan;

    $string9 = $deaths;
    $string6 = 'Deaths: ';

    $string10 = $score;
    $string11 = 'Score: ';
    $string12 = $wins;
    $string13 = 'Wins: ';
    $string14 = $winloss;
    $string15 = 'W/L: ';

    if(isset($_GET['pfp'])) {
        if ($profilePic2 == '1'){
            $pic2 = 'https://www.bungie.net'.$profilePic;
        } else {
            $pic2 = $profilePic2;
        }
    }

    if(isset($_GET['image'])){
        if ($imageC == '1'){
            $img1 = 'https://www.bungie.net/img/UserThemes/'.$bgPic.'/mobiletheme.jpg';
            $im1 = imagecreatefromstring(file_get_contents($img1));
            $im = imagecrop($im1, ['x' => 0, 'y' => 40, 'width' => 474, 'height' => 96]);
        } else if ($imageC == '2'){
            $img1 = "images/buttons.png";
            $im = imagecreatefromstring(file_get_contents($img1));
        } else if ($imageC == '3'){
            $img1 = "images/buttons2.png";
            $im = imagecreatefromstring(file_get_contents($img1));
        } else if ($imageC == '4'){
            $img1 = "images/buttons3.png";
            $im = imagecreatefromstring(file_get_contents($img1));
        } else if ($imageC == '5'){
            $img1 = "images/buttons4.png";
            $im = imagecreatefromstring(file_get_contents($img1));
        } else if ($imageC == '6'){
            $img1 = "images/buttons5.png";
            $im = imagecreatefromstring(file_get_contents($img1));
        } else if ($imageC == '7'){
            $img1 = "images/buttons6.png";
            $im = imagecreatefromstring(file_get_contents($img1));
        } else {
            $img1 = $imageC; 
            $im = imagecreatefromstring(file_get_contents($img1));
        }
    }
    
    if(isset($_GET['color'])){
        if ($color2 == 'white'){
            $white = imagecolorallocate($im, 255, 255, 255);
            $orange = imagecolorallocate($im, 220, 210, 60);
        } else if ($color2 == 'black'){
            $white = imagecolorallocate($im, 0, 0, 0);
            $orange = imagecolorallocate($im, 115, 115, 115);
        }
    }
    
    
    $px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
    $px2     = (imagesx($im) - 7.5 * strlen($string)) / 20;
    $image = imagecreatefromstring(file_get_contents($pic2));

    list($width, $height) = getimagesize($pic2);

    $font = imageloadfont('fonts/tahoma.gdf');
    $font2 = imageloadfont('fonts/tahoma2.gdf');
    $font3 = imageloadfont('fonts/tahoma3.gdf');
    $font4 = imageloadfont('fonts/tahoma4.gdf');

	putenv('GDFONTPATH=' . realpath('.'));
    $font5="./Tahoma.ttf"; 
	$font6="./helvetica.ttf";
    
    
    // Name + Line
	imagettftext($im, 15, 0, 90, 20, $white, $font6, $string3);
    //imagestring($im, $font3, 90, 5, $string3, $white);
    imageline($im, 85, 22, 470, 22, $white);
    // Clan
	imagettftext($im, 10, 0, 325, 20, $white, $font5, $string8);
    //imagestring($im, $font3, 250, 5, $string8, $white);
    // Image
    imagecopyresampled($im, $image, 5, 5, 0, 0, 75, 75, $width, $height); //$im_x, $im_y, $image_x, $image_y, $image_w, $image_h
    // Kills
	imagettftext($im, 10, 0, 90, 38, $white, $font6, $string4);
	imagettftext($im, 10, 0, 90, 53, $white, $font6, $string6);
	imagettftext($im, 10, 0, 90, 68, $white, $font6, $string5);

	imagettftext($im, 10, 0, 210, 38, $white, $font6, $string13);
	imagettftext($im, 10, 0, 210, 53, $white, $font6, $string11);
	imagettftext($im, 10, 0, 210, 68, $white, $font6, $string15);
// --->
	imagettftext($im, 10, 0, 150, 38, 0, $font6, $string2);
	imagettftext($im, 10, 0, 151, 38, $orange, $font6, $string2);

	imagettftext($im, 10, 0, 150, 53, 0, $font6, $string9);
	imagettftext($im, 10, 0, 151, 53, $orange, $font6, $string9);	

	imagettftext($im, 10, 0, 150, 68, 0, $font6, $string);
	imagettftext($im, 10, 0, 151, 68, $orange, $font6, $string);	

// --->
	imagettftext($im, 10, 0, 270, 38, 0, $font6, $string12);
	imagettftext($im, 10, 0, 271, 38, $orange, $font6, $string12);

	imagettftext($im, 10, 0, 270, 53, 0, $font6, $string10);
	imagettftext($im, 10, 0, 271, 53, $orange, $font6, $string10);

	imagettftext($im, 10, 0, 270, 68, 0, $font6, $string14);
	imagettftext($im, 10, 0, 271, 68, $orange, $font6, $string14);	
    //imagestring($im, $font4, 90, 25, $string4, $white);
    //imagestring($im, $font4, 150, 25, $string2, $orange);
    // Deaths
    //imagestring($im, $font4, 90, 40, $string6, $white);
    //imagestring($im, $font4, 150, 40, $string9, $orange);
    // K/D
    //imagestring($im, $font4, 90, 55, $string5, $white);
    //imagestring($im, $font4, 150, 55, $string, $orange);
    // Wins
    //imagestring($im, $font4, 210, 25, $string13, $white);
    //imagestring($im, $font4, 270, 25, $string12, $orange);
    // Score
    //imagestring($im, $font4, 210, 40, $string11, $white);
    //imagestring($im, $font4, 270, 40, $string10, $orange);
    // W/L
    //imagestring($im, $font4, 210, 55, $string15, $white);
    //imagestring($im, $font4, 270, 55, $string14, $orange);


    //clanaod.net
    imagestring($im, 1, 365, 85, 'BY SAENAI CLANAOD.NET <3', $white);


    imagepng($im);
    imagedestroy($im);
    

 ?>
