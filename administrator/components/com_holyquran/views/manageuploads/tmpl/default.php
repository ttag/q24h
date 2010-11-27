<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action='index.php' method='post' name='adminForm'>
<b></b>
<div id="editcell">
  <table>
  <tr>
  <td>
      <?php JHTML::_('behavior.tooltip'); echo JText::_( 'Filter' ); ?>:
      <input type='text' name='search' id='search' value='<?php echo $this->lists[ï¿½searchï¿½];?>' class='text_area' onchange='document.adminForm.submit();' />
      <button onclick='this.form.submit();'><?php echo JText::_( 'Go' ); ?></button>
      <button onclick='document.getElementById(ï¿½searchï¿½).value=';this.form.submit();'><?php echo JText::_( 'Reset' ); ?></button>
  </td>
  <td>  
        <?php echo $this->lists['chapters'];?> 
  </td>
  </tr>
  </table>
    <table class="adminlist">
    <thead>
        <tr>
            <th width="5">
                <?php echo JText::_( 'ID' ); ?>
            </th>
            <th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
            </th>
            <th>
                <?php echo JText::_( 'Sura' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'Ayat' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'English Translation' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'Urdu Translation' ); ?>
            </th>
<!--
            <th>
                <?php //echo JText::_( 'New Translation' ); ?>
            </th>
-->
        </tr>           
    </thead>
    <?php
    $k = 0;
    for ($i=0, $n=count( $this->items ); $i < $n; $i++)
    {
        $row = &$this->items[$i];
        $checked    = JHTML::_('grid.id',   $i, $row->id );
        $link       = JRoute::_( 'index.php?option=com_quran&controller=quran&task=edit&cid[]='. $row->id );
        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td>
                <?php echo $row->id; ?>
            </td>
            <td>
                <?php echo $checked; ?>
            </td>
            <td>
                <?php echo $row->sura; ?>
            </td>
            <td>
                <?php echo $row->ayatno; ?>
            </td>
            <td>
                <a href="<?php echo $link; ?>"><?php echo $row->ayat; ?></a>
            </td>
            <td>
                <?php echo $row->ayat_urdu; ?>
            </td>
<!--
            <td>
                <a href="<?php //echo $link; ?>">New Translation/Explanation</a>
            </td>
-->
        </tr>
        <?php
        $k = 1 - $k;
    }
    ?>
  <tfoot><td colspan="10"> <?php echo $this->pagination->getListFooter(); ?> </td></tfoot>
    </table>
</div>
<input type="hidden" name="option" value="<?php echo JRequest::getCmd('option'); ?>" />
<input type="hidden" name="view" value="<?php echo JRequest::getCmd('view'); ?>" />
<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="manageuploads" />
</form>