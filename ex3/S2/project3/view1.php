<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 1</title>
</head>
<body>
<h4>Document 1</h4>
<form action="<?php echo $httpMessageHandler['URL'] ?>" method="POST">

    <label for="locker">Locker 1</label><br>
    <textarea name="locker1" rows="4" cols="30"><?php echo $databag['locker1']; ?></textarea><br>

    <label for="locker">Locker 2</label><br>
    <textarea name="locker2" rows="4" cols="30"><?php echo $databag['locker2']; ?></textarea><br>

    <label for="locker">Locker 3</label><br>
    <textarea name="locker3" rows="4" cols="30"><?php echo $databag['locker3']; ?></textarea><br>

    <input type="hidden" name="submitted" value="1" />
    <input type="submit" value="submit" />
    <!-- <input type="button" value="clean" onclick="document.getElementById('locker').value='';" /> -->
</form>

<?php
echo "<pre>";
print_r($httpMessageHandler['SERVER']);
echo "</pre>";
echo "<pre>";
print_r($httpMessageHandler['POST']);
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
