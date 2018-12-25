<?php
/*
 * Plugin Name: Little Star Submit Entry
 * Description: This is a very simple plugin for admin to view students' personal information.
 * Version: 0.1
 * Author: LittleStar
 * Author URI: http://www.starshortstory.com
 * License: GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: littlestar-submit-entry
 * Domain Path: /translation
 */

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define( 'LSSE_PLUGIN', __FILE__ );
define('MYPAGE_OFFSET',10);
define( 'LSSE_PLUGIN_DIR', untrailingslashit( dirname( LSSE_PLUGIN ) ) );
$min=0;

// $page_offset=5;

// load plugin text domain
function lsse_init() { 
	load_plugin_textdomain( 'littlestar-submit-entry', false, dirname( plugin_basename( __FILE__ ) ) . '/translation' );
}
add_action('plugins_loaded', 'lsse_init');
 

// enqueues plugin scripts
function lsse_scripts() {	
	if(!is_admin()) {
		wp_enqueue_style('lsse_style', plugins_url('/css/lsse-style.css',__FILE__));
	}
}
function lsse_menu(){
	// echo '<div class="wrap">';
  // echo '<p>这儿就是插件设置的地方.</p>';
  // echo '</div>';
  add_dashboard_page('View Students', 'View Students', 'read', 'littlestar-submit-entry', 'my_plugin_function1');
}
function my_plugin_function1() {
	?>
  <div class="wrap">
<h1 class="wp-heading-inline">Students List</h1>

 
<hr class="wp-header-end">
<style>
/*css 分页显示样式*/
.yang_pages {padding:10px 0 5px 0px;text-align:center; margin:0 auto;line-height:18px;clear:both !important;}
.yang_pages a {border: 1px solid #E9E9E9; color: #555555;display: inline;display:inline-block; padding:2px 5px;margin:0;}
.yang_pages a:hover {border: 1px solid #2A7D01;color: #fff; background:#2A7D01;text-decoration: none; cursor:pointer;}
.yang_pages .current{padding:2px 5px;background-color: #2A7D01;border: 1px solid #2A7D01;color:#fff;font-weight: bold;}
</style>

<form id="posts-filter" action="index.php?page=littlestar-submit-entry" method="get">

<p class="search-box">
	<label class="screen-reader-text" for="post-search-input">Search Student:</label>
	<input type="search" id="post-search-input" name="s" value="" />
	<input type="submit" id="search-submit" class="button" value="Search Student"  /></p>
	<input type="hidden" name="page" class="post_status_page" value="littlestar-submit-entry" />
<!--
<input type="hidden" name="post_status" class="post_status_page" value="all" />
<input type="hidden" name="post_type" class="post_type_page" value="discussion-topics" />-->
	<div class="tablenav top">
<?PHP
define("DBMS","mysql");
define("HOST","localhost");
require("../wp-config.php");
$dns = DBMS.':host='.HOST.';dbname='.DB_NAME;
// <div class="yang_pages"><div>  <span class="current">1</span><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/2.html">2</a><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/3.html">3</a><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/4.html">4</a><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/5.html">5</a><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/6.html">6</a><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/7.html">7</a><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/8.html">8</a><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/9.html">9</a><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/10.html">10</a><a class="num" href="/index.php/mobile/user/brucemate_my_notify/p/11.html">11</a> <a class="next" href="/index.php/mobile/user/brucemate_my_notify/p/2.html">>></a> <a class="end" href="/index.php/mobile/user/brucemate_my_notify/p/21.html">21</a></div></div>
		// </div>

/**
  * 获取分页的HTML内容
  * @param integer $page 当前页
  * @param integer $pages 总页数
  * @param string $url 跳转url地址    最后的页数以 '&page=x' 追加在url后面
  * 
  * @return string HTML内容;
  */
function getPageHtml($page, $pages, $url){
  //最多显示多少个页码
  $_pageNum = 5;
  //当前页面小于1 则为1
  $page = $page<1?1:$page;
  //当前页大于总页数 则为总页数
  $page = $page > $pages ? $pages : $page;
  //页数小当前页 则为当前页
  $pages = $pages < $page ? $page : $pages;

  //计算开始页
  $_start = $page - floor($_pageNum/2);
  $_start = $_start<1 ? 1 : $_start;
  //计算结束页
  $_end = $page + floor($_pageNum/2);
  $_end = $_end>$pages? $pages : $_end;

  //当前显示的页码个数不够最大页码数，在进行左右调整
  $_curPageNum = $_end-$_start+1;
  //左调整
  if($_curPageNum<$_pageNum && $_start>1){  
   $_start = $_start - ($_pageNum-$_curPageNum);
   $_start = $_start<1 ? 1 : $_start;
   $_curPageNum = $_end-$_start+1;
  }
  //右边调整
  if($_curPageNum<$_pageNum && $_end<$pages){ 
   $_end = $_end + ($_pageNum-$_curPageNum);
   $_end = $_end>$pages? $pages : $_end;
  }

  $_pageHtml = '<div class="yang_pages"><div>';
  // if($_start == 1){
   // $_pageHtml .= '<li><a title="First Page">«</a></li>';
  // }else{
   // $_pageHtml .= '<li><a  title="First Page" href="'.$url.'&current_page=1">«</a></li>';
  // }
  if($page>1){
   $_pageHtml .= '<a  title="Previous" href="'.$url.'&current_page='.($page-1).'"><<</a>';
  }
  for ($i = $_start; $i <= $_end; $i++) {
   if($i == $page){
    $_pageHtml .= '<span class="current">'.$i.'</span>';
   }else{
    $_pageHtml .= '<a href="'.$url.'&current_page='.$i.'">'.$i.'</a>';
   }
  }
  // if($_end == $pages){
   // $_pageHtml .= '<li><a title="Final Page">»</a></li>';
  // }else{
   // $_pageHtml .= '<li><a  title="Final Page" href="'.$url.'&current_page='.$pages.'">»</a></li>';
  // }
  if($page<$_end){
   $_pageHtml .= '<a  title="Next Page" href="'.$url.'&current_page='.($page+1).'">>></a>';
  }
  $_pageHtml .= '</div></div>';
  echo $_pageHtml;
 }
// echo $dns;

try {
    $pdo = new PDO($dns, DB_USER, DB_PASSWORD); //初始化一个PDO对象
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}
$wd='';
$where='';
if(isset($_GET['s'])){
	$wd=htmlspecialchars($_GET['s']);
	$where="WHERE user_name LIKE '%".$wd."%' OR user_email LIKE '%".$wd."%' OR school_name LIKE '%".$wd."%' OR phone_number LIKE '%".$wd."%'";
}
$pdo->exec("set names utf8");
$sql="SELECT * FROM ".$table_prefix."students $where ORDER BY id DESC";
// echo $sql;
$result=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// echo "<PRE>";
// print_r($result);
// echo "</PRE>";
$cnt=count($result);
$pages=ceil($cnt/MYPAGE_OFFSET);
$current_page=isset($_GET['current_page'])?intval($_GET['current_page']):0;
$min=$current_page?($current_page-1)*MYPAGE_OFFSET:0;
// echo "page_offset=".MYPAGE_OFFSET." ,pages=".$pages.",cnt=".$cnt.",current page=".$current_page."<BR>";

$sql="SELECT * FROM ".$table_prefix."students $where ORDER BY id DESC LIMIT ".$min.",".MYPAGE_OFFSET." ";
// echo $sql;
$result=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$cnt2=count($result);
?>


<div class='tablenav-pages one-page'><span class="displaying-num"><?PHP echo $cnt;?> items</span>
<span class='pagination-links'><span class="tablenav-pages-navspan" aria-hidden="true">&laquo;</span>
<span class="tablenav-pages-navspan" aria-hidden="true">&lsaquo;</span>
<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Current Page</label><input class='current-page' id='current-page-selector' type='text' name='paged' value='1' size='1' aria-describedby='table-paging' /><span class='tablenav-paging-text'> of <span class='total-pages'>1</span></span></span>
<span class="tablenav-pages-navspan" aria-hidden="true">&rsaquo;</span>
<span class="tablenav-pages-navspan" aria-hidden="true">&raquo;</span></span></div>
		<br class="clear" />
	</div>
	
	<h2 class='screen-reader-text'>Students list</h2><table class="wp-list-table widefat fixed striped posts">
	<thead>
	<tr>
		<!--<th>Order</th>-->
		<th scope="col" id='title' class='manage-column column-author column-primary sortable desc'>
			<span>Student Name</span></th>
		<th scope="col" id='author' class='manage-column column-author'>Age</th>
		<th scope="col" id='author' class='manage-column column-author'>Email</th>
		<th scope="col" id='author' class='manage-column column-author'>Phone Number</th>
		<th scope="col" id='author' class='manage-column column-author'>Wechat Number</th>
		<th scope="col" id='title' class='manage-column column-title'>School Name</th>
		<th scope="col" id='author' class='manage-column column-author'>Story</th>
		<th scope="col" id='date' class='manage-column column-date sortable asc'><span>Date</span></th>	</tr>
	</thead>
<!--Start view data-->
	<tbody id="the-list">
<?PHP
for($i=0;$i<$cnt2;$i++){
	?>
	<tr id="post-59" class="iedit author-other level-0 post-59 type-discussion-topics status-publish hentry">
			<!--<td><?PHP echo $result[$i]['id'];?></td>-->
			<td class="title column-author has-row-actions column-primary page-author" data-colname="Author">
				<?PHP echo $result[$i]['user_name'];?>
			</td>
			<td class='author column-author' data-colname="Author"><?PHP echo $result[$i]['user_age'];?></td>
			<td class='author column-author' data-colname="Author"><?PHP echo $result[$i]['user_email'];?></td>
			<td class='author column-author' data-colname="Author"><?PHP echo $result[$i]['phone_number'];?></td>
			<td class='author column-author' data-colname="Author"><?PHP echo $result[$i]['wechat_no'];?></td>
			
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<?PHP echo $result[$i]['school_name'];?>
			</td>
			
			<td class='comments column-comments' data-colname="Comments"><?PHP if($result[$i]['your_story'] && file_exists('../'.$result[$i]['your_story']))echo "<a href='../".$result[$i]['your_story']."'>'<img width=100 src=\"../".$result[$i]['your_story']."\">'</a>";?>
			</td>
			<td class='date column-date' data-colname="Date"><?PHP echo $result[$i]['addtime'];?>
			</td>		
	</tr>
	<?PHP
}
?>

		<tr>
		<!--<th>Order</th>-->
		<th scope="col" id='title' class='manage-column column-author column-primary sortable desc'>
			<span>Student Name</span></th>
		<th scope="col" id='author' class='manage-column column-author'>Age</th>
		<th scope="col" id='author' class='manage-column column-author'>Email</th>
		<th scope="col" id='author' class='manage-column column-author'>Phone Number</th>
		<th scope="col" id='author' class='manage-column column-author'>Wechat Number</th>
		<th scope="col" id='title' class='manage-column column-title'>School Name</th>
		<th scope="col" id='author' class='manage-column column-author'>Story</th>
		<th scope="col" id='date' class='manage-column column-date sortable asc'><span>Date</span></th>	</tr>
	</tfoot>

</table>
	<?PHP
	$url='index.php?page=littlestar-submit-entry';
	getPageHtml($current_page, $pages, $url);
}
add_action('wp_enqueue_scripts', 'lsse_scripts');
add_action('admin_menu', 'lsse_menu');
// echo 'test-----------------------------------------';
// include the shortcode files
// include 'vskb-three-columns.php';
// include 'vskb-four-columns.php';

?>