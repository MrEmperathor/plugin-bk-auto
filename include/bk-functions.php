<?php
// La función agregará un nuevo enlace de nivel superior al menú de navegación del Panel de control del administrador.

function Bk_Add_My_Admin_Link()
{
    add_menu_page(
        'My First Page', // Title of the page
        'My First Plugin', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        plugin_dir_path(__FILE__) . '/bk-inicio.php' // The 'slug' - file to display when clicking the link
        // 'include/mfp-first-acp-page.php'
    );
}
add_action( 'admin_menu', 'Bk_Add_My_Admin_Link' );

  //Uso del Hook
//   api/(?P<api_key>[a-zA-Z0-9-]+)/blinks/(?P<biky_links>[\S]+)/blang/(?P<lang>[\S]+)/q/(?P<q>[\S]+)/
add_action( 'rest_api_init', function () {
register_rest_route( 'bk-dcms-seo-yoast-update-post/v2', '/links/(?P<post_id>\d+)/', array(
    'methods' => 'GET',
    'callback' => 'bk_dcms_get_links_from_post_update',
) );
});
function bk_dcms_get_links_from_post_update( $data ) {
    echo('<pre>');
    print_r($data);
    echo('</pre>');
  }

