<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// Include library dependencies
jimport('joomla.filter.input');

class TableItem extends JTable {
	var $id = null;

	function __construct(& $db) {
		parent::__construct('#__holyquran', 'id', $db);
	}

	function check() {
		return true;
	}
}
?>