<?php
/**
 * @package    Joomla.Administrator
 *
 * @copyright  Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Utility class for the button bar.
 *
 * @package  Joomla.Administrator
 * @since    1.5
 */
abstract class JToolbarHelper
{
	/**
	 * Title cell.
	 * For the title and toolbar to be rendered correctly,
	 * this title fucntion must be called before the starttable function and the toolbars icons
	 * this is due to the nature of how the css has been used to postion the title in respect to the toolbar.
	 *
	 * @param   string  $title  The title.
	 * @param   string  $icon   The space-separated names of the image.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function title($title, $icon = 'generic.png')
	{
		// Strip the extension.
		$icons = explode(' ', $icon);
		foreach ($icons as &$icon)
		{
			$icon = 'icon-48-' . preg_replace('#\.[^.]*$#', '', $icon);
		}

		$html = '<div class="pagetitle ' . htmlspecialchars(implode(' ', $icons)) . '"><h2>' . $title . '</h2></div>';

		$app = JFactory::getApplication();
		$app->JComponentTitle = $html;
	}

	/**
	 * Writes a spacer cell.
	 *
	 * @param   string  $width  The width for the cell
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function spacer($width = '')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a spacer.
		$bar->appendButton('Separator', 'spacer', $width);
	}

	/**
	 * Writes a divider between menu buttons
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function divider()
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a divider.
		$bar->appendButton('Separator', 'divider');
	}

	/**
	 * Writes a custom option and task button for the button bar.
	 *
	 * @param   string  $task        The task to perform (picked up by the switch($task) blocks.
	 * @param   string  $icon        The image to display.
	 * @param   string  $iconOver    The image to display when moused over.
	 * @param   string  $alt         The alt text for the icon image.
	 * @param   bool    $listSelect  True if required to check that a standard list item is checked.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function custom($task = '', $icon = '', $iconOver = '', $alt = '', $listSelect = true)
	{
		$bar = JToolbar::getInstance('toolbar');

		// Strip extension.
		$icon = preg_replace('#\.[^.]*$#', '', $icon);

		// Add a standard button.
		$bar->appendButton('Standard', $icon, $alt, $task, $listSelect);
	}

	/**
	 * Writes a preview button for a given option (opens a popup window).
	 *
	 * @param   string  $url            The name of the popup file (excluding the file extension)
	 * @param   bool    $updateEditors
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function preview($url = '', $updateEditors = false)
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a preview button.
		$bar->appendButton('Popup', 'preview', 'Preview', $url.'&task=preview');
	}

	/**
	 * Writes a preview button for a given option (opens a popup window).
	 *
	 * @param   string  $ref        The name of the popup file (excluding the file extension for an xml file).
	 * @param   bool    $com        Use the help file in the component directory.
	 * @param   string  $override   Use this URL instead of any other
	 * @param   string  $component  Name of component to get Help (null for current component)
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function help($ref, $com = false, $override = null, $component = null)
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a help button.
		$bar->appendButton('Help', $ref, $com, $override, $component);
	}

	/**
	 * Writes a cancel button that will go back to the previous page without doing
	 * any other operation.
	 *
	 * @param   string  $alt   Alternative text.
	 * @param   string  $href  URL of the href attribute.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function back($alt = 'JTOOLBAR_BACK', $href = 'javascript:history.back();')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a back button.
		$bar->appendButton('Link', 'back', $alt, $href);
	}

	/**
	 * Writes a media_manager button.
	 *
	 * @param   string  $directory  The sub-directory to upload the media to.
	 * @param   string  $alt        An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function media_manager($directory = '', $alt = 'JTOOLBAR_UPLOAD')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an upload button.
		$bar->appendButton('Popup', 'upload', $alt, 'index.php?option=com_media&tmpl=component&task=popupUpload&folder=' . $directory, 800, 520);
	}

	/**
	 * Writes a common 'default' button for a record.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function makeDefault($task = 'default', $alt = 'JTOOLBAR_DEFAULT')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a default button.
		$bar->appendButton('Standard', 'star', $alt, $task, true);
	}

	/**
	 * Writes a common 'assign' button for a record.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function assign($task = 'assign', $alt = 'JTOOLBAR_ASSIGN')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an assign button.
		$bar->appendButton('Standard', 'assign', $alt, $task, true);
	}

	/**
	 * Writes the common 'new' icon for the button bar.
	 *
	 * @param   string   $task   An override for the task.
	 * @param   string   $alt    An override for the alt text.
	 * @param   boolean  $check  True if required to check that a standard list item is checked.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function addNew($task = 'add', $alt = 'JTOOLBAR_NEW', $check = false)
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a new button.
		$bar->appendButton('Standard', 'new', $alt, $task, $check);
	}

	/**
	 * Writes a common 'publish' button.
	 *
	 * @param   string   $task   An override for the task.
	 * @param   string   $alt    An override for the alt text.
	 * @param   boolean  $check  True if required to check that a standard list item is checked.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function publish($task = 'publish', $alt = 'JTOOLBAR_PUBLISH', $check = false)
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a publish button.
		$bar->appendButton('Standard', 'publish', $alt, $task, $check);
	}

	/**
	 * Writes a common 'publish' button for a list of records.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function publishList($task = 'publish', $alt = 'JTOOLBAR_PUBLISH')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a publish button (list).
		$bar->appendButton('Standard', 'publish', $alt, $task, true);
	}

	/**
	 * Writes a common 'unpublish' button.
	 *
	 * @param   string   $task   An override for the task.
	 * @param   string   $alt    An override for the alt text.
	 * @param   boolean  $check  True if required to check that a standard list item is checked.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function unpublish($task = 'unpublish', $alt = 'JTOOLBAR_UNPUBLISH', $check = false)
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an unpublish button
		$bar->appendButton('Standard', 'unpublish', $alt, $task, $check);
	}

	/**
	 * Writes a common 'unpublish' button for a list of records.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function unpublishList($task = 'unpublish', $alt = 'JTOOLBAR_UNPUBLISH')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an unpublish button (list).
		$bar->appendButton('Standard', 'unpublish', $alt, $task, true);
	}

	/**
	 * Writes a common 'archive' button for a list of records.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function archiveList($task = 'archive', $alt = 'JTOOLBAR_ARCHIVE')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an archive button.
		$bar->appendButton('Standard', 'archive', $alt, $task, true);
	}

	/**
	 * Writes an unarchive button for a list of records.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function unarchiveList($task = 'unarchive', $alt = 'JTOOLBAR_UNARCHIVE')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an unarchive button (list).
		$bar->appendButton('Standard', 'unarchive', $alt, $task, true);
	}

	/**
	 * Writes a common 'edit' button for a list of records.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function editList($task = 'edit', $alt = 'JTOOLBAR_EDIT')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an edit button.
		$bar->appendButton('Standard', 'edit', $alt, $task, true);
	}

	/**
	 * Writes a common 'edit' button for a template html.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function editHtml($task = 'edit_source', $alt = 'JTOOLBAR_EDIT_HTML')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an edit html button.
		$bar->appendButton('Standard', 'edithtml', $alt, $task, true);
	}

	/**
	 * Writes a common 'edit' button for a template css.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function editCss($task = 'edit_css', $alt = 'JTOOLBAR_EDIT_CSS')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an edit css button (hide).
		$bar->appendButton('Standard', 'editcss', $alt, $task, true);
	}

	/**
	 * Writes a common 'delete' button for a list of records.
	 *
	 * @param   string  $msg   Postscript for the 'are you sure' message.
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function deleteList($msg = '', $task = 'remove', $alt = 'JTOOLBAR_DELETE')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a delete button.
		if ($msg)
		{
			$bar->appendButton('Confirm', $msg, 'delete', $alt, $task, true);
		}
		else
		{
			$bar->appendButton('Standard', 'delete', $alt, $task, true);
		}
	}

	/**
	 * Write a trash button that will move items to Trash Manager.
	 *
	 * @param   string  $task   An override for the task.
	 * @param   string  $alt    An override for the alt text.
	 * @param   bool    $check
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function trash($task = 'remove', $alt = 'JTOOLBAR_TRASH', $check = true)
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a trash button.
		$bar->appendButton('Standard', 'trash', $alt, $task, $check, false);
	}

	/**
	 * Writes a save button for a given option.
	 * Apply operation leads to a save action only (does not leave edit mode).
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function apply($task = 'apply', $alt = 'JTOOLBAR_APPLY')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add an apply button
		$bar->appendButton('Standard', 'apply', $alt, $task, false);
	}

	/**
	 * Writes a save button for a given option.
	 * Save operation leads to a save and then close action.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function save($task = 'save', $alt = 'JTOOLBAR_SAVE')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a save button.
		$bar->appendButton('Standard', 'save', $alt, $task, false);
	}

	/**
	 * Writes a save and create new button for a given option.
	 * Save and create operation leads to a save and then add action.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	public static function save2new($task = 'save2new', $alt = 'JTOOLBAR_SAVE_AND_NEW')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a save and create new button.
		$bar->appendButton('Standard', 'save-new', $alt, $task, false);
	}

	/**
	 * Writes a save as copy button for a given option.
	 * Save as copy operation leads to a save after clearing the key,
	 * then returns user to edit mode with new key.
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	public static function save2copy($task = 'save2copy', $alt = 'JTOOLBAR_SAVE_AS_COPY')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a save and create new button.
		$bar->appendButton('Standard', 'save-copy', $alt, $task, false);
	}

	/**
	 * Writes a checkin button for a given option.
	 *
	 * @param   string   $task   An override for the task.
	 * @param   string   $alt    An override for the alt text.
	 * @param   boolean  $check  True if required to check that a standard list item is checked.
	 *
	 * @return  void
	 *
	 * @since   1.7
	 */
	public static function checkin($task = 'checkin', $alt = 'JTOOLBAR_CHECKIN', $check = true)
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a save and create new button.
		$bar->appendButton('Standard', 'checkin', $alt, $task, $check);
	}

	/**
	 * Writes a cancel button and invokes a cancel operation (eg a checkin).
	 *
	 * @param   string  $task  An override for the task.
	 * @param   string  $alt   An override for the alt text.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function cancel($task = 'cancel', $alt = 'JTOOLBAR_CANCEL')
	{
		$bar = JToolbar::getInstance('toolbar');

		// Add a cancel button.
		$bar->appendButton('Standard', 'cancel', $alt, $task, false);
	}

	/**
	 * Writes a configuration button and invokes a cancel operation (eg a checkin).
	 *
	 * @param   string  $component  The name of the component, eg, com_content.
	 * @param   int     $height     The height of the popup. [UNUSED]
	 * @param   int     $width      The width of the popup. [UNUSED]
	 * @param   string  $alt        The name of the button.
	 * @param   string  $path       An alternative path for the configuation xml relative to JPATH_SITE.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public static function preferences($component, $height = '550', $width = '875', $alt = 'JToolbar_Options', $path = '')
	{
		$component = urlencode($component);
		$path = urlencode($path);
		$bar = JToolBar::getInstance('toolbar');

		// Add a button linking to config for component.
		$bar->appendButton('Link', 'options', $alt, 'index.php?option=com_config&amp;view=component&amp;component=' . $component . '&amp;path=' . $path);
	}
}

/**
 * Utility class for the submenu.
 *
 * @package  Joomla.Administrator
 * @since    1.5
 */
abstract class JSubMenuHelper
{
	/**
	 * Method to add a menu item to submenu.
	 *
	 * @param	string	$name	Name of the menu item.
	 * @param	string	$link	URL of the menu item.
	 * @param	bool	True if the item is active, false otherwise.
	 *
	 * @since    1.5
	 */
	public static function addEntry($name, $link = '', $active = false)
	{
		$menu = JToolbar::getInstance('submenu');
		$menu->appendButton($name, $link, $active);
	}
}