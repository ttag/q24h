<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// Import Joomla! libraries
jimport( 'joomla.application.component.view');

class HolyquranViewTranslations extends JView {
    function display($tpl = null) {
        global $mainframe, $option;
        $params = &JComponentHelper::getParams($option);
        
        JToolBarHelper::title(   JText::_( 'HOLYQURAN' ), 'generic.png'  );

        JToolBarHelper::publishList();
        JToolBarHelper::unpublishList();
        JToolBarHelper::deleteList('Are you sure you want to delete this file?');
        JToolBarHelper::addNew();
		JToolBarHelper::preferences( 'com_holyquran', '700', '600' );

        //JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_k2');
        //jimport( 'joomla.i18n.help' );
        //JToolBarHelper::help( 'quran', true );
        
        $filter_order = $mainframe->getUserStateFromRequest( $option.'filter_order', 'filter_order',    'ordering', 'cmd' );
        $filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'ASC' );
        $filter_quranid = $mainframe->getUserStateFromRequest( $option.'$filter_quranid',   '$filter_quranid', 0,   'int' );

        $lists = array();
        $lists['order_Dir'] = $filter_order_Dir;
        $lists['order'] = $filter_order;
//        $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $manageuploads->published);
        
        //$db =& JFactory::getDBO();
        $uri =& JFactory::getURI();
        
        // Get data from the model
        $items =& $this->get('Data');
        $total =& $this->get( 'Total');
        $pagination =& $this->get( 'Pagination' );
        $javascript = 'onchange="document.adminForm.submit();"';

        $this->assignRef('lists',       $lists);
        $this->assignRef('items',       $items);
        $this->assignRef('pagination',  $pagination);
        $this->assignRef('request_url', $uri->toString());
        
        parent::display($tpl);
    }
}
?>