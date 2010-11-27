<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// Get user group ID
$user= &JFactory::getUser();
?>
<?php
jimport('joomla.html.pane');
$pane =& JPane::getInstance('Tabs');
echo $pane->startPane('myPane');

echo $pane->startPanel(JText::_('Holy Quran'), 'aboutHQTab');
?>
<div id="about">
	<p>Quran component displays Holy Quran in Joomla 1.5 websites.</p>
	<p>You like this component and would like to support the development of Holy Quran component?</p>
	<ul>
	    <li>
	        <p>Donate to Holy Quran component project:</p>
	        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	            <input type="hidden" name="cmd" value="_s-xclick">
	            <input type="hidden" name="hosted_button_id" value="SKELQF9DXJSTW">
	            <input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
	            <img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
	        </form>
	    </li>
	    <li>
	        <p>Make translations for Holy Quran into your language.</p>
	    </li>
	    <li>
	        <p>Rate Holy Quran on Joomla! Extensions Directory.</p>
	    </li>
	</ul>
	<table width = "100%" border = "0" cellpadding = "0" cellspacing = "0">
	    <tr>
	        <td width = "100%" valign = "top" style = "padding:10px;">
	            Release Date: 07 Nov 2010 <br />
	            Project Website: <a href="http://www.khawaib.co.uk/index.php?option=com_content&Itemid=29&catid=12&id=40&lang=en&view=article"  target="_blank">www.Khawaib.co.uk</a> <br />
	            Demo Site: <a href="http://www.khawaib.co.uk/demo"  target="_blank">www.Khawaib.co.uk/demo</a> <br />
	            Support: <a href="http://www.khawaib.co.uk/index.php?option=com_kunena&Itemid=19&catid=53&func=showcat"  target="_blank">www.Khawaib.co.uk/demo</a> <br />
	        </td>
	    </tr>
	</table>
</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_('Translations'), 'translationsTab'); ?>
    <p>Following are the translations available:</p>
    <table class="adminlist">
        <thead>
            <tr>
                <td class="title"><?php echo JText::_('Translation'); ?></td>
                <td class="title"><?php echo JText::_('Translator'); ?></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Dutch - Dutch</td>
                <td></td>
            </tr>
            <tr>
                <td>Dutch - Keyzer</td>
                <td></td>
            </tr>
            <tr>
                <td>English - Pickthall</td>
                <td>Muhammed Marmaduke William Pickthall.</td>
            </tr>
            <tr>
                <td>Urdu - Jalandhry</td>
                <td>Fateh Muhammad Jalandhry.</td>
            </tr>
        </tbody>
    </table>
    <p>For more translations visit project website www.Khawaib.co.uk</p>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_('Credits'), 'creditsTab'); ?>
    
    <table class="adminlist">
        <thead>
            <tr>
                <td class="title"><?php echo JText::_(''); ?></td>
                <td class="title"><?php echo JText::_(''); ?></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Developer</td>
                <td><a href="http://www.khawaib.co.uk/index.php?option=com_content&Itemid=6&id=1&lang=en&view=article" target="_blank">Khawaib Ahmed</a></td>
            </tr>
            <tr>
                <td>Quran Image</td>
                <td><a href="http://www.engine-ms.com" target="_blank">Engine-MS</a></td>
            </tr>
            <tr>
                <td>Ayat Images</td>
                <td><a href="http://beta.globalquran.com" target="_blank">GlobalQuran.com</a></td>
            </tr>
            <tr>
                <td>Quran Database</td>
                <td><a href="http://www.qurandatabase.org" target="_blank">http://www.qurandatabase.org</a></td>
            </tr>
            <tr>
                <td>Ayats Audio</td>
                <td><a href="http://quran.al-islam.com" target="_blank">Al-Islam.com</a></td>
            </tr>
        </tbody>
    </table>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->endPane(); ?>