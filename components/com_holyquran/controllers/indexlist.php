<?php
defined('_JEXEC') or die();
jimport('joomla.application.component.controller');

class HolyquranControllerindexlist extends JController {
    function __construct() {
        parent::__construct();
        //Register tasks
        $this->registerTask( 'view' );
    }
    function view() {
        JRequest::setVar( 'view', 'indexlist' );
        JRequest::setVar( 'layout', 'default'  );
        //JRequest::setVar('hidemainmenu', 1);

        parent::display();
    }   
}
?>