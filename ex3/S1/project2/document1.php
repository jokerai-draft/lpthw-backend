<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 1</title>
</head>
<body>
<?php
require_once "Data.php";
require_once "Utils.php";

// handle1
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // echo "<pre>"; print_r($_POST); echo "</pre>";
    file_put_contents("storage", serialize(Utils::escape($_POST['locker'])));
}
$locker = unserialize(file_get_contents("storage")); // content, text, data, "locker" ; state, handler
?>
<!-- -------------------------------------- -->

    <h4>Hi <?php echo $_GET['name'] ?? "my friend" ?></h4>
    <p><?php echo (new \DateTime())->format('Y-m-d H:i:s'); ?></p>
<?php
echo Data::$age . "<br><br>";
$str = "This is some <b>bold</b> text. ";
echo $str . "<br>";
echo Utils::escape($str) . "<br><br>";
echo "keyword: " . Utils::escape($_GET['keyword']) . "<br>";
$keyword = Utils::escape($_GET['keyword']);
echo <<<EOT
<button>Search</button>
EOT;
?>
<br />
:)
<br />

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label for="locker">Locker</label><br>
    <textarea id="locker" name="locker" rows="4" cols="30"><?php echo $locker ?? ""; ?></textarea><br>
    <input type="hidden" name="submitted" value="1" />
    <input type="submit" value="submit" />
    <input type="button" value="clean" onclick="document.getElementById('locker').value='';" />
</form>

<?php
echo "<pre>";
print_r($_SERVER);
echo "</pre>";
echo "<pre>";
$_POST_escaped = array_map(fn($item) => Utils::escape($item), $_POST);
print_r($_POST_escaped);
echo "</pre>";
?>

</body>
</html>

<!--
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
