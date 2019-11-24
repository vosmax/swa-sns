<?php
require 'vendor/autoload.php';
use Aws\Ssm\SsmClient; 
use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;

$credentials =  new \Aws\DoctrineCacheAdapter(new \Doctrine\Common\Cache\ApcuCache);

$SsmClient = new SsmClient([
    'credentials' => $credentials,
    'region' => 'us-east-1',
    'version' => 'latest'
]);

try {
$result = $SsmClient->getParameter([
    'Name' => 'snsarn', // REQUIRED
    'WithDecryption' => true || false,
]);
// var_dump($result);
$arn = $result["Parameter"]["Value"];
//print("arn" . $arn);

} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
    print($e->getMessage());
}
     
    
$SnSclient = new SnsClient([
    'credentials' => $credentials,
    'region' => 'us-east-1',
    'version' => 'latest'
]);
$message = $_POST['message'];
try {
    $result = $SnSclient->publish([
        'Message' => $message,
        'TopicArn' => $arn,
    ]);
     print(  "<br><u>Result</u><br>"
             ."<b>Status code:</b> " . $result['@metadata']['statusCode'] . "<br/>" 
             . "<b>Message id:</b> " . $result['MessageId'] . "<br/>" 
             . "<b>Date:</b> " . $result['@metadata']['headers']['date'] . "<br/>" 
             . "<b>SendTo:</b> " . $arn);
//    var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
    print($e->getMessage());
} 
 
