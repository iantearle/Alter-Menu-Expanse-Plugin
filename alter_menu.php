<?php
/*
Plugin Name: AlterMenu
Plugin URL: http://dreamscapecms.com/
Description: Adds the "Mass Upload" and "Send Newsletter" links to your admin menu for easier navigation. This could be incorporated into Dreamscape's core, but is left as a plugin to serve as a model and in case you wish to alter the menu further.
Version: 2.0
Author: Mr. Nate Cavanaugh and Mr. Ryan Miglavs
Author URL: http://dreamscapecms.com/
*/
/*  Add the action to the menu html   //-------------------------------*/
	ozone_action('admin_menu_html', 'alter_menu', 10, 2);
	
/* Should return the $menu_html as a string. 
 * Accepts as params the current menu html 
 * and the array of objects that make up the menu.
 * @param string $menu_html
 * @param array $menu_list
 * @return string $menu_html
 */
function alter_menu($menu_html,$menu_list){
	$menu_html = format_altered_menu($menu_list);
	return $menu_html;
	}
/* Custom function for iterating over the menu_list array 
 * and recrafting the menu with our custom link
 * @param array $menu_list
 * @return string $menu
 */
function format_altered_menu($menu_list){
	//The L_ constants are from the language file, but they could be any text you like
	$menu_add = L_MENU_ADD;
	$menu_edit = L_MENU_EDIT;
	$menu_mass_upload = L_MENU_MASS_UPLOAD;
	$menu_send_newsletter = L_MENU_SEND_NEWSLETTER;
	$menu_sep = L_MENU_SEPARATOR;
	$menu = '<ul>';
	foreach($menu_list as $val){
		if($val->cat_type == 'gallery'){
			$menu .= '<li><h2>' . ucwords($val->sectionname) . '</h2>
			<div class="menu_links">
			<a href="index.php?type=add&amp;cat_id=' . $val->id . '">'.$menu_add.'</a>'.$menu_sep.'<a href="index.php?type=edit&amp;cat_id=' . $val->id . '">'.$menu_edit.'</a><br /><a href="index.php?type=add&amp;cat_id=' . $val->id . '&amp;upload=mass">'.$menu_mass_upload.'</a>
</div>
</li>';
			} elseif ($val->cat_type == 'newsletter') {
				$menu .= '<li><h2>' . ucwords($val->sectionname) . '</h2>
				<div class="menu_links">
				<a href="index.php?type=add&amp;cat_id=' . $val->id . '">'.$menu_add.'</a>'.$menu_sep.'<a href="index.php?type=edit&amp;cat_id=' . $val->id . '">'.$menu_edit.'</a><br /><a href="index.php?type=add&amp;cat_id=' . $val->id . '&amp;action=write">'.$menu_send_newsletter.'</a>
</div>
</li>';
			} else {
				$menu .= '<li><h2>' . ucwords($val->sectionname) . '</h2>
				<div class="menu_links">
				<a href="index.php?type=add&amp;cat_id=' . $val->id . '">'.$menu_add.'</a>'.$menu_sep.'<a href="index.php?type=edit&amp;cat_id=' . $val->id . '">'.$menu_edit.'</a>
</div>
</li>';
			}
		}
	$menu .= '</ul>';
	return $menu;
}