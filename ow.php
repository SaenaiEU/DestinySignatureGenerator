<?php
// Get Name
 $memberName = $_GET['memberName'];
 $imageC = $_GET['image'];

// HttpRequest for Stats
 $ch2 = curl_init();
 curl_setopt($ch2, CURLOPT_URL, 'https://ovrstat.com/stats/pc/us/'.$memberName.'');
 curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

 $json = json_decode(curl_exec($ch2),true, 512, JSON_BIGINT_AS_STRING);

// Gather Specific Stats
 $icon = $json['icon'];
 $name = $json['name'];
 $level = $json['level'];

 $won = $json['gamesWon'];

 $kills = $json['quickPlayStats']['careerStats']['allHeroes']['combat']['eliminations'];
 $deaths = $json['quickPlayStats']['careerStats']['allHeroes']['combat']['deaths'];

 $timePlayed = $json['quickPlayStats']['careerStats']['allHeroes']['game']['timePlayed'];

 $kd = $kills / $deaths;

// Round K/D
 $kd1 = number_format($kd, 2, '.', '');

 //echo $kills;
 //echo '<br>';
 //echo $deaths;
 //echo '<br>';
 //echo $kd1;


// Error Checking
 //var_dump($json);




// Make Image

 header("Content-type: image/png");
    $string = $kd1;
    $string5 = 'K/D: ';

    $string2 = $kills;
    $string4 = 'Kills: ';

    $string3 = $memberName;
    
    $string8 = $level;

    $string9 = $deaths;
    $string6 = 'Deaths: ';

    $string12 = $won;
    $string13 = 'Wins: ';

    $string20 = $timePlayed;
    $string21 = 'Played: ';

    //$pic2 = $icon;
    $pic2 = "images/blizzardlogo.png";

    $icon2 = $json['levelIcon'];

	if(isset($_GET['image'])){
        if ($imageC == '1'){
            $img1 = 'images/buttons7.png';
        } else if ($imageC == 'doomfist'){
            $img1 = "owimages/doomfist.png";
        } else if ($imageC == 'genji'){
            $img1 = "owimages/genji.png";
        } else if ($imageC == 'mccree'){
            $img1 = "owimages/mccree.png";
        } else if ($imageC == 'pharah'){
            $img1 = "owimages/pharah.png";
        } else if ($imageC == 'reaper'){
            $img1 = "owimages/reaper.png";
        } else if ($imageC == 'soldier76'){
            $img1 = "owimages/soldier76.png";
        } else if ($imageC == 'soldier76'){
            $img1 = "owimages/soldier76.png";
        } else if ($imageC == 'sombra'){
            $img1 = "owimages/sombra.png";
        } else if ($imageC == 'tracer'){
            $img1 = "owimages/tracer.png";
        } else if ($imageC == 'bastion'){
            $img1 = "owimages/bastion.png";
        } else if ($imageC == 'hanzo'){
            $img1 = "owimages/hanzo.png";
        } else if ($imageC == 'junkrat'){
            $img1 = "owimages/junkrat.png";
        } else if ($imageC == 'mei'){
            $img1 = "owimages/mei.png";
        } else if ($imageC == 'torbjorn'){
            $img1 = "owimages/torbjorn.png";
        } else if ($imageC == 'widowmaker'){
            $img1 = "owimages/widowmaker.png";
        } else if ($imageC == 'dva'){
            $img1 = "owimages/dva.png";
        } else if ($imageC == 'orisa'){
            $img1 = "owimages/orisa.png";
        } else if ($imageC == 'reinhardt'){
            $img1 = "owimages/reinhardt.png";
        } else if ($imageC == 'roadhog'){
            $img1 = "owimages/roadhog.png";
        } else if ($imageC == 'winston'){
            $img1 = "owimages/winston.png";
        } else if ($imageC == 'zarya'){
            $img1 = "owimages/zarya.png";
        } else if ($imageC == 'ana'){
            $img1 = "owimages/ana.png";
        } else if ($imageC == 'lucio'){
            $img1 = "owimages/lucio.png";
        } else if ($imageC == 'mercy'){
            $img1 = "owimages/mercy.png";
        } else if ($imageC == 'moira'){
            $img1 = "owimages/moira.png";
        } else if ($imageC == 'symmetra'){
            $img1 = "owimages/moira.png";
        } else if ($imageC == 'zenyatta'){
            $img1 = "owimages/moira.png";
        } else if ($imageC == 'custom'){
            $img1 = "owimages/custom.png";
        } else {
            $img1 = '$images/buttons7.png'; 
        }
    }

    $im = imagecreatefromstring(file_get_contents($img1));
    
    $white = imagecolorallocate($im, 255, 255, 255);
    $black = imagecolorallocate($im, 0, 0, 0);
    $orange = imagecolorallocate($im, 220, 210, 60);
    $orange2 = imagecolorallocate($im, 230, 189, 53);
    
    $px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
    $px2     = (imagesx($im) - 7.5 * strlen($string)) / 20;

    $image = imagecreatefromstring(file_get_contents($pic2));
    list($width, $height) = getimagesize($pic2);

    $icon = imagecreatefromstring(file_get_contents($icon2));
    list($width2, $height2) = getimagesize($icon2);



    $font = imageloadfont('fonts/tahoma.gdf');
    $font2 = imageloadfont('fonts/tahoma2.gdf');
    $font3 = imageloadfont('fonts/tahoma3.gdf');
    $font4 = imageloadfont('fonts/tahoma4.gdf');

    putenv('GDFONTPATH=' . realpath('.'));
    $font5="./overwatch.ttf"; 
    $font6="./futura.ttf"; 

    //imagettftext($im, 5, 0, 90, 10, $white, $font4, $string3);
    imagettftext($im, 20, 0, 80, 25, $orange2, $font5, $string3);

    //Kills
    imagettftext($im, 11, 0, 90, 42, $white, $font6, $string4);
    imagettftext($im, 11, 0, 150, 42, $orange, $font6, $string2);

    // Deaths
    imagettftext($im, 11, 0, 90, 57, $white, $font6, $string6);
    imagettftext($im, 11, 0, 150, 57, $orange, $font6, $string9);

    // K/D
    imagettftext($im, 11, 0, 90, 72, $white, $font6, $string5);
    imagettftext($im, 11, 0, 150, 72, $orange, $font6, $string);

    // Wins
    imagettftext($im, 11, 0, 210, 42, $white, $font6, $string13);
    imagettftext($im, 11, 0, 270, 42, $orange, $font6, $string12);

    // Played
    imagettftext($im, 11, 0, 210, 57, $white, $font6, $string21);
    imagettftext($im, 11, 0, 270, 57, $orange, $font6, $string20);

    // Name + Line
    //imagestring($im, $font3, 90, 10, $string3, $white);
    //imageline($im, 85, 27, 470, 27, $white);

    // Level
    imagestring($im, $font3, 37, 32, $string8, $white);
    
    // Image
    //imagecopyresized($im, $image, 5, 5, 0, 0, 75, 75, $width, $height); //$im_x, $im_y, $image_x, $image_y, $image_w, $image_h

    // Level icon
    imagecopyresampled($im, $icon, 0, -5, 0, 0, 90, 90, $width2, $height2);

    // Rank icon
    if ($json['prestigeIcon'] == ''){  

    } else {
        $icon3 = $json['prestigeIcon'];
        $icon4 = imagecreatefromstring(file_get_contents($icon3));
        list($width3, $height3) = getimagesize($icon3);
        imagecopyresampled($im, $icon4, 0, 35, 0, 0, 90, 45, $width3, $height3);
    }


    // W/L
    //imagestring($im, $font4, 210, 55, $string15, $white);
    //imagestring($im, $font4, 270, 55, $string14, $orange);


    //clanaod.net
    imagestring($im, 1, 365, 85, 'BY SAENAI CLANAOD.NET', $white);


    imagepng($im);
    imagedestroy($im);

 ?>