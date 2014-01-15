<?php

require('../../includes/application_top.php');
require_once($lC_Vqmod->modCheck(DIR_FS_CATALOG . 'includes/classes/order.php'));

function meta_redirect($url){

  echo '<meta http-equiv="refresh" content="0;url='.$url.'">';
}

if (isset($_POST['M_hash']) && !empty($_POST['M_hash']) && ($_POST['M_hash'] == md5($_POST['M_sid'] . $_POST['M_cid'] . $_POST['cartId'] . $_POST['M_lang'] . number_format($_POST['amount'], 2) . ADDONS_PAYMENT_WORLDPAY_HOSTED_PAYMENT_MD5_PASSWORD))) {
  $pass = true;
}

if (isset($_POST['callbackPW']) && ($_POST['callbackPW'] != ADDONS_PAYMENT_WORLDPAY_HOSTED_PAYMENT_CALLBACK_PASSWORD)) {
  $pass = false;
}

if (defined('ADDONS_PAYMENT_WORLDPAY_HOSTED_PAYMENT_CALLBACK_PASSWORD') && !isset($_POST['callbackPW'])) {
  $pass = false;
}

if($pass){

  $status = $_POST['transStatus'];
  $order_id = $_POST['cartId'];
  
    if($status == 'Y'){ // Transaction successfull

      lC_Order::process($order_id, ADDONS_PAYMENT_WORLDPAY_HOSTED_PAYMENT_ORDER_STATUS_COMPLETE_ID);
      $redirect_url = lc_href_link(FILENAME_CHECKOUT, 'success', 'SSL', true, true, true);
    }elseif($status == 'C'){ // Order canceled
      
      $redirect_url = lc_href_link(FILENAME_CHECKOUT, 'cart', 'SSL', true, true, true);
    }else{ // Something else went wrong, send back to payment page

      $error_message = '&payment_error=' . $lC_Language->get('text_label_error') . ' ' . $_POST['rawAuthMessage'];
      $redirect_url = lc_href_link(FILENAME_CHECKOUT, 'payment'.$error_message, 'SSL', true, true, true);
    }
}else{

  $redirect_url = lc_href_link(FILENAME_CHECKOUT, 'cart', '', true, true, true); // Default redirect
}

meta_redirect($redirect_url);

?>