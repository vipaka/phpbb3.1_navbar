<?php
/**
*
* @package phpBB Extension - Vipaka Navbar* @copyright (c) 2014 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vipaka\navbar\migrations;

class release_1_0_6 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\vipaka\navbar\migrations\release_1_0_5');
	}
	public function update_schema()
	{
		return array(
      		'add_columns'        => array(
         		$this->table_prefix . 'navbar'        => array(
           		 'linked'    => array('UINT', 0),
         			),
      			),
   		);
	}
	public function update_data()
	{
		  return array(
       		 array('custom', array(array($this, 'my_special_table_update'))),
   		 );	
	}
	public function my_special_table_update()
	{
    	$sql_ary = array(
        		'name' => 'Default',
        		'url' => './index.php',
        		'display' => 1,
        );
			 

   		 $sql = 'INSERT INTO ' . $this->table_prefix . 'navbar' . $this->db->sql_build_array('INSERT', $sql_ary);
   		 $this->sql_query($sql);
	} 
	
}
