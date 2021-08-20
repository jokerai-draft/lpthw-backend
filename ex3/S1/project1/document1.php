<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 1</title>
</head>
<body>
    <h4>Hi <?php echo $_GET['name'] ?? "my friend" ?></h4>
    <p><?php echo (new \DateTime())->format('Y-m-d H:i:s'); ?></p>
<?php
require_once "Utils.php";
echo $age . "<br>";
echo $age . "<br>";
$str = "This is some <b>bold</b> text. ";
echo $str;
echo htmlspecialchars($str);
echo "<br><br>";
// echo $_GET['keyword']; // XSS
// echo htmlspecialchars($_GET['keyword']); // no XSS vulnerability
echo Utils::escape($_GET['keyword']);
echo Utils::escape($str);
?>
<br />
:)
</body>
</html>

<!--
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->


<!-- 参考
https://stackoverflow.com/questions/6080022/php-self-and-xss -->
