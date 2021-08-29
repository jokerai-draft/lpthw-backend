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
        .link {
            background: none!important;
            border: none;
            padding: 0!important;
            /*optional*/
            font-family: arial, sans-serif;
            /*input has OS specific font-family*/
            color: #069;
            text-decoration: underline;
            cursor: pointer;
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
    $detailsUrl = './document1.php?theme=contacts&action=show&id=' . $contact['id'];
    echo <<<EOT
<li>
Name: {$contact['name']} <br>
Phone: {$contact['phone']} <br>
Email: {$contact['email']} <br>

<div style="display: flex;" id="detailsAndDeleteLinks">
<span><a href="$detailsUrl">details</a></span>
EOT;
?>

&nbsp;&nbsp;

<form action="<?= $url ?>" method="POST">
    <input type="hidden" name="theme" value="contacts" />
    <input type="hidden" name="action" value="destroy" />

    <input type="hidden" name="id" value="<?= $contact['id'] ?>" />
    <input type="hidden" name="submitted" value="1" />
    <button type="submit" onclick="return confirm('confirm delete?');" class="link">X</button>
</form>

&nbsp;&nbsp;

</div>
<?php
echo "</li>";
}
unset($contact);
?>
</ul>
<p><a href="./document1.php?theme=contacts&action=create">add new contact</a></p>
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
