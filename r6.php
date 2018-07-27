<?php

 $memberId = $_GET['memberId'];
 $imageC = $_GET['image'];
 $profilePic2 = $_GET['pfp'];
 //$apiKey = '68ce5eb0fbe64760b84aff266da27c8a';
 $apiKey = 'MyRequest';

//Get Destiny MembershipID
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, 'https://r6db.com/api/v2/players?name='.$memberId.'');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('X-App-Id: ' . $apiKey));

    $json = json_decode(curl_exec($ch2),true, 512, JSON_BIGINT_AS_STRING);

    $member = $json[0]['userId'];

 //Get Stats
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://r6db.com/api/v2/players?ids='.$member.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-App-Id: ' . $apiKey));
 
    $json2 = json_decode(curl_exec($ch),true, 512, JSON_BIGINT_AS_STRING);


    //var_dump($json2);

    $kill = $json2[0]['stats']['general']['kills'];
    $deaths = $json2[0]['stats']['general']['deaths'];
    $won = $json2[0]['stats']['general']['won'];
    $lost = $json2[0]['stats']['general']['lost'];
    $level = $json2[0]['level'];

    $winloss1 = $won / $lost;

    $winloss = number_format($winloss1, 2, '.', '');

    //$results = curl_exec($ch);
/*
//Get Kill and Death Amount
    $kill = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['kills']['basic']['value'];
    $deaths = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['deaths']['basic']['value'];
    $score = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['score']['basic']['value'];
    $wins = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['activitiesWon']['basic']['value'];
    $winloss = $json2['Response']['mergedAllCharacters']['results']['allPvP']['allTime']['winLossRatio']['basic']['displayValue'];
*/
//Get K/D
    $kd = $kill / $deaths;
//Round K/D
    $kd1 = number_format($kd, 2, '.', '');



    /*
// Get Clan
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, 'https://www.bungie.net/Platform/GroupV2/User/4/'.$member.'/0/1/');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('X-API-Key: ' . $apiKey));

    $json3 = json_decode(curl_exec($ch2),true, 512, JSON_BIGINT_AS_STRING);

    $clan = $json3['Response']['results'][0]['group']['name'];
*/

//Make Image

    header("Content-type: image/png");
    $string = $kd1;
    $string5 = 'K/D: ';

    $string2 = $kill;
    $string4 = 'Kills: ';

    $string3 = $memberId;
    
    $string16 = 'Level: ';
    $string8 = $level;

    $string9 = $deaths;
    $string6 = 'Deaths: ';

    $string10 = $lost;
    $string11 = 'Lost: ';

    $string12 = $won;
    $string13 = 'Wins: ';

    $string14 = $winloss;
    $string15 = 'W/L: ';

    if(isset($_GET['pfp'])) {
        if ($profilePic2 == '1'){
            $pic2 = 'http://uplay-avatars.s3.amazonaws.com/'.$member.'/default_146_146.png';
        } else {
            $pic2 = $profilePic2;
        }
    }

    if(isset($_GET['image'])){
        if ($imageC == '1'){
            $img1 = "images/buttons8.png"; 
        } else {
            $img1 = $imageC; 
        }
    }
    
    $im = imagecreatefromstring(file_get_contents($img1));
    $orange = imagecolorallocate($im, 220, 210, 60);
    $white = imagecolorallocate($im, 255, 255, 255);
    $px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
    $px2     = (imagesx($im) - 7.5 * strlen($string)) / 20;
    $image = imagecreatefromstring(file_get_contents($pic2));

    list($width, $height) = getimagesize($pic2);

    $font = imageloadfont('fonts/tahoma.gdf');
    $font2 = imageloadfont('fonts/tahoma2.gdf');
    $font3 = imageloadfont('fonts/tahoma3.gdf');
    $font4 = imageloadfont('fonts/tahoma4.gdf');

    // Name + Line
    imagestring($im, $font3, 90, 5, $string3, $white);
    imageline($im, 85, 22, 470, 22, $white);
    // Clan
    imagestring($im, $font3, 445, 5, $string8, $white);
    imagestring($im, $font3, 395, 5, $string16, $white);
    // Image
    imagecopyresampled($im, $image, 5, 5, 0, 0, 75, 75, $width, $height); //$im_x, $im_y, $image_x, $image_y, $image_w, $image_h
    
    // Kills
    imagestring($im, $font4, 90, 25, $string4, $white);
    imagestring($im, $font4, 150, 25, $string2, $orange);

    // Deaths
    imagestring($im, $font4, 90, 40, $string6, $white);
    imagestring($im, $font4, 150, 40, $string9, $orange);

    // K/D
    imagestring($im, $font4, 90, 55, $string5, $white);
    imagestring($im, $font4, 150, 55, $string, $orange);
    
    // Wins
    imagestring($im, $font4, 210, 25, $string13, $white);
    imagestring($im, $font4, 270, 25, $string12, $orange);
    
    // Score
    imagestring($im, $font4, 210, 40, $string11, $white);
    imagestring($im, $font4, 270, 40, $string10, $orange);
    // W/L
    imagestring($im, $font4, 210, 55, $string15, $white);
    imagestring($im, $font4, 270, 55, $string14, $orange);
    
    //clanaod.net
    imagestring($im, 1, 365, 85, 'BY SAENAI CLANAOD.NET', $white);


    imagepng($im);
    imagedestroy($im);

 ?>
