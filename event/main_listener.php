<?php
/**
*
* @package phpBB Extension - Vipaka Navbar* @copyright (c) 2014 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vipaka\navbar\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'						=> 'load_language_on_setup',
			'core.page_header'						=> 'add_page_header_links',
		);
	}


 /* @var \phpbb\controller\helper */
  protected $helper;

  /* @var \phpbb\template\template */
  protected $template;
  protected $db;
  protected $config;
  protected $config_text;
  /**
  * Constructor
  *
  * @param \phpbb\controller\helper $helper   Controller helper object
  * @param \phpbb\template      $template Template object
  */
  public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\config\db_text $config_text)
  {
    $this->config = $config;
    $this->config_text = $config_text;
    $this->helper = $helper;
    $this->template = $template;
    $this->db = $db;
  }

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'vipaka/navbar',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function add_page_header_links($event)
	{

		global $db, $config, $user, $table_prefix;

    $data = $this->config_text->get_array(array(
      'vipaka_navbar_parent',
      'vipaka_navbar_sub_parent',
      'vipaka_navbar_sub_sub',
      'vipaka_navbar_font',
      'vipaka_navbar_color',
    ));
    define('MENU_TABLE', $table_prefix . 'navbar');
		$sql = 'SELECT *
                FROM ' . MENU_TABLE . '
                  WHERE parent = 0
                  ORDER BY button_order ASC';
        $result = $this->db->sql_query($sql);

        while ($row = $this->db->sql_fetchrow($result))
        {
	  
    		$class = 'active';
			if ( ($row['registered'] && $user->data['user_id'] == ANONYMOUS) || ($row['guest'] && $user->data['user_id'] != ANONYMOUS) )
        	{
         		 continue;
        	}

          	$this->template->assign_block_vars('buttons', array(
    			'CLASS'   => $class,
           		'ID'                => $row['id'],
           		'URL'               => $row['url'],
            	'NAME'              => $row['name'],
            	'EXTERNAL'			=> $row['external'],
            	'DISPLAY'			=> $row['display'],
              'LINKED'    => $row['linked'],
          	));
          
         	$sub_sql = 'SELECT *
                FROM ' . MENU_TABLE . '
                WHERE parent = ' . $row['id'] . '
                AND sub_parent = 0
                ORDER BY button_order ASC';
          	$sub_result = $this->db->sql_query($sub_sql);
        
          	while ($sub_row = $this->db->sql_fetchrow($sub_result))
          	{
          		if ( ($sub_row['registered'] && $user->data['user_id'] == ANONYMOUS) || ($sub_row['guest'] && $user->data['user_id'] != ANONYMOUS) )
        		{
         		 continue;
        		}
          
           		$this->template->assign_block_vars('buttons.sub', array(
              		'ID'                => $sub_row['id'],
              		'URL'               => $sub_row['url'],
              		'NAME'              => $sub_row['name'],
              		'EXTERNAL'			=> $sub_row['external'],
            		'DISPLAY'			=> $sub_row['display'],
                'LINKED'    => $sub_row['linked'],
            	));


         			$sub_sub_sql = 'SELECT *
               			FROM ' . MENU_TABLE . '
               		 WHERE parent = ' . $row['id'] . '
              		  AND sub_parent = ' . $sub_row['id'] . '
              		  ORDER BY button_order ASC';
          			$sub_sub_result = $this->db->sql_query($sub_sub_sql);
        
          			while ($sub_sub_row = $this->db->sql_fetchrow($sub_sub_result))
          			{
          				if (($sub_sub_row['registered'] && $user->data['user_id'] == ANONYMOUS) || ($sub_sub_row['guest'] && $user->data['user_id'] != ANONYMOUS) )
       					 {
         					 continue;
        				}

           				$this->template->assign_block_vars('buttons.sub.subs', array(
              				'ID'                => $sub_sub_row['id'],
              				'URL'               => $sub_sub_row['url'],
              				'NAME'              => $sub_sub_row['name'],
              				'EXTERNAL'			=> $sub_sub_row['external'],
            				'DISPLAY'			=> $sub_sub_row['display'],
                    'LINKED'    => $sub_sub_row['linked'],
            			));
  					}
  			}
  		}
  	
		$this->template->assign_vars(array(
			'U_NAVBAR_PAGE'	=> $this->helper->route('vipaka_navbar_controller', array('name' => 'navbar')),
			'MENU_ENABLED' => $config['vipaka_navbar_enable'],
      'S_NAVBAR_PARENT'   => $data['vipaka_navbar_parent'],
      'S_NAVBAR_SUB_PARENT'   => $data['vipaka_navbar_sub_parent'],
      'S_NAVBAR_SUB_SUB'   => $data['vipaka_navbar_sub_sub'],
      'S_NAVBAR_FONT'   => $data['vipaka_navbar_font'],
      'S_NAVBAR_COLOR'  => $data['vipaka_navbar_color'],
      'S_NAVBAR_TYPE'   => $config['vipaka_navbar_type'],
		));
	}
}
