<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact details</title>
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
$contact = $databag['level1payload']['ContactModel'];//['contact'];

?>
<h4>Contact details</h4>

<li>
Name: <?= $contact['name'] ?> <br>
Phone: <?= $contact['phone'] ?> <br>
Email: <?= $contact['email'] ?> <br>
</li>

<a href="./document1.php?theme=contacts&action=index">back</a> <a href="./document1.php?theme=contacts&action=edit&id=<?= $contact['id'] ?>">edit</a><br><br>
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
