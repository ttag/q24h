<?php

jimport('joomla.application.component.controller');

class HolyquranControllerTranslations extends JController {
    function __construct() {
        parent::__construct();
        // Register Extra task
        $this->registerTask( 'add'  , 'edit' );
        $this->registerTask( 'apply', 'save' );
    }
    
    function display() {
        JRequest::setVar('view', 'translations');
        parent::display();
    }
    function add() {
        $mainframe = &JFactory::getApplication();
        $mainframe->redirect('index.php?option=com_holyquran&view=manageuploads&layout=form');
    }
    function remove() {
        $model = $this->getModel('manageuploads');
        if(!$model->delete()) {
            $msg = JText::_( 'Error: File(s) Could not be Deleted' );
        } else {
            $msg = JText::_( 'File(s) Deleted' );
        }
        $this->setRedirect( 'index.php?option=com_holyquran&view=translations', $msg );
    }
    
    
    function publish() {
        global $mainframe;
        $cid    = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        if (!is_array( $cid ) || count( $cid ) < 1) {
            JError::raiseError(500, JText::_( 'Select File(s) to publish' ) );
        }
        $model = $this->getModel('manageuploads');
        if(!$model->publish($cid, 1)) {
            echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
        }
        $this->setRedirect( 'index.php?option=com_holyquran&view=translations' );
    }
    function unpublish() {
        global $mainframe;
        $cid    = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        if (!is_array( $cid ) || count( $cid ) < 1) {
            JError::raiseError(500, JText::_( 'Select File(s) to unpublish' ) );
        }
        $model = $this->getModel('manageuploads');
        if(!$model->publish($cid, 0)) {
            echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
        }
        $this->setRedirect( 'index.php?option=com_holyquran&view=translations' );
    }
    function orderup() {
        $model = $this->getModel('translations');
        $model->move(-1);
        $this->setRedirect('index.php?option=com_holyquran&view=translations');
    }
    function orderdown() {
        $model = $this->getModel('translations');
        $model->move(1);
        $this->setRedirect('index.php?option=com_holyquran&view=translations');
    }
    function saveorder() {        
        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        $order = JRequest::getVar( 'order', array(), 'post', 'array' );
        JArrayHelper::toInteger($cid);
        JArrayHelper::toInteger($order);
        $model = $this->getModel('translations');
        $model->saveorder($cid, $order);
        $msg = JText::_( 'New ordering saved' );
        $this->setRedirect( 'index.php?option=com_holyquran&view=translations', $msg );
    }
}
?>