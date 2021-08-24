<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 2</title>
    <style>
        .container {
            display: flex;
            flex-direction: row;
            border: 1px dotted gray;
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
$msg = $databag['level1payload']['msg'];
// $isLoggedIn = $databag['level1payload']['isLoggedIn'];
$isLoggedIn = $databag['level1payload']['SessionedComponent']['isLoggedIn']; # ... 神奇的地方开始了
$lastLoginTime = $databag['level1payload']['SessionedComponent']['lastLoginTime'];
$url = $httpMessageHandler['URL'];
?>
<?php
if ($isLoggedIn === true) {
?>
<p>Hottest news (logged in only content)</p>



<?php
// ????????????????
$url = $httpMessageHandler['URL'];
// $result1 = $databag['level1payload']['result1'];
// $writtingTimes1 = $databag['level1payload']['writtingTimes1'];
// $result2 = $databag['level1payload']['result2'];
// $writtingTimes2 = $databag['level1payload']['writtingTimes2'];
$result1 = $databag['level1payload']['Component1'][0]['result'];
$writtingTimes1 = $databag['level1payload']['Component1'][0]['writtingTimes'];
$result2 = $databag['level1payload']['Component1'][1]['result'];
$writtingTimes2 = $databag['level1payload']['Component1'][1]['writtingTimes'];
?>
<div class="container">
    <div>
        <h4>Result 1</h4>
        <p>value for current time interval: <?= $result1 ?></p>
        <p>written <?= $writtingTimes1 ?> times</p>
    </div>
    <div>
        <h4>Result 2</h4>
        <p>value for current time interval: <?= $result2 ?></p>
        <p>written <?= $writtingTimes2 ?> times</p>
    </div>
</div>












<br><br><span>Last Login Time: <?= $lastLoginTime ?></span><?php require 'partial.logout-button.php'; ?>
<?php
} else {
?>
<p>please <a href="./document.login.php">login</a> to view the content</p>
<?php
}
?>
<br><span>by <?= $url ?></span>
</body>
</html>
<!--
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
