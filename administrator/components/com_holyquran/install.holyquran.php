<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php function com_install() { ?>
<table width = "100%" border = "0" cellpadding = "0" cellspacing = "0">
    <tr>
        <td width = "100%" valign = "top" style = "padding:10px;">
            <?php global $mainframe; ?>
            <?php $live_site = $mainframe->isAdmin() ? $mainframe->getSiteURL() : JURI::base(); ?>
            <h1>Congratulations - Holy Quran Component has installed successfully</h1>
            <div style="float:right"><img src = "<?php echo $live_site; ?>/components/com_quran/images/quran.png" alt = "" border = "0"></div>
            <p>Holy Quran Joomla component displays Holy Quran in Arabic with flexibility of adding unlimited translation languages.</p>
            <p><strong>Note: </strong>This is first version and there is a lot of work still needs to be done. If you find any errors or suggestions contact me.</p>
            <h3>Features</h3>
            <ul>
              <li>Displays Quran in Arabic and its translations.</li>
              <li>Search functionality (Note: at the moment search is only available for english translation).</li>
              <li>Different Views</li>
                <ul>
                  <li>Default View - Displays whole Quran with pagination starting from Surah Fatiha</li>
                  <li>Index View - Displays index list view of all Surahs with number of ayats and links to recitation for Surahs</li>
                  <li>Surah View - Displays on selected surah (configured in menu options when menu is created)</li>
                </ul>
              <li>Pagination for Surahs with drop down box for number of results per page.</li>
              <li>Admins can upload translations files from backend of component.</li>
              <li>Publish/Unpublish translations.</li>
              <li>Order translations in desired order.</li>
              <li>Backend parameters settings.</li>
            </ul>
            
            <h3>Usage Instructions</h3>
            <ol>
                <li>Goto <strong>Component > Holy Quran</strong></li>
                <li>Click on <strong>Add Translations</strong> Button to add Quran Translations (Database Files). For more translations please visit our website.</li>
                <li>Click on <strong>Menu > Main Menu</strong> to create menus.</li>
                <li>Choose the menu options as desired for Default, Index or Surah Layouts.</li>
                <li>You can display one selected Surah by choosing Surah name in menu options when you choose Surah Layout.</li>
            </ol>
            
            <hr>        
            <h3>Updates and History</h3>
            <strong>10 Nov 2010</strong> - Version 1.5.x.1.1 released.
            
            <h3>Credits</h3>
            <p>Quran Image: <a href="http://www.engine-ms.com" target="_blank">Engine-MS</a></p>
            <p>Quran Database: <a href="http://www.qurandatabase.org" target="_blank">http://www.qurandatabase.org</a></p>
            <p>Ayats Audio: <a href="http://quran.al-islam.com" target="_blank">Al-Islam.com</a></p>

            <hr>
            Developer: <a href="mailto:khawaib@khawaib.co.uk">Khawaib Ahmed</a><br />
            Website: <a href="http://www.khawaib.co.uk/index.php?option=com_content&amp;Itemid=29&amp;catid=12&amp;id=40&amp;lang=en&amp;view=article" target="_blank">www.Khawaib.co.uk</a> <br />
            Demo Site: <a href="http://www.masjidtawhid.org/index.php?option=com_quran&view=indexlist&Itemid=34"  target="_blank">www.MasjidTawhid.org</a> <br />
        </td>
    </tr>
</table>
<?php } // end of com_install?>