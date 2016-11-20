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

<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
<?php
	// Add span to module title
	$title = $this->escape($this->params->get('page_title'));
	$pos = strpos($title, ' ');
	if ( $pos !== false ) { $title = "<span><span>" . substr($title, 0, $pos+1) . "</span></span>" . substr($title, $pos+1); }
	else { $title = "<span><span>" . $title . "</span></span>"; }
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
<span><?php echo $title; ?></span></div>
<?php endif; ?>

<?php if (($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) && !$this->print) : ?>
<div class="contentpaneopen_edit<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>" >
	<?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
</div>
<?php endif; ?>

<?php if ($this->params->get('show_title',1)) : ?>
<h2 class="contentheading<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?> clearfix">
	<?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
	<a href="<?php echo $this->article->readmore_link; ?>" class="contentpagetitle<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">
		<?php echo $this->escape(isset($this->article->page_title)?$this->article->page_title:$this->article->title); ?>
	</a>
	<?php else : ?>
		<?php echo $this->escape(isset($this->article->page_title)?$this->article->page_title:$this->article->title); ?>
	<?php endif; ?>
<?php endif; ?>
</h2>

<?php  if (!$this->params->get('show_intro')) :
	echo $this->article->event->afterDisplayTitle;
endif; ?>

<?php
if (
($this->params->get('show_create_date'))
|| (($this->params->get('show_author')) && ($this->article->author != ""))
|| (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid))
|| ($this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon'))
|| ($this->params->get('show_url') && $this->article->urls)
) :
?>
<div class="article-tools clearfix">
	<div class="article-meta">
	<?php if ($this->params->get('show_create_date')) : ?>
		<span class="createdate">
			<?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC2')) ?>
		</span>
	<?php endif; ?>

	<?php if (($this->params->get('show_author')) && ($this->article->author != "")) : ?>
		<span class="createby">
			<?php $this->escape(JText::printf(($this->escape($this->article->created_by_alias) ? $this->escape($this->article->created_by_alias) : $this->escape($this->article->author)) )); ?>
		</span>
	<?php endif; ?>


	<?php if (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid)) : ?>
		<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section)) : ?>
		<span class="article-section">
			<?php if ($this->params->get('link_section')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->escape($this->article->section); ?>
			<?php if ($this->params->get('link_section')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
				<?php if ($this->params->get('show_category')) : ?>
				<?php echo ' - '; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
		<?php if ($this->params->get('show_category') && $this->article->catid) : ?>
		<span class="article-section">
			<?php if ($this->params->get('link_category')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->escape($this->article->category); ?>
			<?php if ($this->params->get('link_category')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
	<?php endif; ?>
	</div>
	
	<?php if ($this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
	<div class="buttonheading">
		<?php if (!$this->print) : ?>
			<?php if ($this->params->get('show_email_icon')) : ?>
			<span class="ja-button-email">
			<?php echo JHTML::_('icon.email',  $this->article, $this->params, $this->access); ?>
			</span>
			<?php endif; ?>

			<?php if ( $this->params->get( 'show_print_icon' )) : ?>
			<span class="ja-button-print">
			<?php echo JHTML::_('icon.print_popup',  $this->article, $this->params, $this->access); ?>
			</span>
			<?php endif; ?>

			<?php if ($this->params->get('show_pdf_icon')) : ?>
			<span class="ja-button-pdf">
			<?php echo JHTML::_('icon.pdf',  $this->article, $this->params, $this->access); ?>
			</span>
			<?php endif; ?>
		<?php else : ?>
			<span>
			<?php echo JHTML::_('icon.print_screen',  $this->article, $this->params, $this->access); ?>
			</span>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_url') && $this->article->urls) : ?>
		<span class="article-url">
			<a href="http://<?php echo $this->escape($this->article->urls) ; ?>" target="_blank">
				<?php echo $this->escape($this->article->urls); ?></a>
		</span>
	<?php endif; ?>
	
</div>
<?php endif; ?>

<?php echo $this->article->event->beforeDisplayContent; ?>

<div class="article-content">
<?php if (isset ($this->article->toc)) : ?>
	<?php echo $this->article->toc; ?>
<?php endif; ?>
<?php echo $this->article->text; ?>
</div>

<?php if ( intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
	<span class="modifydate">
		<?php JText::sprintf('LAST_UPDATED2', $this->escape(JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2')))); ?>
	</span>
<?php endif; ?>

<?php echo $this->article->event->afterDisplayContent; ?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="headerbody"><a href="http://kaz-news.ru" title="http://kaz-news.ru" target="_blank">kaz-news.ru</a> | <a href="http://ekhut.ru" title="http://ekhut.ru" target="_blank">ekhut.ru</a> | <a href="http://omsk-media.ru" title="http://omsk-media.ru" target="_blank">omsk-media.ru</a> | <a href="http://samara-press.ru" title="http://samara-press.ru" target="_blank">samara-press.ru</a> | <a href="http://ufa-press.ru" title="http://ufa-press.ru" target="_blank">ufa-press.ru</a> </div>