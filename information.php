<?php

// http://information.php?delete&number=5

$delete = $_GET['delete'];
$update = $_GET['update'];
$create = $_GET['create'];
$number = $_GET['number'];

echo "<br><br><br>";
if (isset($delete)) {
    echo 'delete ';
    echo 'Number multiplied by 2: ' . $number * 2;
}

if (isset($update)) {
    echo 'update ';
    echo 'Number multiplied by 3: ' . $number * 3;
}

if (isset($create)) {
    echo 'create ';
    echo 'Number multiplied by 4: ' . $number * 4;
}
