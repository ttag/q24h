<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');
$uri =& JFactory::getURI();

class HolyquranViewHolyquran extends JView {
    function display($tpl = null) {
        global $mainframe, $option;

        $filter_chapter = $mainframe->getUserStateFromRequest( $option.'filter_chapter', 'filter_chapter',0,'int' );
//        $filter_state = $mainframe->getUserStateFromRequest( $option.'filter_state', 'filter_state', '', 'word' );
        $search = $mainframe->getUserStateFromRequest( $option.'search', 'search', '', 'string' );
        $search = JString::strtolower( $search );
        $lists['search'] = $search;
        
        $javascript = 'onchange="document.adminForm.submit();"';
        
        $db =& JFactory::getDBO();
        $uri =& JFactory::getURI();
    
        // Get data from the model
        $items =& $this->get('Data');

        $pagination =& $this->get( 'Pagination' );
        $database =& JFactory::getDBO();
        
        $query = 'SELECT id AS value, sura_names AS text FROM #__holyquran_index ORDER BY id';
        $database->setQuery( $query );
        //$sortorder = $database->loadObjectList();
        
        $chapters[] = JHTML::_('select.option',  '0', JText::_( 'SELECT SURAH(CHAPTER)' ) );
        $chapters = array_merge( $chapters, $database->loadObjectList() );
        $lists['chapters']  = JHTML::_('select.genericlist',   $chapters, 'filter_chapter', 'class="inputbox" size="1" onchange="this.form.submit()"', 'value', 'text', "$filter_chapter" );

        $this->assign('action',         $uri->toString());
        $this->assignRef('lists',       $lists);
        $this->assignRef('items',       $items);
        $this->assignRef('pagination',  $pagination);
        $this->assignRef('request_url', $uri->toString());
                
        parent::display($tpl);
    }
}
?>