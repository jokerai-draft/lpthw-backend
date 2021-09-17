<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>

<?php
$contact = $databag['level1payload']['contact'];

?>
<div>
    <h4>Contact</h4>

    <p>#<?= $contact['id'] ?></p>
    <p>Name: <?= $contact['name'] ?></p>
    <p>Phone: <?= $contact['phone'] ?></p>
    <p>Email: <?= $contact['email'] ?></p>
</div>

<div>
    <a href="./index.php?theme=contacts&action=edit&id=<?= $contact['id'] ?>&controller=ContactController">edit</a><br />
    <br />
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
