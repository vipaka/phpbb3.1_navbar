<?php
/**
*
* @package phpBB Extension - Vipaka Navbar
* @copyright (c) 2014 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_NAVBAR'		=> 'Settings',
	'NAVBAR_PAGE'			=> 'Navigation',
	'NAVBAR_ENABLE'		=> 'Enable',
	'NAVBAR_DISABLE'		=> 'Disable',
	'INACTIVE'		=> 'Inactive',
	'MENU_NAV'		=> 'Menu Button',
	'MENU_BUTTON_ACTIVE_EXPLAIN'	=> 'If the button is active, it will link to another page. If it is not active, usually in the case of first tier links, it will display the text title but not be an active link.',
	'ACTIVE'	=> 'Active',
	'MENU_BUTTON_ACTIVE'		=> 'Button Active',
	'ACP_NAVBAR_TITLE'			=> 'Navigation Button Module',
	'ACP_NAVBAR_SETTINGS'					=> 'Navigation Bar Settings',
	'ACP_NAVBAR_TITLE_LINKS'					=> 'Navigation Bar Links',
	'ACP_NAVBAR_ENABLE'			=> 'Enable?',
	'ACP_MENU_ADD_BUTTON_TITLE' => 'Add Link', 
	'ACP_MENU_BUTTONS_TITLE' => 'Menu Links', 
	'ACP_NAVBAR_LINKS' => 'Links', 
	'ACP_NAVBAR_LINKED'	=> 'Active',
	'ACP_NAVBAR_SETTING_SAVED'	=> 
	'Settings have been saved successfully!', 
	'CREATE_BUTTON_EXPLAIN' => 'Click on a Link title to see all child links inside that link.',
	'MENU_BUTTON_NAME' => 'Link Title', 
	'MENU_BUTTON_URL' => 'Link Url', 
	'MENU_BUTTON_URL_EXPLAIN' => 'The url used runs from the root directory path.', 
	'MENU_BUTTON_PARENT' => 'Parent Link', 
	'MENU_BUTTON_PARENT_EXPLAIN' => 'If this new link is a second or  third tier link, select the name of the first tier parent link here. Leave blank if this link should be a parent link.', 
	'MENU_BUTTON_SUB_PARENT' => 'Sub Parent Link', 
	'MENU_BUTTON_SUB_PARENT_EXPLAIN' => 'If this  new link is a third tier link, for a 3 tiered navigation menu, put the second tier parent link name here. The second tier parent link selected must be within the correctly selected first tier parent link above. Leave blank for first and second tier links.', 
	'MENU_EXTERNAL' => 'Link Opens in New Tab', 
	'MENU_ONLY_REGISTERED' => 'Display Link for Registered Users Only', 
	'MENU_ONLY_GUEST' => 'Display Link for Guests Only', 
	'PARENT_MISMATCH' 	=> 'Sorry but the parent and sub parent links you have chosen do not match, please make sure any sub parent link chosen is within the parent link you selected', 
	'MENU_DISPLAY' => 'Display Link', 
	'MOVE_BUTTON_WITH_SUBS'	=> 'Sorry but the link you have chosen to put inside a parent link has child links associated with it. Please move these to another parent link first.', 
	'BUTTON_UPDATED' => 'You have successfully updated this link', 
	'BUTTON_ADDED'	=> 'You have successfully added a link to the navigation menu!',
	'DELETE_SUBBUTTONS_CONFIRM' => 'This link is a parent link to other links, are you sure they are moved or deleted already?',
	'DELETE_BUTTON_CONFIRM' => 'Are you sure you want to delete this link?',
	'NO_BUTTONS'	=> 'This link does not have any child links.',
	'NO_SUBBUTTONS'	=> 'This link does not have any child links.',
	'ACP_NAVBAR_PARENT' => 'Navigation Menu Parent Link BG Color', 
	'ACP_NAVBAR_SUB_PARENT' => 'Navigation Menu Child Link BG Color', 
	'ACP_NAVBAR_SUB_SUB' => 'Navigation Menu 3rd Tier Link BG Color', 
	'ACP_NAVBAR_FONT' => 'Font Family',
	'ACP_NAVBAR_COLOR' => 'Font Color',
	'ACP_NAVBAR_TYPE'	=> 'Navigation Menu Style', 
	'DROPDOWN' => 'Dropdown', 
	'SLIDER' => 'Horizontal Slider',
	'PHPBB'	=> 'Phpbb',
	));
