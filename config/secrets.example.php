<?php
/*
 * Copy this file to  config/secrets.php  and fill in your own values.
 * config/secrets.php is listed in .gitignore and must NEVER be uploaded to GitHub.
 */
return [
    // ---- Amazon RDS (MySQL) ----
    'db_host'     => 'your-db-endpoint.xxxxxxxx.us-east-1.rds.amazonaws.com',
    'db_user'     => 'your_db_user',
    'db_password' => 'your_db_password',
    'db_name'     => 'lostfound',

    // ---- AWS ----
    'aws_region'  => 'us-east-1',
    'bucket_name' => 'your-s3-bucket-name',
    'sns_topic_arn' => 'arn:aws:sns:us-east-1:123456789012:your-topic-name',

    // Leave both empty when running on EC2 with an IAM Role attached (recommended).
    // Only fill these in if you run the project outside AWS.
    'aws_key'     => '',
    'aws_secret'  => '',

    // ---- Admin login ----
    'admin_username' => 'admin',
    'admin_password' => 'change_this_password',
];
