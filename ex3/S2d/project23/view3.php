<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document 3</title>
    <style>
        li {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h4>Hi <?php echo $httpMessageHandler['GET']['name'] ?? "my friend" ?></h4>
    <p><?php echo (new \DateTime())->format('Y-m-d H:i:s'); ?></p>

<?php
// dummy data
$addressBook = [
    ['name' => 'Alice', 'phone' => '111-222-3333', 'email' => 'alice@gmail.com', ],
    ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', ],
    ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', ],
];
$addressBook = $databag['level1payload']['Component2'];
?>

<h4>address book</h4>
<ul>
<?php
foreach ($addressBook as $item) {
    echo "<li>";
    echo "Name: " . $item['name'] . "<br>";
    echo "Phone: " . $item['phone'] . "<br>";
    echo "Email: " . $item['email'] . "<br>";
    echo "</li>";
}
?>
</ul>
</body>
</html>
<!--
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
-->
