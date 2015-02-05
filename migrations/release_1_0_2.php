<?php
/**
*
* @package phpBB Extension - Vipaka Navbar* @copyright (c) 2014 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vipaka\navbar\migrations;

class release_1_0_2 extends \phpbb\db\migration\migration
{
	public function update_schema()
	{
		return array(
			'add_tables'		=> array(
				$this->table_prefix . 'navbar'	=> array(
					'COLUMNS'		=> array(
						'id'			=> array('UINT', null, 'auto_increment'),
						'name'			=> array('VCHAR:255', ''),
						'parent'			=> array('UINT', 0),	
						'sub_parent'		=> array('UINT', 0),			
						'button_order'			=> array('UINT', 0),				
						'url'			=> array('VCHAR:255', ''),
						'guest'			=> array('UINT', 0),
						'registered'	=> array('UINT', 0),
						'display'		=> array('UINT', 0),
						'external'		=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'id',
				),
			),
		);
	}
	public function update_data()
	{
		return array(
			array('config_text.add', array('vipaka_navbar_parent', '')),
			array('config_text.add', array('vipaka_navbar_sub_parent', '')),
			array('config_text.add', array('vipaka_navbar_sub_sub', '')),
			array('config_text.add', array('vipaka_navbar_font', '')),
			array('config_text.add', array('vipaka_navbar_color', '')),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_NAVBAR_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_NAVBAR_TITLE',
				array(
					'module_basename'	=> '\vipaka\navbar\acp\main_module',
					'modes'				=> array('settings', 'links'),
				),
			)),
		);
	}
	

	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'config'	=> array(
					'vipaka_navbar_enable',
				),
			),
		);
		return array(
			
			'drop_tables'		=> array(
				$this->table_prefix . 'navbar',
			),
		);
	}
}
