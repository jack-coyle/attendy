<?php
require_once __DIR__ . '/helper.php';

$client = getClient();

$service = new Google_Service_Sheets($client);

// The ID of the spreadsheet to update.
$spreadsheetId = '1b_0C0nt6orsgP2Q_Y09im4oYfWI5o8QSO8lVfZVDSX4';

//the range of dates
$date_range = 'A1:A15';

//data from user
$name = $_POST['name'];
$sid = $_POST['sid'];
$secret_word = $_POST['word'];
$left = $_POST['sid-left'];
$right = $_POST['sid-right'];

//formatted date
$today = date("Y-m-d");

//check the secret word
$real_word = file_get_contents("./secretword.txt");
if ($secret_word != $real_word) {
    echo "<h3>You got the secret word wrong!</h3><p>Try again, or go to class!</p>";
    return;
}

$response = $service->spreadsheets_values->get($spreadsheetId, $date_range);
$dates = $response["values"];
echo $dates;

?>
