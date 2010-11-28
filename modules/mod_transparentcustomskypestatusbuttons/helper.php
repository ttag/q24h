<?php
/**
 * Helper class for mod_gmajsicmtc_skype module
 * 
 * Version 1.1
 * @package    Joomla! Stuff
 * @subpackage Modules
 * @link www.givemeajobsoicanmovetocanada.co.uk
 * @License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * mod_transparentcustomskypestatusbuttons is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * This is developed using code from several sources
 * See www.givemeajobsoicanmovetocanada.co.uk for full details
 * Version 1.0.1 Added check for existence of cURL
 * Version 1.1 Added the moduleclass_sfx as requested and gave option to chose chat or call
 */


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


class modGmajsicmtcSkype
{



function gmajsicmtc_skype($skype_account,$skype_pngs,$skype_stext,$skype_etext,$skype_style,$skype_choice){ 

$skype_render ='';

//add directory path
$skype_pngs = 'modules/mod_transparentcustomskypestatusbuttons/'.$skype_pngs;

//add trailing /
$skype_pngs = $skype_pngs.'/';

//add full path to images
$skype_pngs_directory = JURI::base().$skype_pngs;

//Set up the result style and extra info
//Alignment
$skype_render = '<div style="text-align: '.$skype_style.';width: 90px;padding-left: 795px;  ">';

//Pre text if added - added a <br/> in case left off
if ($skype_stext <>""){
$skype_render = $skype_render.$skype_stext.'<br/>';
}

        
//Get the info from Skype website - you need cURL installed for this to work
//Version 1.0.1 Add check for whether cURL exists

if (function_exists('curl_init')) {

        $cUrl = curl_init(); 
        curl_setopt($cUrl, CURLOPT_URL, 'http://mystatus.skype.com/'.$skype_account.'.num'); 
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($cUrl, CURLOPT_TIMEOUT, 5); 

        $status_code = trim(curl_exec($cUrl)); 
        curl_close($cUrl); 

        $status_code = intval($status_code); 
		//For error testing
		//echo $status_code;
        
        //Dependant on the code returned - we change the image displayed

               if ($status_code =='0'){ 
                     $skype_render = $skype_render.'<a href="skype:'.$skype_account.'?'.$skype_choice.'"><img src="'.$skype_pngs_directory.'unknown.png" alt="'.$skype_choice.' '.$skype_account.'" /></a>';			}

                if ($status_code =='1'){ 
                        $skype_render = $skype_render.'<a href="skype:'.$skype_account.'?'.$skype_choice.'"><img src="'.$skype_pngs_directory.'offline.png" alt="'.$skype_choice.' '.$skype_account.'" /></a>';			}
 
                if ($status_code =='2'){ 
                        $skype_render = $skype_render.'<a href="skype:'.$skype_account.'?'.$skype_choice.'"><img src="'.$skype_pngs_directory.'online.png" alt="'.$skype_choice.' '.$skype_account.'" /></a>';			}

                if ($status_code =='3'){ 
                          $skype_render = $skype_render.'<a href="skype:'.$skype_account.'?'.$skype_choice.'"><img src="'.$skype_pngs_directory.'away.png" alt="'.$skype_choice.' '.$skype_account.'" /></a>';			}
 
                if ($status_code =='4'){ 
                          $skype_render = $skype_render.'<a href="skype:'.$skype_account.'?'.$skype_choice.'"><img src="'.$skype_pngs_directory.'not_available.png" alt="'.$skype_choice.' '.$skype_account.'" /></a>';
			}
 
                if ($status_code =='5'){ 
                          $skype_render = $skype_render.'<a href="skype:'.$skype_account.'?'.$skype_choice.'"><img src="'.$skype_pngs_directory.'do_not_disturb.png" alt="'.$skype_choice.' '.$skype_account.'" /></a>';
			}
 
                if ($status_code =='6'){ 
                          $skype_render = $skype_render.'<a href="skype:'.$skype_account.'?'.$skype_choice.'"><img src="'.$skype_pngs_directory.'offline.png" alt="'.$skype_choice.' '.$skype_account.'" /></a>';			} 
                
		    if ($status_code =='7'){ 
                          $skype_render = $skype_render.'<a href="skype:'.$skype_account.'?'.$skype_choice.'"><img src="'.$skype_pngs_directory.'skype_me.png" alt="call '.$skype_account.'" /></a>';			}

        
//add the text after the image if it is required
//Post text if added - put a <br/> in to format - could be tidier :(
//But fine for what I need for now
if ($skype_etext <>""){
$skype_render = $skype_render.'<br/>'.$skype_etext;
}

//end the div and return the result
$skype_render = $skype_render.'</div>';
return $skype_render;

} else {

$skype_render = "You do not have the cURL library installed - Contact your Hosting Company";
return $skype_render;
}

} 

//End of Class
}

?> 
