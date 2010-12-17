<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

//Define constants for all pages
define( 'COM_HOLYQURAN_VERSION_LINK', '<a href="http://www.khawaib.co.uk/index.php?option=com_content&amp;Itemid=29&amp;catid=12&amp;id=40&amp;lang=en&amp;view=article" target="_blank"></a>' );

// Initialize the controller
$controller = new HolyquranController();
$controller->execute( null );

// Redirect if set by the controller
$controller->redirect();
?>
