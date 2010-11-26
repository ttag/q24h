<?php defined('_JEXEC') or die('Restricted access'); ?>

<script language="javascript" type="text/javascript">
var global_transitions=[ //array of IE transition strings
	"progid:DXImageTransform.Microsoft.Barn()",
	"progid:DXImageTransform.Microsoft.Blinds()",
	"progid:DXImageTransform.Microsoft.CheckerBoard()",
	"progid:DXImageTransform.Microsoft.Fade()",
	"progid:DXImageTransform.Microsoft.GradientWipe()",
	"progid:DXImageTransform.Microsoft.Inset()",
	"progid:DXImageTransform.Microsoft.Iris()",
	"progid:DXImageTransform.Microsoft.Pixelate(maxSquare=15)",
	"progid:DXImageTransform.Microsoft.RadialWipe()",
	"progid:DXImageTransform.Microsoft.RandomBars()",
	"progid:DXImageTransform.Microsoft.RandomDissolve()",
	"progid:DXImageTransform.Microsoft.Slide()",
	"progid:DXImageTransform.Microsoft.Spiral()",
	"progid:DXImageTransform.Microsoft.Stretch()",
	"progid:DXImageTransform.Microsoft.Strips()",
	"progid:DXImageTransform.Microsoft.Wheel()",
	"progid:DXImageTransform.Microsoft.Zigzag()"
]

function woo_target(setting){
	this.wrapperid=setting.wrapperid
	this.imagearray=setting.imagearray
	this.pause=setting.pause
	this.transduration=setting.transduration/1000 //convert from miliseconds to seconds unit to pass into el.filters.play()
	this.currentimg=0
	var preloadimages=[] //temp array to preload images
	for (var i=0; i<this.imagearray.length; i++){
		preloadimages[i]=new Image()
		preloadimages[i].src=this.imagearray[i][0]
	}
	document.write('<div id="'+this.wrapperid+'" class="'+setting.wrapperclass+'"><div id="'+this.wrapperid+'_inner" style="width:100%">'+this.getSlideHTML(this.currentimg)+'</div></div>')
	var effectindex=Math.floor(Math.random()*global_transitions.length) //randomly pick a transition to utilize
	var contentdiv=document.getElementById(this.wrapperid+"_inner")
	if (contentdiv.filters){ //if the filters[] collection is defined on element (only in IE)
		contentdiv.style.filter=global_transitions[effectindex] //define transition on element
		this.pause+=setting.transduration //add transition time to pause
	}
	this.filtersupport=(contentdiv.filters && contentdiv.filters.length>0)? true : false //test if element supports transitions and has one defined
	var slideshow=this
	woo_target.addEvent(contentdiv, function(){slideshow.isMouseover=1}, "mouseover")
	woo_target.addEvent(contentdiv, function(){slideshow.isMouseover=0}, "mouseout")
	setInterval(function(){slideshow.rotate()}, this.pause)
}

woo_target.addEvent=function(target, functionref, tasktype){
	if (target.addEventListener)
		target.addEventListener(tasktype, functionref, false);
	else if (target.attachEvent)
		target.attachEvent('on'+tasktype, function(){return functionref.call(target, window.event)});
},

woo_target.setopacity=function(el, degree){ //sets opacity of an element (FF and non IE browsers only)
	if (typeof el.style.opacity!="undefined")
		el.style.opacity=degree
	else
		el.style.MozOpacity=degree
	el.currentopacity=degree
},

woo_target.prototype.getSlideHTML=function(index){
	var slideHTML=(this.imagearray[index][1])? '<a href="'+this.imagearray[index][1]+'" target="'+this.imagearray[index][2]+'">\n' : '' //hyperlink slide?
	slideHTML+='<img src="'+this.imagearray[index][0]+'" />'
	slideHTML+=(this.imagearray[index][1])? '</a><br />' : '<br />'
	slideHTML+=(this.imagearray[index][3])? this.imagearray[index][3] : '' //text description?
	return slideHTML //return HTML for the slide at the specified index
}

woo_target.prototype.rotate=function(){
	var contentdiv=document.getElementById(this.wrapperid+"_inner")
	if (this.isMouseover){ //if mouse is over slideshow
		return
	}
	this.currentimg=(this.currentimg<this.imagearray.length-1)? this.currentimg+1 : 0
	if (this.filtersupport){
		contentdiv.filters[0].apply()
	}
	else{
		woo_target.setopacity(contentdiv, 0)
	}
	contentdiv.innerHTML=this.getSlideHTML(this.currentimg)
	if (this.filtersupport){
		contentdiv.filters[0].play(this.transduration)
	}
	else{
		contentdiv.fadetimer=setInterval(function(){
			if (contentdiv.currentopacity<1)
				woo_target.setopacity(contentdiv, contentdiv.currentopacity+0.1)
			else

				clearInterval(contentdiv.fadetimer)
		}, 50) //end setInterval
	}
}
</script>

<?php

	@$stg_title = $params->get('stg_title');
	@$stg_pause = $params->get('stg_pause');
	@$stg_transduration = $params->get('stg_transduration');
	@$stg_url1 = $params->get('stg_url1');
	@$stg_url2= $params->get('stg_url2');
	@$stg_url3 = $params->get('stg_url3');
	@$stg_url4 = $params->get('stg_url4');
	@$stg_url5 = $params->get('stg_url5');
	@$stg_url6 = $params->get('stg_url6');
	@$stg_url7 = $params->get('stg_url7');
	@$stg_url8 = $params->get('stg_url8');
	@$stg_url9 = $params->get('stg_url9');
	@$stg_url10 = $params->get('stg_url10');

	if(!is_numeric(@$stg_pause)) { @$stg_pause = 2000; } 
	if(!is_numeric(@$stg_transduration)) { @$stg_transduration = 5000; } 
	
	if(!is_null(@$stg_url1))	{
		@$gallery_pack = '["'.@$stg_url1.'", "", "", ""],';
	}
	if(!is_null(@$stg_url2) && @$stg_url2 <> "")	{
		@$gallery_pack = @$gallery_pack . '["'.@$stg_url2.'", "", "", ""],';
	}
	if(!is_null(@$stg_url3) && @$stg_url3 <> "")	{
		@$gallery_pack = @$gallery_pack . '["'.@$stg_url3.'", "", "", ""],';
	}
	if(!is_null(@$stg_url4) && @$stg_url4 <> "")	{
		@$gallery_pack = @$gallery_pack . '["'.@$stg_url4.'", "", "", ""],';
	}
	if(!is_null(@$stg_url5) && @$stg_url5 <> "" )	{
		@$gallery_pack = @$gallery_pack . '["'.@$stg_url5.'", "", "", ""],';
	}
	if(!is_null(@$stg_url6) && @$stg_url6 <> "")	{
		@$gallery_pack = @$gallery_pack . '["'.@$stg_url6.'", "", "", ""],';
	}
	if(!is_null(@$stg_url7) && @$stg_url7 <> "")	{
		@$gallery_pack = @$gallery_pack . '["'.@$stg_url7.'", "", "", ""],';
	}
	if(!is_null(@$stg_url8) && @$stg_url8 <> "")	{
		@$gallery_pack = @$gallery_pack . '["'.@$stg_url8.'", "", "", ""],';
	}
	if(!is_null(@$stg_url9) && @$stg_url9 <> "")	{
		@$gallery_pack = @$gallery_pack . '["'.@$stg_url9.'", "", "", ""],';
	}
	if(!is_null(@$stg_url10) && @$stg_url10 <> "")	{
		@$gallery_pack = @$gallery_pack . '["'.@$stg_url10.'", "", "", ""],';
	}
	
	@$gallery_pack = substr(@$gallery_pack,0,(strlen(@$gallery_pack)-1));
?>

<script type="text/javascript">
var flashyshow=new woo_target({ 
	wrapperid: "woo_id_joomla_1", 
	wrapperclass: "woo_class_joomla_1", 
	imagearray: [
		<?php echo @$gallery_pack; ?>
	],
	pause: <?php echo @$stg_pause; ?>, 
	transduration: <?php echo @$stg_transduration; ?> 
})
</script>