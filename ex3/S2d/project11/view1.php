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
$url = $httpMessageHandler['URL'];
$result1 = $databag['level1payload']['result1'];
$writtingTimes1 = $databag['level1payload']['writtingTimes1'];
$result2 = $databag['level1payload']['result2'];
$writtingTimes2 = $databag['level1payload']['writtingTimes2'];
?>
<div>
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
<span>by <?= $url ?></span>

</body>
</html>
<!--
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
