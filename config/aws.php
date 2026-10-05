<?php

require __DIR__ . '/../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Rekognition\RekognitionClient;
use Aws\Sns\SnsClient;

$secrets = require __DIR__ . '/secrets.php';

$region = $secrets['aws_region'];
$bucketName = $secrets['bucket_name'];

$clientConfig = [
    'version' => 'latest',
    'region' => $region
];

// If no access keys are given, the SDK automatically uses the EC2 IAM Role.
if (!empty($secrets['aws_key']) && !empty($secrets['aws_secret'])) {
    $clientConfig['credentials'] = [
        'key' => $secrets['aws_key'],
        'secret' => $secrets['aws_secret']
    ];
}

$s3 = new S3Client($clientConfig);

$rekognition = new RekognitionClient($clientConfig);

$sns = new SnsClient($clientConfig);
?>
