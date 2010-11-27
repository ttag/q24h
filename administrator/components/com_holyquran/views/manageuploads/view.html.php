<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );

class HolyquranViewManageuploads extends JView {
    function display($tpl = null) {   
        global $mainframe, $option;
        $params = &JComponentHelper::getParams($option);

        JToolBarHelper::title(   JText::_( 'HOLYQURAN' ).': <small>[ New Translation ]</small>' );
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        JToolBarHelper::preferences( 'com_holyquran', '700', '600' );
		
        $lists = array();

        $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', 1);
   
        $this->assignRef('lists',       $lists);

        $this->assignRef('manageuploads',       $manageuploads);
        
        parent::display($tpl);
    }
}