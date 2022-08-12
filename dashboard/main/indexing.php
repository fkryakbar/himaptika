<?php
require_once 'vendor/autoload.php';
$client = new Google_Client();

// service_account_file.json is the private key that you created for your service account.
$client->setAuthConfig('indexapi-354302-5c0e4f9867a3.json');
$client->addScope('https://www.googleapis.com/auth/indexing');

// Get a Guzzle HTTP Client
$httpClient = $client->authorize();
$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

// Define contents here. The structure of the content is described in the next step.
$content = '{
  "url": "https://himaptika-fkip-ulm.epizy.com/blog/mft-2022",
  "type": "URL_UPDATED"
}';

$response = $httpClient->post($endpoint, ['body' => $content]);
$status_code = $response->getStatusCode();
var_dump($status_code);
