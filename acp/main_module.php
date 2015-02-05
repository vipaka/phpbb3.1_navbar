<?php
/**
*
* @package phpBB Extension - Vipaka Navbar
* @copyright (c) 2014 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vipaka\navbar\acp;

class main_module
{
  protected $config_text;
  protected $request;

	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request, $table_prefix, $config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $phpbb_container;

    $this->config_text = $phpbb_container->get('config_text');
    $this->request = $request;
		$user->add_lang('acp/common');
		$this->tpl_name = 'navbar_body';
		$this->page_title = $user->lang('ACP_NAVBAR_SETTINGS');
		add_form_key('vipaka/navbar');
    
    //define('CONFIG_TEXT_TABLE', $table_prefix . 'config_text');
  
    $data = $this->config_text->get_array(array(
      'vipaka_navbar_parent',
      'vipaka_navbar_sub_parent',
      'vipaka_navbar_sub_sub',
      'vipaka_navbar_font',
      'vipaka_navbar_color',
    ));

		if ($request->is_set_post('submit_config'))
			{
				if (!check_form_key('vipaka/navbar'))
				{
				trigger_error('FORM_INVALID');
				}

        $data['vipaka_navbar_parent'] = $this->request->variable('vipaka_navbar_parent', '', true);
        $data['vipaka_navbar_sub_parent'] = $this->request->variable('vipaka_navbar_sub_parent', '', true);
        $data['vipaka_navbar_sub_sub'] = $this->request->variable('vipaka_navbar_sub_sub', '', true);
        $data['vipaka_navbar_font'] = $this->request->variable('vipaka_navbar_font', '', true);
        $data['vipaka_navbar_color'] = $this->request->variable('vipaka_navbar_color', '', true);
				$config->set('vipaka_navbar_enable', $request->variable('vipaka_navbar_enable', 0));
        $config->set('vipaka_navbar_type', $request->variable('vipaka_navbar_type', 0));

        $this->config_text->set_array(array(
          'vipaka_navbar_parent'     => $data['vipaka_navbar_parent'],
          'vipaka_navbar_sub_parent'      => $data['vipaka_navbar_sub_parent'],
          'vipaka_navbar_sub_sub'   => $data['vipaka_navbar_sub_sub'],
          'vipaka_navbar_font'    => $data['vipaka_navbar_font'],
          'vipaka_navbar_color'    => $data['vipaka_navbar_color'],
        ));

				trigger_error($user->lang('ACP_NAVBAR_SETTING_SAVED') . adm_back_link($this->u_action));
			}
		
		define('MENU_TABLE', $table_prefix . 'navbar');
		 switch($mode)
    	{
  
		case 'links':
      
        $this->page_title = $user->lang('ACP_NAVBAR_TITLE_LINKS');
        
        $action = request_var('action', '');
        $parent_id = request_var('parent_id', 0);
        $sub_parent_id = request_var('sub_parent_id', 0);
        $button_id = request_var('button_id', 0);
        
        $template->assign_vars(array(
          'S_MENU_BUTTONS'     => true,
          'S_PARENT_ID'        => $parent_id,
          'S_SUB_PARENT_ID'		=> $sub_parent_id,
        ));              
           
        switch ($action)
        {
          case "delete":
           
            if (confirm_box(true))
            {
              $sql = 'SELECT id
                        FROM ' . MENU_TABLE . '
                          WHERE parent = ' . $button_id;
              $result = $db->sql_query($sql);
              if ($db->sql_affectedrows() > 0){
 						trigger_error($user->lang['MOVE_BUTTON_WITH_SUBS'] . adm_back_link($this->u_action.'&amp;parent_id='.$parent_id), E_USER_WARNING);  
                }
             
            
            
              $sql = 'DELETE FROM ' . MENU_TABLE . '
                        WHERE id = ' . $button_id;
              $db->sql_query($sql);

              redirect($this->u_action.'&amp;parent_id='.$parent_id);
            }
            else
            {
              $sql = 'SELECT id
                        FROM ' . MENU_TABLE . '
                          WHERE parent = ' . $button_id;
              $result = $db->sql_query($sql);
              
              ( $db->sql_affectedrows() ) ? confirm_box(false, $user->lang['DELETE_SUBBUTTONS_CONFIRM']) : confirm_box(false, $user->lang['DELETE_BUTTON_CONFIRM']) ;
              
              redirect($this->u_action.'&amp;parent_id='.$parent_id);
            }
            
            break;
            
          case "add_button":  
              $submit = isset($_POST['submit']) ? true : false;
                $button_name  = request_var('button_name', '');
            
            $template->assign_vars(array(
              'S_NAME'                => $button_name,
              'S_MENU_CREATE_BUTTON'  => true,
            ));
            
            // Load buttons for select
            $sql = 'SELECT name, id
                      FROM ' . MENU_TABLE . '
                        WHERE parent = 0';
            $result = $db->sql_query($sql);
      
            while ($row = $db->sql_fetchrow($result))
            {     
              $template->assign_block_vars('parents', array(
                'ID'              => $row['id'],
                'NAME'            => $row['name'],
              ));
              		 $sql = 'SELECT name, id
                      FROM ' . MENU_TABLE . '
                        WHERE parent <> 0';
           				 $results = $db->sql_query($sql);
           				  while ($srow = $db->sql_fetchrow($results))
            			{
           					$template->assign_block_vars('sub_parents', array(
               						 'ID'              => $srow['id'],
               						 'NAME'            => $srow['name'],
              				));
           				}
            }
            $db->sql_freeresult($result);
                
           
               
            if ($submit)
            {       
              $button_url = request_var('button_url', '', true);
              $button_parent  = request_var('button_parent', 0);
              $button_sub_parent  = request_var('button_sub_parent', 0);
              $button_external  = request_var('button_external', 0);
              $button_display = request_var('button_display', 1);
              $button_only_registered = request_var('button_only_registered', 0);
              $button_only_guest  = request_var('button_only_guest', 0);  
              $button_linked  = request_var('button_linked', 0);  
            	
               if ($button_sub_parent != 0){
              	 $sql = 'SELECT parent
              	 		FROM ' . MENU_TABLE . '
              	 		WHERE id = ' . $button_sub_parent;
              	 		$result = $db->sql_query($sql);
              	 		$brow = $db->sql_fetchrow($result);
              	 		if ($brow['parent'] != $button_parent){
              	 			trigger_error($user->lang['PARENT_MISMATCH'] . adm_back_link($this->u_action.'&amp;parent_id='.$parent_id), E_USER_WARNING); 
              	 		}
              }
           
             $insert_array = array(
                'name' => $button_name,
                  'parent' => $button_parent,
                  'sub_parent'	=> $button_sub_parent,
                  'external' 	=> $button_external,
                  'registered'	=> $button_only_registered,
                  'guest'		=> $button_only_guest,
                  'display'		=> $button_display,
                  'linked'    => $button_linked,
                    'button_order' => 0,
                  'url' => $button_url,
              );
      $sql = "INSERT INTO " . MENU_TABLE . " " . $db->sql_build_array('INSERT', $insert_array);
      $db->sql_query($sql);

              trigger_error($user->lang['BUTTON_ADDED'] . adm_back_link($this->u_action.'&amp;parent_id='.$button_parent));
            }
            
            break;      
            
          case "edit_button":

            // Load buttons for select
            $sql = 'SELECT name, id
                      FROM ' . MENU_TABLE . '
                        WHERE parent = 0
                          AND id <> ' . $button_id;
            $result = $db->sql_query($sql);
      
            while ($row = $db->sql_fetchrow($result))
            {     
              $template->assign_block_vars('parents', array(
                'ID'              => $row['id'],
                'NAME'            => $row['name'],
              ));
            
              		 $sql = 'SELECT name, id
                      FROM ' . MENU_TABLE . '
                        WHERE parent <> 0';
           				 $results = $db->sql_query($sql);
           				  while ($srow = $db->sql_fetchrow($results))
            			{
           					$template->assign_block_vars('sub_parents', array(
               						 'ID'              => $srow['id'],
               						 'NAME'            => $srow['name'],
              				));
           				}
            }
            $db->sql_freeresult($result);

            $sql = 'SELECT *
                      FROM ' . MENU_TABLE . '
                        WHERE id = ' . $button_id;
            $result = $db->sql_query($sql);
            $row = $db->sql_fetchrow($result);
      
            $template->assign_vars(array(
              'S_URL'                       => $row['url'],
              'L_ACP_MENU_EDIT_BUTTON'      => $user->lang['ACP_MENU_EDIT_BUTTON'] . ' » ' . $row['name'],
              'S_NAME'                      => $row['name'],
              'S_PARENT'                    => $row['parent'],
              'S_SUB_PARENT'				=> $row['sub_parent'],
              'S_EXTERNAL'					=> $row['external'],
              'S_LINKED'          => $row['linked'],
              'S_ONLY_GUEST'				=> $row['guest'],
              'S_ONLY_REGISTERED'			=> $row['registered'],
              'S_DISPLAY'					=> $row['display'],
              'S_MENU_EDIT_BUTTON'          => true,
            ));
            $db->sql_freeresult($result);
              
            $submit = (isset($_POST['submit'])) ? true : false;
            
            if ($submit)
            {
              $button_url = request_var('button_url', '', true);
              $button_name  = request_var('button_name', '', true);
              $button_parent  = request_var('button_parent', 0);
              $button_sub_parent  = request_var('button_sub_parent', 0);
              $button_external  = request_var('button_external', 0);
              $button_display = request_var('button_display', 1);
              $button_linked = request_var('button_linked', 1);
              $button_only_registered = request_var('button_only_registered', 0);
              $button_only_guest  = request_var('button_only_guest', 0);  
            	
              if ($button_parent && !$row['parent'])
              {
                $sql = 'SELECT id
                        FROM ' . MENU_TABLE . '
                          WHERE parent = ' . $button_id;
                $result = $db->sql_query($sql);
                
                if ( $db->sql_affectedrows() )
                {
                  trigger_error($user->lang['MOVE_BUTTON_WITH_SUBS'] . adm_back_link($this->u_action.'&amp;parent_id='.$parent_id), E_USER_WARNING);  
                }
              }
              if ($button_sub_parent != 0){
              	 $sql = 'SELECT parent
              	 		FROM ' . MENU_TABLE . '
              	 		WHERE id = ' . $button_sub_parent;
              	 		$result = $db->sql_query($sql);
              	 		$brow = $db->sql_fetchrow($result);
              	 		if ($brow['parent'] != $button_parent){
              	 			trigger_error($user->lang['PARENT_MISMATCH'] . adm_back_link($this->u_action.'&amp;parent_id='.$parent_id), E_USER_WARNING); 
              	 		}
              }
           
              $sql = 'UPDATE ' . MENU_TABLE . '
                        SET linked = "' . (int) $button_linked . '", url = "' . $button_url . '", name = "' . $button_name . '", sub_parent = "' . $button_sub_parent . '", external = "' . $button_external . '", registered = "' . $button_only_registered . '", guest = "' . $button_only_guest . '", display = "' . $button_display . '", parent = ' . $button_parent . '
                          WHERE id = ' . $button_id;
              $db->sql_query($sql);
  
              trigger_error($user->lang['BUTTON_UPDATED'] . adm_back_link($this->u_action.'&amp;parent_id='.$button_parent));
            }
            
            break;
            
          case 'move_up':
          	 $sql = 'SELECT button_order
                      FROM ' . MENU_TABLE . '
                        WHERE id = ' . (int) $button_id;
            $result = $db->sql_query($sql);
            $row = $db->sql_fetchrow($result);

            $sql = 'UPDATE ' . MENU_TABLE . '
            		SET button_order = ' . $row['button_order'] . '
            		WHERE button_order = ' . $row['button_order'] . ' - 1';
            		$db->sql_query($sql);
            $sql = 'UPDATE ' . MENU_TABLE . '
            		SET button_order = ' . $row['button_order'] . ' - 1
            		WHERE id = ' . (int) $button_id;
            		$db->sql_query($sql);	
            	 redirect($this->u_action.'&amp;parent_id='.$parent_id);
          case 'move_down':
          
            $sql = 'SELECT button_order
                      FROM ' . MENU_TABLE . '
                        WHERE id = ' . (int) $button_id;
            $result = $db->sql_query($sql);
            $row = $db->sql_fetchrow($result);
             $sql = 'UPDATE ' . MENU_TABLE . '
            		SET button_order = ' . $row['button_order'] . '
            		WHERE button_order = ' . $row['button_order'] . ' + 1';
            		$db->sql_query($sql);
            $sql = 'UPDATE ' . MENU_TABLE . '
            		SET button_order = ' . $row['button_order'] . ' + 1
            		WHERE id = ' . (int) $button_id;
            		$db->sql_query($sql);		
            
            
            redirect($this->u_action.'&amp;parent_id='.$parent_id);
            
          break;
      
          default:

          if ($sub_parent_id > 0){
          		 $sql = 'SELECT *
                      FROM ' . MENU_TABLE . '
                        WHERE sub_parent = ' . $sub_parent_id . '
                        ORDER BY button_order ASC';
            	$result = $db->sql_query($sql);
          	}
          	else if ($parent_id > 0){
          		 $sql = 'SELECT *
                      FROM ' . MENU_TABLE . '
                        WHERE sub_parent = 0
                        AND parent = ' . $parent_id . '
                        ORDER BY button_order ASC';
           	 $result = $db->sql_query($sql);
          	}
          
           else{
           	 $sql = 'SELECT *
                      FROM ' . MENU_TABLE . '
                        WHERE parent = ' . $parent_id . '
                        ORDER BY button_order ASC';
           	 $result = $db->sql_query($sql);
           }
      
            while ($row = $db->sql_fetchrow($result))
            {

            	if ($row['parent'] == 0){
            		$new_path = '&amp;action=&amp;parent_id='.$row['id'];
            	}
            	else if ($row['sub_parent'] == 0){
            		$new_path = '&amp;action=&amp;parent_id='.$row['id'] . '&amp;sub_parent_id='.$row['id'];
            	}
            	else {
            		$new_path = '&amp;action=&amp;parent_id='.$row['parent'].'&amp;button_id=' . $row['id'];
            	}
              $template->assign_block_vars('buttons', array(
                'ID'              => $row['id'],
                'NAME'            => $row['name'],
                'URL'             => $row['url'],
                'U_OPEN'          => $this->u_action . $new_path,
                'U_DELETE'        => ($row['parent'] == 0) ? $this->u_action . '&amp;action=delete&amp;parent_id=0&amp;button_id=' . $row['id'] : $this->u_action . '&amp;action=delete&amp;parent_id='.$row['parent'].'&amp;button_id=' . $row['id'],
                'U_EDIT'          => ($row['parent'] == 0) ? $this->u_action . '&amp;action=edit_button&amp;parent_id=0&amp;button_id=' . $row['id'] : $this->u_action . '&amp;action=edit_button&amp;parent_id='.$row['parent'].'&amp;button_id=' . $row['id'],
                'U_MOVE_UP'       => ($row['parent'] == 0) ? $this->u_action . '&amp;action=move_up&amp;parent_id=0&amp;button_id=' . $row['id'] : $this->u_action . '&amp;action=move_up&amp;parent_id='.$row['parent'].'&amp;button_id=' . $row['id'],
                'U_MOVE_DOWN'     => ($row['parent'] == 0) ? $this->u_action . '&amp;action=move_down&amp;parent_id=0&amp;button_id=' . $row['id'] : $this->u_action . '&amp;action=move_down&amp;parent_id='.$row['parent'].'&amp;button_id=' . $row['id'],
              ));
			

            }
            $db->sql_freeresult($result);
            
            $submit = (isset($_POST['submit'])) ? true : false;
             
            if ($submit)
            {          
              $button_name = request_var('name', '', true);
              redirect($this->u_action . '&amp;action=add_button&amp;parent_id='. $parent_id.'&amp;sub_parent_id='. $sub_parent_id.'&amp;button_name='.$button_name);
            }  
            
            
            $button_nav = $user->lang['MENU_NAV'];
            
            if ($parent_id)
            {
              $sql = 'SELECT name
                      FROM ' . MENU_TABLE . '
                        WHERE id = ' . $parent_id;
              $result = $db->sql_query($sql);  
              
              $button_nav .= ' » ' .$db->sql_fetchfield('button_name');
            }
                 
            $template->assign_vars(array(
              'S_MENU_BUTTONS_LIST'           => true,
              'S_BUTTONS_NAV'                 => $button_nav,
            ));
      }

      break;
      	}

		$template->assign_vars(array(
			'U_ACTION'				=> $this->u_action,
			'VIPAKA_NAVBAR_ENABLE'		=> $config['vipaka_navbar_enable'],
      'S_NAVBAR_PARENT'   => $data['vipaka_navbar_parent'],
      'S_NAVBAR_SUB_PARENT'   => $data['vipaka_navbar_sub_parent'],
      'S_NAVBAR_SUB_SUB'   => $data['vipaka_navbar_sub_sub'],
      'S_NAVBAR_FONT'   => $data['vipaka_navbar_font'],
      'S_NAVBAR_COLOR'   => $data['vipaka_navbar_color'],
      'S_NAVBAR_TYPE'   => $config['vipaka_navbar_type'],
		));
	}
}
