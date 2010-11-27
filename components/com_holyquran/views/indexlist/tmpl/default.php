<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
global $mainframe, $option;
$params = &JComponentHelper::getParams( 'com_holyquran' );
?>
<div>
    <table class="qurantable" width="<?php echo $params->get( 'page_width' );?>">
        <tr>
            <?php if ($params->get( 'hide_show_page_title' )) { ?>
                <td><h1 class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>"><?php echo $params->get( 'page_title' ); ?></h1></td>
            <?php } ?>
                <td align="center" width="<?php echo $params->get('pimagew');?>">
            <?php if ($params->get('show_page_image')) { ?>
                <img src="<?php echo $params->get( 'quran_img_path' ); ?>" border="1" alt="<?php echo 'Quran';?>" width="<?php echo $params->get('pimagew');?>" height="<?php echo $params->get('pimageh');?>" />
            <?php } ?>
                </td>
        </tr>
    </table>
    <table class="qurantable" width="<?php echo $params->get( 'page_width' );?>">
        <thead>
            <tr>
                <?php if ($params->get( 'show_surah_num' )) { ?>
                    <th width="25"><?php echo JText::_( 'INDEXLIST SURAH NUMBER' ); ?></th>
                <?php }
                if ($params->get( 'show_name_of_surah' )) { ?>
                    <th width="225"><?php echo JText::_( 'INDEXLIST SURAH NAME' ); ?></th>
                <?php }
                if ($params->get( 'show_num_of_ayats' )) { ?>
                    <th width="225">
                        <?php echo JText::_( 'INDEXLIST NUMBER OF AYATS' ); ?>
                    </th>
                <?php } ?>
                <?php if ($params->get( 'show_abdul_baset' )) { ?>
                    <th width="225"><?php echo JText::_( 'INDEXLIST ABDUL BASET' ); ?></th>
                <?php } ?>
            </tr>			
        </thead>
	<?php
    for ($i=0, $n=count( $this->items ); $i < $n; $i++) {
    	$row = &$this->items[$i];
    	$checked = JHTML::_('grid.id',   $i, $row->surano );
    	$surah_link = JRoute::_( 'index.php?option=com_holyquran&view=surah&chapter='. $row->surano );
    	$al_Ajmy_audio_link = 'http://server6.mp3quran.net/ajm/'.sprintf ("%03.0f", $row->surano).'.mp3'; // Ahmad Ali Al-Ajmy
    	$abdul_baset_audio_link = 'http://www.islamicity.com/mosque/arabicscript/Ayat/'.$row->surano.'/RA101_'.$row->surano.'.ram'; // Abdul Baset
    	$al_efasy_audio_link = 'http://fdc.aswatalislam.net/Audios/Quran%5CQuran%20-%20Mishary%20Rashed%20al-Efasy%20(1424%20H)%5C/Quran%20-%20Mishary%20Rashed%20al-Efasy%20(1424%20H)%20-%20Surah%20'.sprintf ("%03.0f", $row->surano).'%20(www.aswatalislam.net).mp3'; // Mishary Rashed al-Efasy
    	
    	?>
        <tr>
            <?php if ($params->get( 'show_surah_num' )) { ?>
    			<td>
    				<?php echo $row->surano; ?>
    			</td>
            <?php }
            if ($params->get( 'show_name_of_surah' )) { ?>
    			<td>
    				<a href="<?php echo $surah_link; ?>"><?php echo $row->sura; ?></a>
    			</td>
            <?php }
            if ($params->get( 'show_num_of_ayats' )) { ?>
    			<td>
    				<?php echo $row->totalverses; ?>
    			</td>
            <?php }
            if ($params->get( 'show_abdul_baset' )) { ?>
    			<td style=text-align: center; >
    				<a href="<?php echo $abdul_baset_audio_link; ?>" target='_blank'><?php echo JText::_( 'LISTEN' ); ?><?php echo ' '.$row->sura; ?>
    			</td>
            <?php } ?>
		</tr>
    <?php }	?>
	</table>
    <table class="qurantable" width="<?php echo $params->get( 'page_width' );?>">
        <tr>
            <td align="center"><a href="http://www.khawaib.co.uk/index.php?option=com_content&Itemid=29&catid=12&id=40&lang=en&view=article" target='_blank'>Quran v1.5.x.0<a/></td>
        </tr>
    </table>
</div>