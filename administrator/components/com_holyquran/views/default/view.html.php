<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
// Import Joomla! libraries
jimport( 'joomla.application.component.view');

class HolyquranViewDefault extends JView {
    function display($tpl = null) {
        global $mainframe, $option;
        $params = &JComponentHelper::getParams($option);
        JToolBarHelper::title( JText::_( 'HOLYQURAN' ), 'generic.png' );

        JToolBarHelper::preferences( 'com_holyquran', '700', '600' );
        $bar=& JToolBar::getInstance( 'toolbar' );
      
        parent::display($tpl);
    }
}
?>