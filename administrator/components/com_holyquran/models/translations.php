<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.model' );

class HolyquranModelTranslations extends JModel {
    var $_data;
    var $_pagination = null;
    var $_total = null;
    
    function __construct() {
        parent::__construct();
        global $mainframe, $option;
        // Get the pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
        
        $array = JRequest::getVar('cid',  0, '', 'array');
        $this->setId((int)$array[0]);
    }
    function setId($id) {
        $this->_id      = $id;
        $this->_data    = null;
    }
    function getData() {
        if (empty( $this->_data )) {
            $query = $this->_buildQuery();
            $this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_data;
    }
    function getTotal() {
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }
    function move($direction) {
        $row =& $this->getTable();
        if (!$row->load($this->_id)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        if (!$row->move( $direction, ' catid = '.(int) $row->catid.' AND published >= 0 ' )) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        return true;
    }
    function saveorder($cid = array(), $order) {
        $row =& $this->getTable();
        $groupings = array();
        // update ordering values
        for( $i=0; $i < count($cid); $i++ ) {
            $row->load( (int) $cid[$i] );
            // track categories
            $groupings[] = $row->catid;

            if ($row->ordering != $order[$i]) {
                $row->ordering = $order[$i];
                if (!$row->store()) {
                    $this->setError($this->_db->getErrorMsg());
                    return false;
                }
            }
        }
        // execute updateOrder for each parent group
        $groupings = array_unique( $groupings );
        foreach ($groupings as $group) {
            $row->reorder('catid = '.(int) $group);
        }
        return true;
    }
    
    
    function getPagination() {
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
    }
    function _buildContentWhere() {
        global $mainframe, $option;
      $where = array();
      $filter_catid   = $mainframe->getUserStateFromRequest( $option.'filter_catid', 'filter_catid', 0, 'int' );
      if ($filter_catid > 0) {
        $where[] = 'q.catid = '.(int) $filter_catid;
      }
      $where = ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );    
        return $where;
    }
    function _buildContentOrderBy() {
        global $mainframe, $option;
        $orders = array('id', 'published', 'language', 'filename', 'ordering','createdate', 'ayatsfound');
        $filter_order       = $mainframe->getUserStateFromRequest( $option.'filter_order', 'filter_order', 'ordering',  'cmd' );
        $filter_order_Dir   = strtoupper($mainframe->getUserStateFromRequest( $option.'filter_order_Dir',   'filter_order_Dir', 'ASC' ));
        if ($filter_order_Dir != 'ASC' && $filter_order_Dir != 'DESC') {$filter_order_Dir = 'ASC';}
        if (!in_array($filter_order, $orders)) { $filter_order = 'ordering';}
            if ($filter_order == 'ordering'){
            $orderby    = ' ORDER BY catid, ordering '.$filter_order_Dir;
        } else {
            $orderby    = ' ORDER BY '.$filter_order.' '.$filter_order_Dir.' , catid, ordering ';
        }
        return $orderby;
    }
    function _buildQuery() {
        $where = $this->_buildContentWhere();
        $orderby    = $this->_buildContentOrderBy();
        $query = ' SELECT q.*'
            . ' FROM #__holyquran AS q'
        . $where
        . $orderby;
        
        return $query;
    }
}
    