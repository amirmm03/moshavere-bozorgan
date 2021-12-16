<?php

$content=json_decode(file_get_contents("people.json"),true);
if (sizeof($_POST)>0) {

$arrans= file("messages.txt", FILE_IGNORE_NEW_LINES);
$question=$_POST["question"];
$seed=intval(hash("adler32",$question),16)%sizeof($content);
$seed=$seed+intval(hash("adler32",$_POST["person"]),16)%sizeof($content);
$seed=$seed%sizeof($content);
$msg = $arrans[$seed];
$en_name = $_POST["person"];
$fa_name = $content[$en_name];}
else{
    $msg="سوال خود را بپرس!";
    $question='';
    $en_name=array_rand($content,1);
    $fa_name=$content[$en_name];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>

<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <?php
    if(sizeof($_POST)){
    echo ("<div id=\"title\">");
     echo ( " <span id=\"label\">پرسش:</span>");
    echo ("<span id=\"question\"><?php echo $question ?></span>");
    echo ("</div>");

    }
    ?>

    <div id="container">
        <div id="message">
            <p><?php echo $msg ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">

                <?php

                foreach ($content as $key=> $value) {
                    if ($key==$en_name) {
                        echo "<option value=\"".$key."\""."selected".">".$value."</option>";
                    }else{
                    echo "<option value=\"".$key."\">".$value."</option>";}
                }
                /*
                 * Loop over people data and
                 * enter data inside `option` tag.
                 * E.g., <option value="hafez">حافظ</option>
                 */
                ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>