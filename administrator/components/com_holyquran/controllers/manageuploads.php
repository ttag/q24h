<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
class HolyquranControllerManageuploads extends JController {
    function __construct() {
        parent::__construct();
        $this->registerTask( 'add', 'edit' );
        $this->registerTask( 'upload', 'upload' );
    }

    function save() {
        $model = $this->getModel('manageuploads');
        if ($model->store($post)) {
            $msg = JText::_( 'FILE SAVED' );
        } else {
            $msg = JText::_( 'ERROR SAVING FILE' );
        }
        $file = JRequest::getVar('file', null, 'files', 'array' );
        $filename = strtolower($file['name']);
        $link = 'index.php?option=com_holyquran&view=translations';
        $this->setRedirect($link, $msg);
    }

    function edit() {
        JRequest::setVar( 'view', 'manageuploads' );
        JRequest::setVar( 'layout', 'form'  );
        JRequest::setVar('hidemainmenu', 1);
        parent::display();
    }

    function remove() {
        $model = $this->getModel('manageuploads');
        if(!$model->delete()) {
            $msg = JText::_( 'ERROR FILE COULD NOT BE DELETED' );
        } else {
            // @unlink(basename($_REQUEST["delete"])
            $msg = JText::_( 'FILES DELETED' );
        }
        $this->setRedirect( 'index.php?option=com_holyquran&view=translations', $msg );
    }
    
    function publish() {
        global $mainframe;
        $cid    = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        if (!is_array( $cid ) || count( $cid ) < 1) {
            JError::raiseError(500, JText::_( 'SELECT A FILE TO PUBLISH' ) );
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
            JError::raiseError(500, JText::_( 'SELECT A FILE TO UNPUBLISH' ) );
        }
        $model = $this->getModel('manageuploads');
        if(!$model->publish($cid, 0)) {
            echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
        }
        $this->setRedirect( 'index.php?option=com_holyquran&view=translations' );
    }
    
    function cancel() {
        $msg = JText::_( 'OPERATION CANCELED' );
        $this->setRedirect( 'index.php?option=com_holyquran&view=translations', $msg );
    }
}
?>