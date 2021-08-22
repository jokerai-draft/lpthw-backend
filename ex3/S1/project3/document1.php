<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 1</title>
</head>
<body>
<?php
require_once "Utils.php";

// handle1
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // echo "<pre>"; print_r($_POST); echo "</pre>";

    // work
    // $lockers = [Utils::escape($_POST['locker1']), Utils::escape($_POST['locker2']), Utils::escape($_POST['locker3']), ];
    // file_put_contents("storage", serialize($lockers));

    // also work
    $lockers = [$_POST['locker1'], $_POST['locker2'], $_POST['locker3'], ];
    $lockers = array_map(fn($item) => Utils::escape($item), $lockers);
    file_put_contents("storage", serialize($lockers));
}
$lockers = unserialize(file_get_contents("storage")); // content, text, data, "locker" ; state, handler
$locker1 = $lockers[0] ?? "";
$locker2 = $lockers[1] ?? "";
$locker3 = $lockers[2] ?? "";
?>
<!-- -------------------------------------- -->

<h4>Document 1</h4>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

    <label for="locker">Locker 1</label><br>
    <textarea name="locker1" rows="4" cols="30"><?php echo $locker1; ?></textarea><br>

    <label for="locker">Locker 2</label><br>
    <textarea name="locker2" rows="4" cols="30"><?php echo $locker2; ?></textarea><br>

    <label for="locker">Locker 3</label><br>
    <textarea name="locker3" rows="4" cols="30"><?php echo $locker3; ?></textarea><br>

    <input type="hidden" name="submitted" value="1" />
    <input type="submit" value="submit" />
    <!-- <input type="button" value="clean" onclick="document.getElementById('locker').value='';" /> -->
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
