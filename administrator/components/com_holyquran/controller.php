<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'helper.php' );

class HolyquranController extends JController {
    function __construct() {
        //Get View
        if(JRequest::getCmd('view') == '') {
            JRequest::setVar('view', 'default');
        }
        
/*dump(JRequest::getCmd('option'), 'option');
dump(JRequest::getWord('controller'), 'controller');
dump(JRequest::getVar('task'), 'task');
dump(JRequest::getVar('view'), 'view');
dump(JRequest::getVar('layout'), 'layout');*/

        $this->item_type = 'Default';
        parent::__construct();
    }
    
    function display() {
        parent::display();
    }
}
?>