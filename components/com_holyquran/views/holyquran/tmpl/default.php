<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php 
global $mainframe, $option;
$params = &JComponentHelper::getParams( 'com_holyquran' );
?>
<form action="<?php echo $this->action; ?>" method='post' name='frontForm'>
    <div>
        <table class="qurantable" width="<?php echo $params->get( 'page_width' );?>">
            <tr>
            <?php if ($params->get( 'hide_show_page_title' )) { ?>
                <td><h1 class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>"><?php echo $params->get( 'page_title' ); ?></h1></td>
            <?php } ?>
                <td align="center" width="<?php echo $params->get('pimagew');?>">
            <?php if ($params->get('show_page_image')) { ?>
                <img src="<?php echo $params->get( 'quran_img_path' ); ?>" border="1" alt="<?php echo 'Holy Quran';?>" width="<?php echo $params->get('pimagew');?>" height="<?php echo $params->get('pimageh');?>" />
            <?php } ?>
                </td>
            </tr>
            <tr>
                <td>
                <?php if ($params->get('show_search')) { ?>
                    <?php JHTML::_('behavior.tooltip'); echo JText::_( 'SEARCH' ); ?>:
                    <input type='text' name='search' id='searchbox' value='<?php echo $this->lists['search'];?>' class='text_area' onchange='document.frontForm.submit();' />
                    <button onclick='this.form.submit();'><?php echo JText::_( 'GO' ); ?></button>
                    <button onclick='document.getElementById('search').value='this.form.submit();'><?php echo JText::_( 'RESET' ); ?></button>
                <?php } ?>
                </td>
                <td>
                    <?php if ($params->get('show_filters')) { ?>
                    <?php echo $this->lists['chapters'];?>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <table class="qurantable" width="<?php echo $params->get( 'page_width' );?>">
            <thead>
                <tr>
                    <th width="5">
                        <?php //echo JText::_( '#' ); ?>
                    </th>
                    <th>
                        <?php //echo JText::_( 'English Translation' ); ?>
                    </th>
                </tr>           
            </thead>
            <?php
            $k = 0; 
            $i = 0;
            $n = count( $this->items );
            foreach ($this->items as $key => $item):
//                $checked    = JHTML::_('grid.id',   $i, $item->id );
//                $al_huthaify_ayat_link  = JRoute::_( 'http://quran.al-islam.com/Recite/CRecite_g2.asp?s='.$item->esurano.'&f='.$item->eayatno.'&Reciter=0' );
            ?>               
                <?php $count = 0; ?>
                <?php foreach ($item as $k => $v): ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="text-align: right">
                            <?php echo $v; ?>
                        </td>
                        <td>
                            <?php if (($count == 0) && ($params->get('show_speaker_image'))): ?>
                            <a href="<?php echo $al_huthaify_ayat_link; ?>" target='_blank'><img src="components/com_holyquran/images/play_btn.png" alt="<?php JText::_('AUDIO LINK');?>" width="<?php echo $width;?>" height="<?php echo $height;?>" border="0" /><a/>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php $count++; ?>
                <?php endforeach; ?>
                            
                <?php if ($params->get('show_horizontal_line')) { ?>
                <tr>
                    <td colspan="3">
                    <hr width="90%" NOSHADE SIZE="1"/>
                    </td>
                </tr>
            <?php
                    }
            $k = 1 - $k;
            $i++;
            endforeach;

        
        if ($params->get('show_pagination')) { ?>
            <tfoot><td colspan="3"><?php echo $this->pagination->getListFooter(); ?></td></tfoot>
        <?php } ?>
        </table>
        <table class="qurantable" width="<?php echo $params->get( 'page_width' );?>">
            <tr>
                <td align="center"><?php echo COM_HOLYQURAN_VERSION_LINK; ?></td>
            </tr>
        </table>
    </div>
</form>