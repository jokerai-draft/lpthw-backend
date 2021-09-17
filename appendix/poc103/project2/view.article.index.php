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
$articles = $databag['level1payload']['articles'];
$url = $httpMessageHandler['URL'];
?>
<h4>Articles</h4>
<ul>
<?php
foreach ($articles as $article) {
    $detailsUrl = './index.php?theme=articles&action=show&id=' . $article['id'] . '&controller=ArticleController';
    echo <<<EOT
<li>
<p>Title: {$article['title']}</p>
<div>{$article['body']}</div>

<br />
<div style="display: flex;" id="detailsAndDeleteLinks">
<span><a href="$detailsUrl">details</a></span>
EOT;
?>

<?php
if (isset($article['can']) && $article['can'] === true) {
?>
&nbsp;&nbsp;

<form action="<?= $url ?>" method="POST">
    <input type="hidden" name="theme" value="articles" />
    <input type="hidden" name="action" value="destroy" />
    <input type="hidden" name="controller" value="ArticleController" />

    <input type="hidden" name="id" value="<?= $article['id'] ?>" />
    <input type="hidden" name="submitted" value="1" />
    <button type="submit" onclick="return confirm('confirm delete?');" class="link">X</button>
</form>

&nbsp;&nbsp;

<?php
}
?>

</div>
<?php
echo "</li>";
}
unset($article);
?>
</ul>

<br />
<a href="./index.php?theme=articles&action=create&controller=ArticleController">add new article</a><br />
<br />
<a href="./index.php?theme=articles&action=index&controller=ArticleController">articles</a><br />
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
http://localhost:8000/index.php?theme=articles&action=index&controller=ArticleController
http://localhost:8000/index.php?theme=articles&action=show&id=1&controller=ArticleController
http://localhost:8000/index.php?theme=articles&action=edit&id=1&controller=ArticleController
http://localhost:8000/index.php?theme=articles&action=create&controller=ArticleController
-->
