<?php
$name = $_POST['name'];
$sid = $_POST['sid'];
$secret_word = $_POST['word'];
$left = $_POST['sid-left'];
$right = $_POST['sid-right'];
$real_word = file_get_contents("./secretword.txt");
if ($secret_word != $real_word) {
    echo "<h3>You got the secret word wrong!</h3><p>Try again, or go to class!</p>";
    return;
}
$record = array(
"name" => $name,
"sid" => $sid,
"left" => $left,
"right" => $right
);
$today = date("Y-m-d");
$attendance = json_decode(file_get_contents("./attendance.json"), true);
$today_attendance = $attendance[$today] ?: array();
$today_attendance[$sid] = $record;
$attendance[$today] = $today_attendance;
file_put_contents("./attendance.json", json_encode($attendance));
echo "<h3>Thanks!</h3><p>Your attendance has been recorded.</p>";
?>
