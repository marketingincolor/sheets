<?php
/**
 * Name: Doe
 * Date: 05/15/2017
 * Purpose: Sending data to Google Sheets Service.
 */
include_once __DIR__ . '/vendor/autoload.php';
putenv('GOOGLE_APPLICATION_CREDENTIALS=credentials/service-account.json');
define('SPREADSHEET_ID', 'ENTER SPREADSHEET ID HERE');

$name = $_POST["name"];

function getClient(){
    $client = new Google_Client();
    $client->setApplicationName('MIC Google Sheet Service');
    $client->addScope(Google_Service_Sheets::SPREADSHEETS);
    $client->useApplicationDefaultCredentials();
    if ($credentials_file = checkServiceAccountCredentialsFile()) {
      $client->setAuthConfig($credentials_file);
    } elseif (getenv('GOOGLE_APPLICATION_CREDENTIALS')) {
      $client->useApplicationDefaultCredentials();
    } else {
      echo missingServiceAccountDetailsWarning();
      return;
    }
    return $client;
}

function checkServiceAccountCredentialsFile()
{
  // service account creds
  $application_creds = __DIR__ . '/../../service-account-credentials.json';

  return file_exists($application_creds) ? $application_creds : false;
}

function missingServiceAccountDetailsWarning()
{
  $ret = "
    <h3 class='warn'>
      Warning: You need download your Service Account Credentials JSON from the
      <a href='http://developers.google.com/console'>Google API console</a>.
    </h3>
    <p>
      Once downloaded, move them into the root directory of this repository and
      rename them 'service-account-credentials.json'.
    </p>
    <p>
      In your application, you should set the GOOGLE_APPLICATION_CREDENTIALS environment variable
      as the path to this file, but in the context of this example we will do this for you.
    </p>";

  return $ret;
}

$client = getClient();
$service = new Google_Service_Sheets($client);
$spreadsheetId = 'SPREADSHEET_ID';
$range = 'Sheet1';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$valueInputOption = 'USER_ENTERED';
  $values = array(
      array(
          'time', $name , 'lname', 'email','age', 'postalcode', 'agree', 'membership'
      )
  );
  $body = new Google_Service_Sheets_ValueRange(array(
    'values' => $values
  ));
  $params = array(
    'valueInputOption' => $valueInputOption
  );

  $result = $service->spreadsheets_values->append($spreadsheetId, $range,
      $body, $params);