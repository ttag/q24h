<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
// Get user group ID
$user= &JFactory::getUser();
?>
<div style="float:left;">
    <div class="icon">
        <a href="index.php?option=com_holyquran&amp;view=translations">
        <img alt="<?php echo JText::_('Translations'); ?>" src="components/com_holyquran/images/dashboard/items.png" />
        <span><?php echo JText::_('Translations'); ?></span>
        </a>
    </div>
</div>
<div style="float:left;">
    <div class="icon">
        <a href="index.php?option=com_holyquran&amp;view=manageuploads&amp;layout=form">
        <img alt="<?php echo JText::_('Add Translation'); ?>" src="components/com_holyquran/images/dashboard/item-new.png" />
        <span><?php echo JText::_('Add Translation'); ?></span>
        </a>
    </div>
</div>
<div style="float:left;">
    <div class="icon">
        <a target="_blank" href="http://www.khawaib.co.uk/index.php?option=com_content&amp;Itemid=29&amp;catid=12&amp;id=40&amp;lang=en&amp;view=article">
        <img alt="<?php echo JText::_('Documentation'); ?>" src="components/com_holyquran/images/dashboard/documentation.png" />
        <span><?php echo JText::_('Documentation'); ?></span>
        </a>
    </div>
</div>
<div style="float:left;">
    <div class="icon">
        <a target="_blank" href="http://www.khawaib.co.uk/index.php?option=com_kunena&amp;Itemid=19&amp;catid=53&amp;func=showcat&amp;lang=en">
        <img alt="<?php echo JText::_('Community'); ?>" src="components/com_holyquran/images/dashboard/help.png" />
        <span><?php echo JText::_('Support'); ?></span>
        </a>
    </div>
</div>