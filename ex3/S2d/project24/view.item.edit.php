<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
</head>
<body>
    <h4>Hi <?php echo $httpMessageHandler['GET']['name'] ?? "my friend" ?></h4>
    <p><?php echo (new \DateTime())->format('Y-m-d H:i:s'); ?></p>

<?php
$__isDebug = false;
$__isLoggedIn = $_SESSION['isLoggedIn'] ?? false;

$url = $httpMessageHandler['URL'];
$item = $databag['state']['item'];
$id = $item['id'];
$name = $item['name'];
$phone = $item['phone'];
$email = $item['email'];

?>
<form action="<?= $url ?>" method="POST">
    <h4>Edit contact</h4>
    <label for="">name</label><br />
    <input type="text" name="name" id="name" value="<?= $name ?>" /><br />
    <label for="">phone</label><br />
    <input type="text" name="phone" id="phone" value="<?= $phone ?>" /><br />
    <label for="">email</label><br />
    <input type="text" name="email" id="email" value="<?= $email ?>" /><br />
    <input type="hidden" name="event" value="update" />
    <input type="hidden" name="id" value="<?= $id ?>" />
    <input type="hidden" name="submitted" value="1" />
    <input type="submit" value="submit" />
    <input type="button" value="clean" onclick="
    (function() {
        document.getElementById('name').value='';
        document.getElementById('phone').value='';
        document.getElementById('email').value='';
    })();
    " />
</form>

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
http://localhost:8000/items.php?action=edit&id=2

-->
