<?php
require('vendor/pusher/pusher-php-server/lib/Pusher.php');

// Change the following with your app details:
// Create your own pusher account @ www.pusher.com
$app_id = '339249'; // App ID
$app_key = '5493b090ebd743799717'; // App Key
$app_secret = 'c9250fa18e6453b80b30'; // App Secret
$pusher = new Pusher($app_key,  $app_secret, $app_id, array(
    'cluster' => 'mt1'));

// Check the receive message
if(isset($_POST['message']) && !empty($_POST['message'])) {
    $data['message'] = $_POST['message'];

    // Return the received message
    if($pusher->trigger('test_channel', 'my_event', $data)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>