<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
//JPlugin::loadLanguage( 'com_quran' );

jimport( 'joomla.application.component.model' );
//jimport( 'joomla.application.component.helper' );

class HolyquranModelindexlist extends JModel {
    /**
     * Gets the greeting
     * @return string The greeting to be displayed to the user
     */
    var $_data;
    var $_pagination = null;
    var $_total = null;
  
    function __construct()  {
        parent::__construct();
        global $mainframe, $option;
        // Get the pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
        // In case limit has been changed, adjust limitstart accordingly
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }
    /**
     * Retrieves the hello data
     * @return array Array of objects containing the data from the database
     */
    function getData() {
        // Lets load the data if it doesn't already exist
        if (empty( $this->_data )) {
            $query = $this->_buildQuery();
            $this->_data = $this->_getList( $query );
            //$this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_data;
    }
    
    /**
     * Returns the query
     * @return string The query to be used to retrieve the rows from the database
     */
    function _buildQuery() {
//      $query = 'SELECT *, COUNT(*) AS "totalverses" '
        $query = 'SELECT id AS surano, sura_names AS sura, totalverses'
            . ' FROM #__holyquran_index'
//              . ' GROUP BY sura'
            . ' ORDER BY id';
        return $query;
    }
//  function getGreeting() {
//      $db =& JFactory::getDBO();
//      $query = 'SELECT greeting FROM #__quran';
//      $db->setQuery( $query );
//      $greeting = $db->loadResult();
//      return $greeting;
//  }
}