<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new contact</title>
    <style>
        .container {
            display: flex;
            flex-direction: row;
        }
        .container > div {
            margin: 30px 30px;
        }
    </style>
</head>
<body>
    <h4>Hi <?php echo $httpMessageHandler['GET']['name'] ?? "my friend" ?></h4>
    <p><?php echo (new \DateTime())->format('Y-m-d H:i:s'); ?></p>

<?php
$url = $httpMessageHandler['URL'];

$result2 = $databag['level1payload']['counter']['result'];
$writtingTimes2 = $databag['level1payload']['counter']['writtingTimes'];
?>
<div class="container">
    <div>
        <h4>Result 2</h4>
        <p>value for current time interval: <?= $result2 ?></p>
        <p>written <?= $writtingTimes2 ?> times</p>
    </div>
</div>

<?php

?>
<h4>Add new contact</h4>

<form action="<?= $url ?>" method="POST">
    <input type="hidden" name="theme" value="contacts" />
    <input type="hidden" name="action" value="store" />

    <label for="">name</label><br />
    <input type="text" name="name" id="name" value="" /><br />
    <label for="">phone</label><br />
    <input type="text" name="phone" id="phone" value="" /><br />
    <label for="">email</label><br />
    <input type="text" name="email" id="email" value="" /><br />
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

<a href="./document1.php?theme=contacts&action=index">back</a><br><br>
<span>by <?= $url ?></span>

<?php
$__isDebug = false;
$__isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
?>
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
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
