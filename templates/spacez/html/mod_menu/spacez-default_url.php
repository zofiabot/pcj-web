<?php
/**
* @package		Templates.spacez
*
* @copyright	(C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
* @license		GNU General Public License version 2 or later; see LICENSE.txt
*
* @copyright	for changes (C) 2021 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
*/

defined('_JEXEC') or die;

use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\HTML\HTMLHelper;

$attributes = array();
$class = "";


if ($item->anchor_css)
{
	$class .= " " . $item->anchor_css;
}

if ($item->level == 1)
{
  $class .= ' nav-link';
		if ($item->deeper)
		{
		$class .= ' dropdown-toggle';
		$attributes['data-bs-toggle'] = "dropdown";
		}

}
else
{
	$class .= ' dropdown-item';
}

if ($item->anchor_title)
{
	$attributes['title'] = $item->anchor_title;
}

if ($item->anchor_rel)
{
	$attributes['rel'] = $item->anchor_rel;
}

$linktype = $item->title;

if ($item->menu_image)
{
	if ($item->menu_image_css)
	{
		$image_attributes['class'] = $item->menu_image_css;
		$linktype = HTMLHelper::_('image', $item->menu_image, $item->title, $image_attributes);
	}
	else
	{
		$linktype = HTMLHelper::_('image', $item->menu_image, $item->title);
	}

	if ($itemParams->get('menu_text', 1))
	{
		$linktype .= '<span class="image-title">' . $item->title . '</span>';
	}
	else
	{
	$linktype .= '<span class="image-title visually-hidden">' . $item->title . '</span>';
	}
}

if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
	$attributes['rel'] = 'noopener noreferrer';

	if ($item->anchor_rel == 'nofollow')
	{
		$attributes['rel'] .= ' nofollow';
	}
}
elseif ($item->browserNav == 2)
{
	$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,' . $params->get('window_open');

	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
	$class .= ' testing ';
}
$attributes['class'] = $class;
if ($item->type <> 'heading') {
echo HTMLHelper::_('link', OutputFilter::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $linktype, $attributes);
}
else {
echo HTMLHelper::_('link', '#', $linktype, $attributes);
}

