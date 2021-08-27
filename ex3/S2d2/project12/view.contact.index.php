<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
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
$contacts = $databag['level1payload']['ContactModel'];//['contacts'];

?>
<h4>Contacts</h4>
<ul>
<?php
foreach ($contacts as $contact) {
    $detailUrl = './document1.php?theme=contacts&action=show&id=' . $contact['id'];
    echo <<<EOT
<li>
Name: {$contact['name']} <br>
Phone: {$contact['phone']} <br>
Email: {$contact['email']} <br>
<a href="$detailUrl">detail</a>
</li>
EOT;
}
unset($contact);
?>
</ul>

<span>by <?= $url ?></span>

</body>
</html>
<!--
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
