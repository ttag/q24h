<?php
/**
 * A Module For Displaying Skype status using transparent png
 * 
 * @package   Joomla! Stuff 
 * @subpackage Modules
 * @link www.givemeajobsoicanmovetocanada.co.uk
 * @License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * mod_gmajsicmtc_skype is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// include the helper file
require_once( dirname(__FILE__).DS.'helper.php' );

// get parameters and insert into helper
$skype_layout = $params->get( 'skype_layout' );
$skype_before = $params->get( 'skype_before' );
$dir_skype_images = $params->get( 'skype_images' );
$skype_after = $params->get( 'skype_after' );
$skype_user	 = $params->get( 'skype_user' );
$skype_choose = $params->get( 'skype_choose' );

//Pass parameters to function in this format gmajsicmtc_skype(SKYPE USERNAME,DIRECTORY TO PNGS,
//TEXT BEFORE PNG,TEXT AFTER PNG,LAYOUT)
$skype_g_status = modGmajsicmtcSkype::gmajsicmtc_skype($skype_user,$dir_skype_images,$skype_before,$skype_after,$skype_layout,$skype_choose);

require( JModuleHelper::getLayoutPath( 'mod_transparentcustomskypestatusbuttons' ) );
?>
