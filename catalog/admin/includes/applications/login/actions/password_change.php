<?php
/*
  $Id: password_change.php v1.0 2013-01-01 datazen $

  LoadedCommerce, Innovative eCommerce Solutions
  http://www.loadedcommerce.com

  Copyright (c) 2013 Loaded Commerce, LLC

  @author     LoadedCommerce Team
  @copyright  (c) 2013 LoadedCommerce Team
  @license    http://loadedcommerce.com/license.html

  @function The lC_Application_Login_Actions_password_change class
*/
global $lC_Vqmod;
require_once($lC_Vqmod->modCheck('includes/applications/login/classes/login.php')); 

class lC_Application_Login_Actions_password_change extends lC_Application_Login {
    
  /*
  * Protected variables
  */
  protected $_page_contents = 'password_change.php'; 
  
  public function __construct() {
    global $lC_Database, $lC_Language, $lC_MessageStack, $rInfo;
    
    parent::__construct();
    
    if (!isset($_SESSION['verify_key_valid']) || $_SESSION['verify_key_valid'] === false) {
      lc_redirect_admin(lc_href_link_admin(FILENAME_DEFAULT, $this->_module));
    } 
    
    if (isset($_POST['password']) && $_POST['password'] != NULL && isset($_POST['email']) && $_POST['email'] != NULL) {
      $updated = lC_Login_Admin::passwordChange($_POST['password'], $_POST['email']);
      $rInfo = new lC_ObjectInfo($_POST);
    }    
    
  }
  
}
?>
