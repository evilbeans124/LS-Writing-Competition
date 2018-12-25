=== Very Simple Knowledge Base ===
Contributors: Guido07111975
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=donation%40guidovanderleest%2enl
Version: 3.3
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Requires at least: 3.7
Tested up to: 4.7
Stable tag: trunk
Tags: simple, responsive, knowledge, base, bulletin, board, faq, wiki, portal, post, category


This is a very simple plugin to create a knowledgebase. Use a shortcode to display your categories and posts in 3 or 4 columns on a page.


== DESCRIPTION ==
= About =
This is a very simple plugin to create a responsive Knowledge Base, Bulletin Board, FAQ, Wiki or Link Portal. 

It uses the default WordPress categories and posts. 

Add a shortcode to display them:

* For 3 columns: `[knowledgebase-three]`
* For 4 columns: `[knowledgebase]`

In mobile screens 2 columns.

= Custom post types =
You can list custom post types too: products, events, projects, etc

For more info please take a look at the Installation section.

= Question? =
Please take a look at the Installation and FAQ section.

= Translation =
Not included but plugin supports WordPress language packs.

More [translations](https://translate.wordpress.org/projects/wp-plugins/very-simple-knowledge-base) are very welcome!

= Credits =
Without the WordPress codex and help from the WordPress community I was not able to develop this plugin, so: thank you!

Enjoy!


== INSTALLATION ==
= How to use = 
After installation create a page and add a shortcode to display your categories and posts:

* For 3 columns: `[knowledgebase-three]`
* For 4 columns: `[knowledgebase]`

In mobile screens 2 columns.

= Default settings categories = 
* Ascending order (A-Z)
* Empty categories are hidden
* Parent and subcategories are listed the same way

= Default settings posts = 
* Descending order (by date)
* All posts are displayed

= Shortcode attributes =
* Include certain categories: `[knowledgebase include=1,3,5]`
* Exclude certain categories: `[knowledgebase exclude=8,10,12]`
* Display empty categories too: `[knowledgebase hide_empty=0]`
* Set amount of posts for each category: `[knowledgebase posts_per_page=5]`
* Display posts in ascending order: `[knowledgebase order=asc]`
* Display posts by title: `[knowledgebase orderby=title]`
* Display posts in random order: `[knowledgebase orderby=rand]`
* Display category description: `[knowledgebase description="true"]`
* Multiple attributes: `[knowledgebase include=1,3,5 hide_empty=0 orderby=rand]`

= Custom post types =
You can list custom post types too: products, events, projects, etc

To list custom post types you should add 2 shortcode attributes: taxonomy and post_type

* WooCommerce products: `[knowledgebase taxonomy="product_cat" post_type="product"]`
* With category image: `[knowledgebase taxonomy="product_cat" post_type="product" woo_image="true"]`

If a custom post type uses the default "category" taxonomy, you don't have to add shortcode attribute taxonomy.

= Link Portal =
To display a list of website links you can install the [Page Links To](https://wordpress.org/plugins/page-links-to) plugin.

While creating a post you can add the URL (website) of your choice.

When you click the post link in frontend it will redirect you to this URL (so the post will not open).

= Browser support =
The knowledgebase might not display 100% in IE8 and older because I have used css selector 'nth-of-type'.


== Frequently Asked Questions ==
= How are categories listed? =
You can find more info about this at the Installation section.

= How are posts listed? =
You can find more info about this at the Installation section.

= Can I list custom post types too? =
You can find more info about this at the Installation section.

= Does it display properly in all browsers? = 
You can find more info about this at the Installation section.

= How do I style the knowledgebase? =
It mostly depends on the stylesheet of your theme.

You can change style (CSS) using for example the [Very Simple Custom Style](https://wordpress.org/plugins/very-simple-custom-style) plugin.

= How can I make a donation? =
You like my plugin and you're willing to make a donation? Nice! There's a PayPal donate link on the WordPress plugin page and my website.

= Other question or comment? =
Please open a topic in plugin forum.


== Changelog ==
= Version 3.3 =
* shortcode attribute to display category description
* shortcode attribute to display (WooCommerce) category image
* for more info check Installation section

= Version 3.2 =
* custom post types are supported: products, events, projects, etc
* added 2 shortcode attributes: taxonomy and post_type
* for more info check Installation section

= Version 3.1 =
* all php files: disable direct access to file

= Version 3.0 =
* readme file: bunch of textual changes

= Version 2.9 =
* added file changelog
* updated readme file

For all versions please check file changelog.


== Screenshots == 
1. Very Simple Knowledge Base (Twenty Sixteen theme).
2. Very Simple Knowledge Base (Twenty Sixteen theme).
3. Very Simple Knowledge Base (dashboard).