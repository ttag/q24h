<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.model' );
class HolyquranModelManageuploads extends JModel {
    function __construct() {
        parent::__construct();
            $array = JRequest::getVar('cid',  0, '', 'array');
            $this->setId((int)$array[0]);
    }
    function setId($id) {
        $this->_id      = $id;
        $this->_data    = null;
    }
    function &getData() {
        if (empty( $this->_data )) {
            $query = $this->_buildQuery();
            $this->_db->setQuery( $query );
            $this->_data = $this->_db->loadObject();            
        }
        if (!$this->_data) {
            $this->_data = new stdClass();
            $this->_data->id = 0;
            $this->_data->quran_id = 0;
            $this->_data->published = 1;
            $this->_data->filename = null;
            $this->_data->size = null;
            $this->_data->ordering = null;
            $this->_data->createdate = null;
            $this->_data->language = null;
        }
        return $this->_data;
    }
    function _buildQuery() {
        $query = 'SELECT * FROM #__holyquran WHERE id = '.$this->_id;
        return $query;
    }
    function store() {
        $row =& $this->getTable();
        $data = JRequest::get( 'post' );

        $file = JRequest::getVar('file', null, 'files', 'array' ); 
        $filename = $file['name'];
        $date =& JFactory::getDate();
        $data['createdate'] = $date->toFormat();
        $data['filename'] = $filename;
        $data['language'] = ucwords($this->get_string_between($filename, '#__quran_', '.sql'));
		
		if (!$this->upload()) {
        	global $mainframe, $option;
            $mainframe->redirect("index.php?option=$option&view=manageuploads&layout=form", "An error occuered while uploading new translation.");
		}
			
/*        if ($this->upload()) {
        // Bind the form fields to the  table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        // Make sure the  record is valid
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        // Store the table to the database
        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        return true;
        }*/
    }
    function get_string_between($string, $start, $end) {
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);   
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }
    function upload() {
        global $mainframe, $option;
        set_time_limit(0);
        $database =& JFactory::getDBO();
        $file = JRequest::getVar('file', null, 'files', 'array' );
        $filename = strtolower($file['name']);
        $filepath = JPATH_SITE.DS.'administrator'.DS.'components'.DS.$option.DS.'uploads'.DS;
        if (!$filename) {
            $mainframe->redirect("index.php?option=$option&view=manageuploads&layout=form", "Please select a file to upload.");
            return;
        }
        if (!eregi("(\.(sql|gz))$",$filename)) {
            $mainframe->redirect("index.php?option=$option&view=manageuploads&layout=from", "File of this format is not allowed.");
            return;
        }
        if(isset($file) && is_array($file) && $file['name'] != '') {
            $pathandfile = JPATH_SITE.DS.'administrator'.DS.'components'.DS.$option.DS.'uploads'.DS.strtolower($file['name']); 
            jimport('joomla.filesystem.file');
            if (JFile::exists($pathandfile)) {
            	unlink($pathandfile);
				if (JFile::exists($pathandfile)) {
                	$mainframe->redirect("index.php?option=$option&view=manageuploads&layout=form", "File already exists! Delete file from [Root]/administrator/component/com_holyquran/uploads/ folder and try to upload again.");
                	return;
				}
            }
            if (!JFile::upload($file['tmp_name'], $pathandfile)) {
                $mainframe->redirect("index.php?option=$option&view=manageuploads&layout=form", "Upload failed, My be you have restrictions on upload file size.");
                return;
            }
            if (!$this->parseSQLFiles($filepath, $filename)) {
                $mainframe->redirect("index.php?option=$option&view=manageuploads&layout=form", "Could not Parse SQL File.");
                return;
            }
        }
        return true;
    }

    function parseSQLFiles($filepath, $filename) {
        global $mainframe, $option;
        if (eregi("(\.(sql))$",$filename)) {
            // Initialize variables
            $queries = array();
            $database = & $this->_db;
            $databaseDriver = strtolower($database->get('name'));
            if ($databaseDriver == 'mysqli') {
                $databaseDriver = 'mysql';
            }
            $databaseCharset = ($database->hasUTF()) ? 'utf8' : '';
                $fCharset = 'utf8';
                $fDriver = 'mysql';
                if ( $fCharset == $databaseCharset && $fDriver == $databaseDriver) {
                // Get the name of the sql file to process
                    $sqlfile = $filepath.$filename;
                    // Check that sql files exists before reading. Otherwise raise error for rollback
                    if ( !file_exists( $sqlfile ) ) {
						$mainframe->redirect("index.php?option=$option", "File does not exit. Path: $sqlfile");
						return;
                    }
                    $buffer = file_get_contents($sqlfile);
                    // Graceful exit and rollback if read not successful
                    if ( $buffer === false ) {
						$mainframe->redirect("index.php?option=$option", "Could not open and read SQL file. Path: $sqlfile");
						return;
                    }
                    // Create an array of queries from the sql file
                    jimport('joomla.installer.helper');
                    $queries = JInstallerHelper::splitSql($buffer);
                    if (count($queries) == 0) {
						$mainframe->redirect("index.php?option=$option", "No queries to process. Path: $sqlfile");
						return;
                    }
                    // Process each query in the $queries array (split out of sql file).
                    foreach ($queries as $query) {
                        $query = trim($query);
                        if ($query != '' && $query{0} != '#') {
                            $database->setQuery($query);
                            if (!$database->query()) {
                                JError::raiseWarning(1, 'JInstaller::install: '.JText::_('SQL Error')." ".$database->stderr(true));
                                return false;
                            }
                        }
                    }
                }       
            return true;
            //  return (int) count($queries);
        }

        if (eregi("(\.(gz))$",$filename)) {
          $csv_insert_table = '';     // Destination table for CSV files
          $ajax             = false;  // AJAX mode: import will be done without refreshing the website
          $linespersession  = 7000;   // Lines to be executed per one import session
          $delaypersession  = 0;      // You can specify a sleep time in milliseconds after each session
                                      // Works only if JavaScript is activated. Use to reduce server overrun
//$file = false;
          $error = false;
          $gzipmode = true;
          $file = $filepath.$filename;
          $curfilename = $file;
    
          if ((!$gzipmode && !$file=@fopen($curfilename,"rt")) || ($gzipmode && !$file=@gzopen($curfilename,"rt"))) {
            $mainframe->redirect("index.php?option=$option", "Can't open ".$filename." for import.");
              return;
          } else if ((!$gzipmode && @fseek($file, 0, SEEK_END)==0) || ($gzipmode && @gzseek($file, 0)==0)) {
            if (!$gzipmode) $filesize = ftell($file);
            else $filesize = gztell($filesize);
          }
          $_REQUEST["start"] = 1;
          $_REQUEST["foffset"] = 0; 
          $_REQUEST["totalqueries"] = 0;
          $query = "";
          $queries = 0;
          $totalqueries = $_REQUEST["totalqueries"];
          $linenumber = $_REQUEST["start"];
          $querylines = 0;
          $inparents = false;
        }
    }
    
    function delete() {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        $row =& $this->getTable();

        if (count( $cids )) {
            foreach($cids as $cid) {
                $db=& JFactory::getDBO();
				
                $findfilequery = 'SELECT filename FROM #__holyquran WHERE id = '.$cid.' LIMIT 1';
                $db->setQuery($findfilequery);
                $filerow = $db->loadObject();
                $filetodelete = $filerow->filename;
                $filepath = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_holyquran'.DS.'uploads'.DS.$filetodelete;
                unlink($filepath);
				
                $dropTableQuery = 'DROP TABLE IF EXISTS `' . substr($filetodelete, 0, -4).'`';
                $this->_db->setQuery( $dropTableQuery );
                if (!$this->_db->query()) {
                    $this->setError($this->_db->getErrorMsg());
                    return false;
                }
                if (!$row->delete( $cid )) {
                    $this->setError( $row->getErrorMsg() );
                    return false;
                }
            }                       
        }
        return true;
    }
    function publish($cid = array(), $publish = 1) {
        if (count( $cid )) {
            $cids = implode( ',', $cid );
            $query = 'UPDATE #__holyquran'
                . ' SET published = ' . intval( $publish )
                . ' WHERE id IN ( '.$cids.' )'
            ;
            $this->_db->setQuery( $query );
            if (!$this->_db->query()) {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
        }
    }
    function move($direction) {
        $row =& $this->getTable();
        if (!$row->load($this->_id)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        if (!$row->move( $direction, ' quran_id = '.(int) $row->quran_id.' AND published >= 0 ' )) {
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
            $groupings[] = $row->quran_id;

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
            $row->reorder('quran_id = '.(int) $group);
        }
        return true;
    }
}