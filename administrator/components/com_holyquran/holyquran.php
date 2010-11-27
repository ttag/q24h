<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
$document = & JFactory::getDocument();

//Define constants for all pages
define( 'COM_HOLYQURAN_DIR', 'images'.DS.'holyquran'.DS );
define( 'COM_HOLYQURAN_BASE', JPATH_ROOT.DS.COM_HOLYQURAN_DIR );
define( 'COM_HOLYQURAN_BASEURL', JURI::root().str_replace( DS, '/', COM_HOLYQURAN_DIR ));
define( 'COM_HOLYQURAN_VERSION_LINK', '<a href="http://www.khawaib.co.uk/index.php?option=com_content&amp;Itemid=29&amp;catid=12&amp;id=40&amp;lang=en&amp;view=article" target="_blank">Holy Quran 1.5.x.1.1</a>' );

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Require the base controller
require_once JPATH_COMPONENT.DS.'helpers'.DS.'helper.php';

// CSS
$document->addStyleSheet(JURI::base().'components/com_holyquran/css/holyquran.css');

// Require specific controller if requested
if( $controller = JRequest::getWord('controller') ) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

//Create the controller
$classname  = 'HolyquranController'.$controller;
$controller = new $classname( );

// Perform the Request task
$controller->execute( JRequest::getWord('task'));
$controller->redirect();
?>