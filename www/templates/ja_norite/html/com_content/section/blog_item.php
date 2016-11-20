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
defined('_JEXEC') or die('Restricted access'); ?>

<?php
//Get out all images
$regex = "/\<img[^\>]*>/";
$images = '';
if (preg_match_all ($regex, $this->item->text, $matches)) {
	$this->item->text = preg_replace ($regex, '', $this->item->text);
	$images = implode ("\n", $matches[0]);
}
?>

<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
	<div class="contentpaneopen_edit<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>" style="float: left;">
		<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
	</div>
<?php endif; ?>
<div class="contentpaneopen<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?> <?php if ($images): ?>haveimage<?php endif; ?> clearfix">

<?php if ($images): ?>
<div class="article-image">
<span><?php echo $images ?></span>
</div>
<?php endif; ?>

<div class="article-main">
<?php if ($this->item->params->get('show_title')) : ?>
<h2 class="contentheading<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>"><?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?><a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>"><?php echo $this->escape($this->item->title); ?></a><?php else : ?><?php echo $this->escape($this->item->title); ?><?php endif; ?></h2>
<?php endif; ?>

<?php  if (!$this->item->params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php
if (
($this->item->params->get('show_create_date'))
|| (($this->item->params->get('show_author')) && ($this->item->author != ""))
|| (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid))
|| ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon'))
|| ($this->item->params->get('show_url') && $this->item->urls)
) :
?>
<div class="article-tools clearfix">
<div class="article-meta" <?php if (!($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon'))):?>style="width: 100%"<?php endif;?>>

<?php if ($this->item->params->get('show_create_date')) : ?>
	<span class="createdate">
		<?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')); ?>
	</span>
<?php endif; ?>

<?php if (($this->item->params->get('show_author')) && ($this->item->author != "")) : ?>
	<span class="createby">
		<?php JText::printf(($this->item->created_by_alias ? $this->escape($this->item->created_by_alias) : $this->escape($this->item->author)) ); ?>
	</span>
<?php endif; ?>

<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?>
	<?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->section->title)) : ?>
	<span class="article-section">
		<?php if ($this->item->params->get('link_section')) : ?>
			<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; ?>
		<?php endif; ?>
		<?php echo $this->escape($this->section->title); ?>
		<?php if ($this->item->params->get('link_section')) : ?>
			<?php echo '</a>'; ?>
		<?php endif; ?>
			<?php if ($this->item->params->get('show_category')) : ?>
			<?php echo ' - '; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
	<?php if ($this->item->params->get('show_category') && $this->item->catid) : ?>
	<span class="article-section">
		<?php if ($this->item->params->get('link_category')) : ?>
			<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; ?>
		<?php endif; ?>
		<?php echo $this->escape($this->item->category); ?>
		<?php if ($this->item->params->get('link_category')) : ?>
			<?php echo '</a>'; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
<?php endif; ?>
</div>

<?php if ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?>
<div class="buttonheading">
	<?php if ($this->item->params->get('show_email_icon')) : ?>
	<span class="ja-button-email">
	<?php echo JHTML::_('icon.email', $this->item, $this->item->params, $this->access); ?>
	</span>
	<?php endif; ?>

	<?php if ( $this->item->params->get( 'show_print_icon' )) : ?>
	<span class="ja-button-print">
	<?php echo JHTML::_('icon.print_popup', $this->item, $this->item->params, $this->access); ?>
	</span>
	<?php endif; ?>

	<?php if ($this->item->params->get('show_pdf_icon')) : ?>
	<span class="ja-button-pdf">
	<?php echo JHTML::_('icon.pdf', $this->item, $this->item->params, $this->access); ?>
	</span>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php if ($this->item->params->get('show_url') && $this->item->urls) : ?>
	<span class="article-url">
		<a href="http://<?php echo $this->item->urls ; ?>" target="_blank">
			<?php echo $this->escape($this->item->urls); ?></a>
	</span>
<?php endif; ?>
</div>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<div class="article-content">
<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>
<?php echo $this->item->text; ?>
</div>

<?php if ( intval($this->item->modified) != 0 && $this->item->params->get('show_modify_date')) : ?>
	<span class="modifydate">
		<?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	</span>
<?php endif; ?>

<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
	<a href="<?php echo $this->escape($this->item->readmore_link); ?>" title="<?php echo $this->escape($this->item->title); ?>" class="readon<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
	<?php if ($this->item->readmore_register) : ?>
		<span><?php echo JText::_('Register to read more...'); ?></span>
	<?php else : ?>
		<span><?php echo JText::_('READ MORE...'); ?></span>
	<?php endif; ?>
	</a>
<?php endif; ?>
</div>

</div>

<?php echo $this->item->event->afterDisplayContent; ?>
