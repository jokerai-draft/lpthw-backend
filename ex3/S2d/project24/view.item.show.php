<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 3</title>
</head>
<body>
    <h4>Hi <?php echo $httpMessageHandler['GET']['name'] ?? "my friend" ?></h4>
    <p><?php echo (new \DateTime())->format('Y-m-d H:i:s'); ?></p>

<h4>details</h4>
<?php
$__isDebug = false;
$__isLoggedIn = $_SESSION['isLoggedIn'] ?? false;

$item = $databag['item'];
echo <<<EOT
<li>
Name: {$item['name']} <br>
Phone: {$item['phone']} <br>
Email: {$item['email']} <br>
</li>
EOT;

?>
<br><br><br>
<a href="./items.php?action=index">back</a>

<?php
#debug
if ($__isDebug) {
    echo "<pre>";
    print_r($httpMessageHandler);
    // print_r($_SESSION);
    echo "</pre>";
}
?>
</body>
</html>
<!--
http://localhost:8000/items.php?action=show&id=2

-->
