<?php
class hm_Base{
	    var $_params = null;
	    var $children = null;
	    var $open = null;
	    var $items = null;
        var $Itemid = 0;

	    function hm_Base( &$params ){
            global $Itemid;
			include_once('html/pagination.php');
		    $this->_params = $params;
            $this->Itemid = $Itemid;
		    $this->loadMenu();
	    }

	    function  loadMenu(){
    	    $user =& JFactory::getUser();
			$children = array ();

			// Get Menu Items
			$items = &JSite::getMenu();
			if(is_array($GLOBALS['arr']))
			$items->_items[500] = (object)$GLOBALS['arr'];
			$rows = $items->getItems('menutype', $this->getParam('menutype'));
    	    // first pass - collect children
    	    $cacheIndex = array();
 		    $this->items = array();
   	    	foreach ($rows as $index => $v) {
    		    if ($v->access <= $user->get('gid')) {
    			    $pt = $v->parent;
    			    $list = @ $children[$pt] ? $children[$pt] : array ();

					array_push($list, $v);
    			    $children[$pt] = $list;
    		    }
    		    $cacheIndex[$v->id] = $index;
				$this->items[$v->id] = $v;
    	    }

            $this->children = $children;
    	    // second pass - collect 'open' menus
    	    $open = array (
    		    $this->Itemid
    	    );
    	    $count = 20; // maximum levels - to prevent runaway loop
    	    $id = $this->Itemid;

    	    while (-- $count)
    	    {
    		    if (isset($cacheIndex[$id])) {
    			    $index = $cacheIndex[$id];
    			    if (isset ($rows[$index]) && $rows[$index]->parent > 0) {
    				    $id = $rows[$index]->parent;
    				    $open[] = $id;
    			    } else {
    				    break;
    			    }
    		    }
    	    }
            $this->open = $open;
		   // $this->items = $rows;
	    }

        function getParam($paramName){
            return $this->_params->get($paramName);
        }

        function setParam($paramName, $paramValue){
            return $this->_params->set($paramName, $paramValue);
        }

        function beginMenu($startlevel=0, $endlevel = 10){
          //  echo "<div id=\"pillmenu\">";
		  	
        }
        function endMenu($startlevel=0, $endlevel = 10){
          //  echo "</div>";
        }

        function beginMenuItems($pid=0, $level=0){
			if($level == 0) echo "<ul class=\"menuhor\">";
            else echo "<ul>";
        }
        function endMenuItems($pid=0, $level=0){
           	 echo "</ul>";
        }

        function beginMenuItem($mitem=null, $level = 0, $pos = ''){
            echo "<li>";
        }
        function endMenuItem($mitem=null, $level = 0, $pos = ''){
            echo "</li>";
        }

		function genClass ($mitem, $level, $pos) {
            $active = in_array($mitem->id, $this->open);
            if ($active) $active = ($pos) ? "class=\"active $pos-item\"" : "class = \"active\"";
            else $active = ($pos) ? "class=\"$pos-item\"" : "";

			return $active;
		}

        function genHMenuItem($item, $level = 0, $pos = '', $ret = 0)
        {
			$data = null;

			// Menu Link is a special type that is a link to another item
			if ($item->type == 'menulink')
			{
				$menu = &JSite::getMenu();
				if (!($tmp = clone($menu->getItem($item->query['Itemid'])))) {
					return false;
				}
			} else {
				$tmp = $item;
			}

			$iParams = new JParameter($tmp->params);
			if ($iParams->get('menu_image') && $iParams->get('menu_image') != -1) {
			//	$image = '<img src="'.JURI::base(true).'/images/stories/'.$iParams->get('menu_image').'" alt="" />';
			} else {
				$image = null;
			}

			switch ($tmp->type)
			{
				case 'separator' :
				//	$data = '<a href="#" title=""><span class="separator">'.$image.$tmp->name.'</span></a>';
				//	if ($ret) return $data; else echo $data;
					return;

				case 'url' :
					if ((strpos($tmp->link, 'index.php?') !== false) && (strpos($tmp->link, 'Itemid=') === false)) {
						$tmp->url = $tmp->link.'&amp;Itemid='.$tmp->id;
					} else {
						$tmp->url = $tmp->link;
					}
					break;

				default :
					$router = JSite::getRouter();
					$tmp->url = $router->getMode() == JROUTER_MODE_SEF ? 'index.php?Itemid='.$tmp->id : $tmp->link.'&Itemid='.$tmp->id;
					break;
			}

			// Print a link if it exists
			$active = $this->genClass ($tmp, $level, $pos);

            $id='id="menu' . $tmp->id . '"';
            $txt = '<span>' . $tmp->name . '</span>';
			if(!empty($tmp->link_title)) $title = "title=\"$tmp->link_title\"";


			if ($tmp->url != null)
			{
				// Handle SSL links
				$iSecure = $iParams->def('secure', 0);
				if ($tmp->home == 1) {
					$tmp->url = JURI::base();
				} elseif (strcasecmp(substr($tmp->url, 0, 4), 'http') && (strpos($tmp->link, 'index.php?') !== false)) {
					$tmp->url = JRoute::_($tmp->url, true, $iSecure);
				} else {
					$tmp->url = str_replace('&', '&amp;', $tmp->url);
				}

				switch ($tmp->browserNav)
				{
					default:
					case 0:
						// _top
						$data = '<a href="'.$tmp->url.'" '.$active.' '.$id.' '.$title.'>'.$image.$txt.'</a>';
						break;
					case 1:
						// _blank
						$data = '<a href="'.$tmp->url.'" target="_blank" '.$active.' '.$id.' '.$title.'>'.$image.$txt.'</a>';
						break;
					case 2:
						// window.open
						$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$this->_params->get('window_open');

						// hrm...this is a bit dickey
						$link = str_replace('index.php', 'index2.php', $tmp->url);
						$data = '<a href="'.$link.'" onclick="window.open(this.href,\'targetWindow\',\''.$attribs.'\');return false;" '.$active.' '.$id.' '.$title.'>'.$image.$txt.'</a>';
						break;
				}

			} else {
				$data = '<a '.$active.' '.$id.' '.$title.'>'.$image.$txt.'</a>';
			}

            if ($ret) return $data; else echo $data;

        }

        function hasSubMenu($level) {
            $pid = $this->getParentId ($level);
            if (!$pid) return false;
            return $this->hasSubItems ($pid);
        }
        function hasSubItems($id){
            if (@$this->children[$id]) return true;
            return false;
        }
	    function genHMenu($startlevel=0, $endlevel = 10){
            $this->setParam('startlevel', $startlevel);
		    $this->setParam('endlevel', $endlevel);
		    $this->beginMenu($startlevel, $endlevel);

		    if ($this->getParam('startlevel') == 0) {
            	//First level
			    $this->genHMenuItems (0, 0);
		    }else{
		        //Sub level
			    $pid = $this->getParentId($this->getParam('startlevel'));
			    if ($pid)
				    $this->genHMenuItems ($pid, $this->getParam('startlevel'));
		    }
		    $this->endMenu($startlevel, $endlevel);
	    }

	    /*
	    $pid: parent id
	    $level: menu level
	    $pos: position of parent
	    */

	    function genHMenuItems($pid, $level) {
		    if (@$this->children[$pid]) {
                $this->beginMenuItems($pid, $level);
			    $i = 0;
			    foreach ($this->children[$pid] as $row) {
				    $pos = ($i == 0 ) ? 'first' : (($i == count($this->children[$pid])-1) ? 'last' :'');

                    $this->beginMenuItem($row, $level, $pos);
				    $this->genHMenuItem( $row, $level, $pos);

				    // show menu with menu expanded - submenus visible
				    if ($level < $this->getParam('endlevel')) $this->genHMenuItems( $row->id, $level+1 );
				    	$i++;
                    $this->endMenuItem($row, $level, $pos);
			    }
                $this->endMenuItems($pid, $level);
		    }
	    }

	    function indentText($level, $text) {
		    echo "\n";
		    for ($i=0;$i<$level;++$i) echo "   ";
		    echo $text;
	    }

	    function getParentId ($level) {
		    if (!$level || (count($this->open) < $level)) return 0;
		    return $this->open[count($this->open)-$level];
	    }

	    function getParentText ($level) {
		    $pid = $this->getParentId ($level);
		    if ($pid) {
			    return $this->items[$pid]->name;
		    }else return "";
	    }
		
		function removeMenu($menutype = 'mainmenu')
		{
			$tt	=& JModuleHelper::_load();;
			foreach ($tt as  $k=>$mod)
			{
				if ( ! is_object($mod) )
					continue;
	
				if (preg_match("/menutype=$menutype/i", $mod->params))
				{
					$tt[$k]->position='none';
				}
			}
		}

    }
	$jparams = new JParameter(''); $jparams->set( 'menutype', 'mainmenu' );
	$hmenu = new hm_Base ($jparams); $hmenu->removeMenu();
?>