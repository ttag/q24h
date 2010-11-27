<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');
$uri =& JFactory::getURI();

class HolyquranViewIndexlist extends JView {
	function display($tpl = null) {	
		global $mainframe, $option;
		$params = &JComponentHelper::getParams($option);
		
		$db=& JFactory::getDBO();
		$uri =& JFactory::getURI();

	    // Get data from the model
	    $items =& $this->get('Data');

	    $this->assignRef('items', $items);
	    $this->assignRef('request_url',	$uri->toString());
	            
	    parent::display($tpl);
	}
}
?>