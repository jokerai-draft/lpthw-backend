<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <style>
        /* ex5/g1/detection1/view.contact.index.php */
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

<?php
$contacts = $databag['level1payload']['contacts'];
$url = $httpMessageHandler['URL'];
?>
<h4>Contacts</h4>
<ul>
<?php
foreach ($contacts as $contact) {
    $detailsUrl = './index.php?theme=contacts&action=show&id=' . $contact['id'] . '&controller=ContactController';
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
    <input type="hidden" name="controller" value="ContactController" />

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

<br />
<a href="./index.php?theme=contacts&action=create&controller=ContactController">add new contact</a><br />
<br />
<a href="./index.php?theme=contacts&action=index&controller=ContactController">contacts</a><br />
<a href="./index.php">index</a><br />

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

<!--
http://localhost:8000/index.php?theme=contacts&action=index&controller=ContactController
http://localhost:8000/index.php?theme=contacts&action=show&id=1&controller=ContactController
http://localhost:8000/index.php?theme=contacts&action=edit&id=1&controller=ContactController
http://localhost:8000/index.php?theme=contacts&action=create&controller=ContactController
-->
