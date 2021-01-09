<?php
/**
 * @package Smart SMS CLASS
 * @author  Ezechiel Kalengya Ezpk
 * @author  ezechielkalengya@gmail.com
 */
class SmartSMS
{
  /**
   * @method send()
   * @param String message
   * @param Array  recipients [Telephone Numbers]
   */
  public static function send($_message, $_recipients = array()){
    $_authorizationKEY = array('Authorization: AccessKey ZRELDQpa529GjGd8RdfrGFl33');
    $_url              = "https://rest.messagebird.com/messages";

    $_data=http_build_query([
       'recipients'=>$_recipients,
       'originator'=>'Marcos Mus',
       'body'=>$_message
    ]);

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $_url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $_authorizationKEY);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    @curl_setopt($ch, CURLOPT_POSTFIELDS, $_data);
    $result = @curl_exec($ch);
    @curl_close($ch);
  }
}

 ?>
