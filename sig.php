<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Destiny Player Lookup</title>
</head>
<body>
<?php

$memberId = $_GET['memberId'];
$image = $_GET['image'];
$pfp = $_GET['pfp'];
$color = $_GET['color'];


$link = 'http://www.pearson-web.net/saenai/index.php?memberId='.$memberId.'&image='.$image.'&pfp='.$pfp.'&color='.$color.'';

echo 'Your link is: ';
echo '<br>';
echo ('<a href="'.$link.'">'.$link.'</a>');
echo '<br>';
echo '<img src="'.$link.'" alt="icon" />';

?>

<form id="form">
    Bungie ID:<br>
    <input action="sig.php" type="text" name="memberId" value="<?php echo $memberId; ?>" onChange="onSelectChange();"><br>
    <br>
    Background:
    <br>
    <input type="radio" name="image" value="1" <?php if($_GET['image'] == "1") { echo "checked=\"checked\""; } ?> onChange="onSelectChange();">Bungie.net Theme<br>
    <input type="radio" name="image" value="2" <?php if($_GET['image'] == "2") { echo "checked=\"checked\""; } ?> onChange="onSelectChange();">Background 1<br>
    <input type="radio" name="image" value="3" <?php if($_GET['image'] == "3") { echo "checked=\"checked\""; } ?> onChange="onSelectChange();">Background 2<br>
    <input type="radio" name="image" value="4" <?php if($_GET['image'] == "4") { echo "checked=\"checked\""; } ?> onChange="onSelectChange();">Background 3<br>
    <input type="radio" name="image" value="5" <?php if($_GET['image'] == "5") { echo "checked=\"checked\""; } ?> onChange="onSelectChange();">Background 4<br>
    <input type="radio" name="image" value="6" <?php if($_GET['image'] == "6") { echo "checked=\"checked\""; } ?> onChange="onSelectChange();">Background 5<br>
    <input type="radio" name="image" value="7" <?php if($_GET['image'] == "7") { echo "checked=\"checked\""; } ?> onChange="onSelectChange();">Background 6<br>
    <br>
    Profile Pic:
    <br>
    <input type="radio" name="pfp" value="1" checked>Bungie.net Profile Picture<br>
    <br>
    Text Colour:
    <br>
    <input type="radio" name="color" value="white" <?php if($_GET['color'] == "white") { echo "checked=\"checked\""; } ?> onChange="onSelectChange();">White<br>
    <input type="radio" name="color" value="black" <?php if($_GET['color'] == "black") { echo "checked=\"checked\""; } ?> onChange="onSelectChange();">Black<br>
    <br>
    <input type="submit">

    <script>
    function onSelectChange(){
    document.getElementById('form').submit();
    }
    </script>
</form>
<br>


<br>

</body>
</html>