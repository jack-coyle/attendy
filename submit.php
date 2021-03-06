<?php
require_once __DIR__ . '/helper.php';

$client = getClient();

$service = new Google_Service_Sheets($client);

// The ID of the spreadsheet to update.
$spreadsheetId = '1b_0C0nt6orsgP2Q_Y09im4oYfWI5o8QSO8lVfZVDSX4';

//the range of dates
$date_range = '1:1';

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
$dates = $response["values"][0];
if (array_values(array_slice($dates, -1))[0] != $today) {
    $dates[] = $today;
}
$char = chr(64+count($dates));
$new_range = $char .":". $char;
// TODO: Assign values to desired properties of `requestBody`:
$dateRequestBody = new Google_Service_Sheets_ValueRange();
$dateRequestBody->setMajorDimension(1);
$dateRequestBody->setRange($date_range);
$dateRequestBody->setValues(array($dates));

$response = $service->spreadsheets_values->update($spreadsheetId, $date_range, $dateRequestBody, array("valueInputOption"=>"RAW"));

$name_response = $service->spreadsheets_values->get($spreadsheetId, $new_range);
$names = $name_response['values'];
$names[] = array($name);

$studentRequestBody = new Google_Service_Sheets_ValueRange();
$studentRequestBody->setMajorDimension(1);
$studentRequestBody->setRange($new_range);
$studentRequestBody->setValues($names);

$response = $service->spreadsheets_values->update($spreadsheetId, $new_range, $studentRequestBody, array("valueInputOption"=>"RAW"));
//echo $new_range;
echo "<h3>Your attendance has been recorded. Now pay attention to Stephen!</p>";
?>
