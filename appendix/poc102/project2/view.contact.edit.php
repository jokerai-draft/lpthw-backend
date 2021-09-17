<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
</head>
<body>

<?php
$contact = $databag['level1payload']['contact'];
$url = $httpMessageHandler['URL'];
?>
<div>
    <h4>Edit Contact</h4>

    <p>Contact #<?= $contact['id'] ?></p>

<form action="<?= $url ?>" method="POST">
    <input type="hidden" name="theme" value="contacts" />
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="controller" value="ContactController" />

    <label for="name">Name:</label><input type="text" name="name" value="<?= $contact['name'] ?>" />
    <label for="phone">Phone:</label><input type="text" name="phone" value="<?= $contact['phone'] ?>" />
    <label for="email">Email:</label><input type="text" name="email" value="<?= $contact['email'] ?>" />
    <input type="hidden" name="id" value="<?= $contact['id'] ?>" />
    <input type="hidden" name="submitted" value="1" />
    <input type="submit" value="Submit">
</form>
</div>

<div>
    <a href="./index.php?theme=contacts&action=show&id=<?= $contact['id'] ?>&controller=ContactController">back</a><br /><br />
    <a href="./index.php?theme=contacts&action=index&controller=ContactController">contacts</a><br />
    <a href="./index.php">index</a><br />
</div>

<?php
$__isDebug = true;
// $__isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$__isLoggedIn = $httpMessageHandler['SESSION']['isLoggedIn'] ?? false;
#debug
if ($__isDebug) {
    echo "<pre>";
    print_r($httpMessageHandler);
    print_r($databag);
    // print_r($_SESSION);
    echo "</pre>";
}
?>

</body>
</html>
