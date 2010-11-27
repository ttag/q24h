<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div>
<fieldset class="adminform">
<legend><?php echo JText::_( 'UPLOAD QURAN DATABASE FILE' ); ?></legend>
<table class="admintable">
    <tr> 
        <td class="key"></td>
        <td >To get available translation files in other languages please visit: <a href="http://www.khawaib.co.uk/index.php?option=com_content&Itemid=29&catid=12&id=40&lang=en&view=article" target="_blank">www.Khawaib.co.uk</a>.</td>
    </tr>
    <tr> 
        <td class="key"><?php echo JText::_( 'PUBLISH FILE' ); ?></td>
        <td ><?php echo $this->lists['published']; ?></td>
    </tr>
    <tr> 
        <td class="key"><?php echo JText::_( 'UPLOAD FILE' );?></td>
            <td >
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                        <td><input type="file" id="file" name="file" size="75"></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo JText::_('MAXIMUM FILE SIZE ALLOWED').' '.ini_get('upload_max_filesize');?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!--<input type="submit" name="uploadbutton" value="Upload">-->
                        </td>
                    </tr>
                </table>
            </td>
        </td>
    </tr>
</table>
</fieldset>
</div>
    <div class="clr"></div>
    <input type="hidden" name="MAX_FILE_SIZE" value="$upload_max_filesize" />
    <input type="hidden" name="option" value="<?php echo JRequest::getCmd('option'); ?>" />
    <input type="hidden" name="controller" value="manageuploads" />
    <input type="hidden" name="view" value="<?php echo JRequest::getCmd('view'); ?>" />
    <input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
    <input type="hidden" name="id" value="<?php echo $this->manageuploads->id; ?>" />
</form>