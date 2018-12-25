<?php

// require_once LSSE_PLUGIN_DIR . '/admin/includes/admin-functions.php';
// require_once LSSE_PLUGIN_DIR . '/admin/includes/help-tabs.php';
// require_once LSSE_PLUGIN_DIR . '/admin/includes/tag-generator.php';
// require_once LSSE_PLUGIN_DIR . '/admin/includes/welcome-panel.php';

if( is_admin() ) {
    /*  利用 admin_menu 钩子，添加菜单 */
    // add_action('admin_menu', 'display_copyright_menu');
}

function display_copyright_menu() {
    /* add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);  */
    /* 页名称，菜单名称，访问级别，菜单别名，点击该菜单时的回调函数（用以显示设置页面） */
    add_options_page('Set Copyright', 'Copyright Menu', 'administrator','display_copyright', 'display_copyright_html_page');
}
/*
//显示主菜单和子菜单

function fengxl_admin_fstmenu()
{
    add_menu_page(__('主菜单'),__('主菜单测试'),8,__FILE__,'my_function_menu');
    add_submenu_page(__FILE__,'子菜单1','子菜单测试1',8,'your-admin-sub-menu1','my_function_submenu1');
    add_submenu_page(__FILE__,'子菜单2','子菜单测试2',8,'your-admin-sub-menu2','my_function_submenu2');
    add_submenu_page(__FILE__,'子菜单3','子菜单测试3',8,'your-admin-sub-menu3','my_function_submenu3');

}
function my_function_menu()
{

  echo "<h2>主菜单设置</h2>";
}
function my_function_submenu1()
{

   echo "<h2>子菜单设置一</h2>";
}
function my_function_submenu2()
{

    echo "<h2>子菜单设置二</h2>";
}
function my_function_submenu3()
{

    echo "<h2>子菜单设置三</h2>";
}
add_action('admin_menu','fengxl_admin_fstmenu');

//在WordPress后台外观菜单里面显示一个子菜单出来

function fengxl_admin_menu() {
  add_theme_page(__('插件设置'), __('插件设置'), 8, 'your-unique-identifier', 'fengxl_plugin_options');
}

function fengxl_plugin_options() {
  echo '<div class="wrap">';
  echo '<p>这儿就是插件设置的地方.</p>';
  echo '</div>';
}

add_action('admin_menu', 'fengxl_admin_menu');

//在WordPress后台仪表盘处显示一个子菜单出来

add_action('admin_menu', 'my_plugin_menu1');

function my_plugin_menu1() {
	add_dashboard_page('仪表盘设置', '仪表盘设置', 'read', 'my-unique-identifier', 'my_plugin_function1');
}
function my_plugin_function1() {
  echo '<div>';
  echo '<p>这儿就是仪表盘菜单设置的地方.</p>';
  echo '</div>';
}

//在WordPress后台评论处显示一个子菜单出来

add_action('admin_menu', 'my_plugin_menu2');

function my_plugin_menu2() {
	add_comments_page('评论菜单', '我的评论', 'read', 'my-unique-identifier', 'my_plugin_function2');
}
function my_plugin_function2() {
  echo '<div>';
  echo '<p>这儿就是评论菜单设置的地方.</p>';
  echo '</div>';
}*/
//以上介绍了不同的显示方法和显示位置。除此之外还有

//add_posts_page(),在文章处添加子菜单

//add_media_page(),在媒体处添加子菜单

//add_links_page(),在链接处添加子菜单

//add_pages_page(),在页面处添加子菜单

//add_plugins_page(),在插件处添加子菜单

//add_users_page(), 在用户处添加子菜单

//add_management_page(), 在工具处添加子菜单

//add_options_page(),在设置处添加子菜单

//这些都是在WordPress后台添加菜单以及子菜单的方法。大家可以根据自己的需要来进行选择