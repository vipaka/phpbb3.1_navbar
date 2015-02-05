<?php
/**
*
* @package phpBB Extension - Vipaka Navbar* @copyright (c) 2014 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vipaka\navbar\migrations;

class release_1_0_5 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\vipaka\navbar\migrations\release_1_0_2');
	}
	public function update_data()
	{
		return array(
			array('config.add', array('vipaka_navbar_enable', 0)),
			array('config.add', array('vipaka_navbar_type', 0)),
		);
	}
	
}
