<?php
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'passphrase', 'PRasannas@123');
stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
    stream_set_blocking ($fp, 0); 
// This allows fread() to return right away when there are no errors. But it can also miss errors during 
//  last  seconds of sending, as there is a delay before error is returned. Workaround is to pause briefly 
// AFTER sending last notification, and then do one more fread() to see if anything else is there.

if (!$fp) {
//ERROR
 echo "Failed to connect (stream_socket_client): $err $errstrn";

}
fclose($fp);
?>