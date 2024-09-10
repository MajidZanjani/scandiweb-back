<?php
phpinfo();

try {
    $pdo = new PDO('mysql:host=localhost;dbname=testdb', 'root', '');
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
