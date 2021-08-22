<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 1</title>
</head>
<body>
    <h4>Hi <?php echo $httpMessageHandler['GET']['name'] ?? "my friend" ?></h4>
    <p><?php echo (new \DateTime())->format('Y-m-d H:i:s'); ?></p>
<?php
echo $databag['age'] . "<br>";
echo $age ?? "" . "<br>";
$str = "This is some <b>bold</b> text. ";
echo $str;
echo htmlspecialchars($str);


echo "<br>" . "keyword:" . "<br>";
echo $httpMessageHandler['GET']['keyword'] ?? "";

?>
:)




<?php
$url = $httpMessageHandler['URL'];
$counter = $databag['level1payload']['counter'];
$step = $databag['level1payload']['step'];
?>
<br>
<form action="<?php echo $url; ?>" method="POST">
    <input type="submit" name="submit" value="+" />
    <span><?php echo $counter; ?></span>
    <input type="submit" name="submit" value="-" /><br>
    <label for="step">step </label>
    <input type="text" id="step" name="step" value="<?php echo $step; ?>" /><br>
    <input type="hidden" name="submitted" value="1" />
    <input type="button" value="clean" onclick="document.getElementById('step').value='';" />
</form>
</body>
</html>
<!--
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
