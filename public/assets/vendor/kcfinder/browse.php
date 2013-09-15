<?php

/** This file is part of KCFinder project
  *
  *      @desc Browser calling script
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
ini_set('display_errors', '0');     # don't show any errors...
ini_set('error_reporting', 0);
session_start();

if(isset($_SESSION['filemanager'])){
  if($_SESSION['filemanager']=='yes'){
  */
    require "core/autoload.php";
    $browser = new browser();
    $browser->action();
//   }
// }

?>