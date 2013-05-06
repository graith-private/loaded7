<?php
/*
  $Id: save.php v1.0 2013-01-01 datazen $

  LoadedCommerce, Innovative eCommerce Solutions
  http://www.loadedcommerce.com

  Copyright (c) 2013 Loaded Commerce, LLC

  @author     LoadedCommerce Team
  @copyright  (c) 2013 LoadedCommerce Team
  @license    http://loadedcommerce.com/license.html
*/

  class lC_Application_Categories_Actions_save extends lC_Application_Categories {
    public function __construct() {
      global $lC_Language, $lC_MessageStack;
      
      parent::__construct();
      
      $this->_page_contents = 'edit.php'; 

      if ( isset($_POST['subaction']) && ($_POST['subaction'] == 'confirm') ) {
        die('test confirm');
      }
    }
  }
?>