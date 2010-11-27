<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action='index.php' method='post' name='adminForm'>
<?php //echo $this->lists['quranid']; ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php $ordering = ($this->lists['order'] == 'a.ordering'); ?>
<div id="editcell">
    <table class="adminlist">
        <thead>
            <tr>
                <th width="5">
                    <?php echo JText::_( 'ID' ); ?>
                </th>
                <th width="20">
                    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
                </th>
                <th width="120" nowrap="nowrap" align="left">
                    <?php echo JHTML::_('grid.sort',  'LANGUAGES', 'language', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th width="120" nowrap="nowrap" align="left">
                    <?php echo JHTML::_('grid.sort',  'FILE_NAME', 'filename', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th width="20" align="center" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort',  'PUBLISHED', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                </th>
                <th nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort',  'ORDER', 'ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                    <?php echo JHTML::_('grid.order',  $this->items ); ?>
                </th>
                <th width="150" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort',  'INSTALL_DATE', 'createdate', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th width="200" align="center" nowrap="nowrap">
                	<?php echo JHTML::_('grid.sort',  'TEXT_ALIGN', 'textalign', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th>
                    <?php echo JHTML::_('grid.sort',  'FONT_SIZE', 'fontsize', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th>
                    <?php echo JHTML::_('grid.sort',  'COLOUR', 'colour', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th>
                    <?php echo JHTML::_('grid.sort',  'BGCOLOUR', 'bgcolour', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th>
                    <?php echo JHTML::_('grid.sort',  'LANGUAGE_CODE', 'language_code', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
            </tr>           
        </thead>
        <?php
        $k = 0;
        for ($i=0, $n=count( $this->items ); $i < $n; $i++) {
            $row =& $this->items[$i];
            $checked    = JHTML::_('grid.id',   $i, $row->id );
            $link       = JRoute::_( 'index.php?option=com_holyquran&controller=quran&task=edit&cid[]='. $row->id );
            $published  = JHTML::_('grid.published', $row, $i );
            $ordering = ($this->lists['order'] == 'ordering');
            ?>
            <tr class="<?php echo "row$k"; ?>">
                <td>
                    <?php echo $this->pagination->getRowOffset( $i ); ?>
                </td>
                <td>
                    <?php echo $checked; ?>
                </td>
                <td>
                    <?php echo $row->language; ?>
                </td>
                <td>
                    <?php echo $row->filename; ?>
                </td>
                <td align="center">
                    <?php echo $published; ?>
                </td>
                <td width="10%" class="order">
                    <span><?php echo $this->pagination->orderUpIcon( $i, true,'orderup', 'Move Up', $ordering ); ?></span>
                    <span><?php echo $this->pagination->orderDownIcon( $i, $n, true, 'orderdown', 'Move Down', $ordering ); ?></span>
                    <?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
                    <input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
                </td>
                <td align="center">
                    <?php echo $row->createdate; ?>
                </td>
                <td align="center">
                    <?php echo $row->align; ?>
                </td>
                <td>
                    <?php echo $row->fontsize; ?>
                </td>
                <td>
                    <?php echo $row->colour; ?>
                </td>
                <td>
                    <?php echo $row->bgcolour; ?>
                </td>
                <td>
                    <?php echo $row->language_code; ?>
                </td>
            </tr>
            <?php
            $k = 1 - $k;
        }
        if (!$this->items) {
        ?>
            <tr>
                <td colspan="15">
                    <dl id="system-message">
                        <dt class="message">Message</dt>
                            <dd class="message message fade">
                                <ul>
                                    <li>Please Upload Quran Translation SQL files.</li>
                                </ul>
                            </dd>
                    </dl>
                </td>
            </tr>
        <?php
        }
        ?>
        <tfoot><td colspan="15"> <?php echo $this->pagination->getListFooter(); ?></td></tfoot>
    </table>
</div>
<input type="hidden" name="option" value="<?php echo JRequest::getCmd('option'); ?>" />
<input type="hidden" name="controller" value="translations" />
<input type="hidden" name="view" value="<?php echo JRequest::getCmd('view'); ?>" />
<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<input type="hidden" name="boxchecked" value="0" />
</form>