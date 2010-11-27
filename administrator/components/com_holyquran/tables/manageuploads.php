<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
class TableManageuploads extends JTable {
    var $id = null;
    var $quran_id = null;
    var $published = 1;
    var $filename = null;   
    var $fontsize = null;
    var $colour = null;
    var $bgcolour = null;
    var $align = null;
    var $ordering = null;
    var $createdate = null;
    var $language = null;
    var $language_code = null;
    
    function TableManageuploads(& $db) {
        parent::__construct('#__holyquran', 'id', $db);
    }
}
?>