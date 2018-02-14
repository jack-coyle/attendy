<?php
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
 define('APPLICATION_NAME', '171 Attendance Jack Coyle');
 define('CREDENTIALS_PATH', __DIR__ . '/171.attendance.json');
 define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
 // If modifying these scopes, delete your previously saved credentials
 // at ~/.credentials/sheets.googleapis.com-php-quickstart.json
 define('SCOPES', implode(' ', array(
   "https://www.googleapis.com/auth/spreadsheets")
 ));

function getClient() {
  $client = new Google_Client();
  $client->setApplicationName(APPLICATION_NAME);
  $client->setScopes(SCOPES);
  $client->setAuthConfig(CLIENT_SECRET_PATH);
  $client->setAccessType('offline');

  // Load previously authorized credentials from a file.
  if (file_exists(CREDENTIALS_PATH)) {
    $accessToken = json_decode(file_get_contents(CREDENTIALS_PATH), true);
  } else {
    echo "error";
  }
  $client->setAccessToken($accessToken);

  // Refresh the token if it's expired.
  if ($client->isAccessTokenExpired()) {
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    file_put_contents((CREDENTIALS_PATH), json_encode($client->getAccessToken()));
  }
  return $client;
}

?>
