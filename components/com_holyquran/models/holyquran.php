<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class HolyquranModelHolyquran extends JModel {
    var $_data;
    var $_pagination = null;
    var $_total = null;
      
    function __construct() {
        parent::__construct();
        global $mainframe, $option;
        
        // Get the pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        //$limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
        $limitstart = JRequest::getVar('limitstart', 0);
        // In case limit has been changed, adjust limitstart accordingly
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }
    function getData() {
        // Lets load the data if it doesn't already exist
        if (empty( $this->_data )) {
            $query = $this->_buildQuery();
            //OLD $this->_data = $this->_getList( $query );
            $this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );
        }

        return $this->_data;
    }
        
    function getTotal() {
        // Lets load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }

    function getPagination() {
        // Lets load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            //$total = $this->getTotal();
            //$limitstart = $this->getState('limitstart');
            //$limit = $this->getState('limit');
            $this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        
        return $this->_pagination;
    }
    
    function _buildQuery() {
		$query = '';
        $where = $this->_buildContentWhere();

        $tables = "SELECT REPLACE(filename, '.sql', '') AS tablename, language FROM #__holyquran WHERE filename <> '#__holyquran_arabic.sql' and published = 1 ORDER BY ordering";
//        $tables = "SELECT REPLACE(filename, '.sql', '') AS tablename, language FROM #__holyquran WHERE published = 1";
		$this->_db->setQuery($tables);
		$tabledata = $this->_db->loadObjectList();

		$fields = 'SELECT qa.ayat AS ayat0, '."\n";
        $tables = 'FROM #__holyquran_arabic AS qa '."\n";
        
        $count = 1;
		foreach ($tabledata as $table) {
			$language_id = $table->language;
			$tables .= 'LEFT JOIN ' . $table->tablename . ' AS ' . $language_id . ' ON (qa.id = ' . $language_id . '.id) '."\n";
			//$fields .= $language_id . '.surano AS ' . $language_id . 'surano, ' . $language_id . '.ayat AS ' . $language_id . 'ayat, ' . $language_id . '.ayatno AS ' . $language_id . 'ayatno, '."\n";
//            $fields .= $language_id . '.ayat AS ' . $language_id . 'ayat, '."\n";
            $fields .= $language_id . '.ayat AS ayat' . $count . ', '."\n";
            
            $count++;
		}
		$fields = trim($fields);
		
		if (substr($fields, -1) == ',') {
			$fields = trim(substr($fields, 0, strlen($fields)-1));
		}
		$fields = "$fields\n";

        $query = $fields . $tables . $where;

        return $query;
    }
    function _buildContentWhere() {
        global $mainframe, $option;
        
        $filter_chapter     = $mainframe->getUserStateFromRequest( $option.'filter_chapter', 'filter_chapter', 0,   'int' );
        $filter_state = $mainframe->getUserStateFromRequest( $option.'filter_state', 'filter_state', '', 'word' );
        
        $search = $mainframe->getUserStateFromRequest( $option.'search', 'search', '', 'string' );
        $search = JString::strtolower( $search );
        $where = array();
         
        if ($filter_chapter > 0) {
            $where[] = ' qa.surano = '.(int) $filter_chapter;
        } else {
            $where[] = ' qa.surano > 0';
        }
        if ($search) {
            $where[] = 'LOWER(ayat) LIKE '.$this->_db->Quote('%'.$search.'%');
        }
        $where      = ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );
        
        return $where; 
    }

	
}
?>