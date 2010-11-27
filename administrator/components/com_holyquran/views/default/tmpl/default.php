<?php
defined('_JEXEC') or die('Restricted access');
?>
<div id="cpanel" class="hqAdminCpanel">
    <?php echo $this->loadTemplate('quickicons'); ?>
    <div class="clr"></div>
    <div id="adsense">
        <iframe src="http://www.khawaib.co.uk/adsense/quran_adsense.html" width="350px" height="300px" frameborder="0" marginwidth ="0px" marginheight="0px" scrolling="no"></iframe>
    </div>
</div>
<div id="hqAdminStats">
    <?php echo $this->loadTemplate('tabs'); ?>
</div>
<div class="clr"></div>
<div id="footer">
	<p class="copyright">
		<?php echo COM_HOLYQURAN_VERSION_LINK; ?>
	</p>
</div>
