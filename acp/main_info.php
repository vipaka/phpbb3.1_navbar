<?php
/**
*
* @package phpBB Extension - Navigation Buttons 
* @copyright (c) 2014 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vipaka\navbar\acp;

class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\vipaka\navbar\acp\main_module',
			'title'		=> 'ACP_NAVBAR_TITLE',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_NAVBAR', 'auth' => 'ext_vipaka/navbar && acl_a_board', 'cat' => array('ACP_NAVBAR_TITLE')),
				'links'	=> array('title' => 'ACP_NAVBAR_LINKS', 'auth' => 'ext_vipaka/navbar && acl_a_board', 'cat' => array('ACP_NAVBAR_TITLE')),
			),
		);
	}
}
