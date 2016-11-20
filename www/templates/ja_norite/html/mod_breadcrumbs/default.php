<?php
/*
# ------------------------------------------------------------------------
# JA Norite template for Joomla 1.5.x
# ------------------------------------------------------------------------
# Copyright (C) 2004-2010 JoomlArt.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2. CSS / JS are Copyrighted Commercial,
# bound by Proprietary License of JoomlArt. For details on licensing, 
# Please Read Terms of Use at http://www.joomlart.com/terms_of_use.html.
# Author: JoomlArt.com
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# Redistribution, Modification or Re-licensing of this file in part of full, 
# is bound by the License applied. 
# ------------------------------------------------------------------------
*/


// no direct access
defined('_JEXEC') or die('Restricted access');  ?>
<span class="breadcrumbs pathway">
<?php 
$start = $count > 1?1:0;
for ($i = $start; $i < $count; $i ++) :
	
	//Parse title and remove the options & description which configure for mega menu.
	$title = $list[$i]->name;
	$title = str_replace (array('\\[','\\]'), array('%open%', '%close%'), $title);
	$regex = '/([^\[]*)\[([^\]]*)\](.*)$/';
	if (preg_match ($regex, $title, $matches)) {
		$title = $matches[1];
	} else {
		$title = $title;
	}
	$title = str_replace (array('%open%', '%close%'), array('[',']'), $title);
	$name = $title;
	
	// If not the last item in the breadcrumbs add the separator
	if ($i < $count -1) {
		if(!empty($list[$i]->link)) {
			echo '<a href="'.$list[$i]->link.'" class="pathway">'.$name.'</a>';
		} else {
			echo '<span class="name">'.$name.'</span>';
		}
		echo ' '.$separator.' ';
	}  else if ($params->get('showLast', 1)) { // when $i == $count -1 and 'showLast' is true
	    echo '<span class="name">'.$name.'</span>';
	}
endfor; ?>
</span>