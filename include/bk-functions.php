<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

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
    // http://pelis24hd.test/wp-json/bk-dcms-seo-yoast-generate-post/v2/postID/11001/api/4cd9cd25-fc28-4089-9977-70377dc6cd4f/blinks/asdadasdasdasdasdad/blang/latinoooo
register_rest_route( 'bk-dcms-seo-yoast-generate-post/v2', '/postID/(?P<post_id>\d+)/api/(?P<api_key>[a-zA-Z0-9-]+)/blinks/(?P<biky_links>[\S]+)/blang/(?P<lang>[\S]+)/bcalidad/(?P<q>[\S]+)/type/(?P<type>[\S]+)/', array(
    'methods' => 'GET',
    'callback' => 'bk_dcms_get_links_from_post_create',
) );
});

function bk_dcms_get_links_from_post_create( $data ) {

    // echo('<pre>');
    // var_dump($data);

    // echo('</pre>');
    $api_key_app_breiky = '4cd9cd25-fc28-4089-9977-70377dc6cd4f';
    if ($api_key_app_breiky !== $data['api_key']) return;

    $post_type_2 = 'movies';
    $bk_type = $data['type'];
    $_REQUEST['post_type'] = 'movies';
    $_POST['trgrabber_id'] = $data['post_id'];
    $_POST['trgrabber_link'] = json_decode(base64_decode($data['biky_links']));
    $_POST['trgrabber_lang'] = json_decode(base64_decode($data['lang']));
    $_POST['trgrabber_quality'] = json_decode(base64_decode($data['q']));
    // var_dump($_POST['trgrabber_quality']);

    // links movies
    if ($bk_type === 'create'){

        $my_post = array(
            'post_title'  => __( 'Auto Draftt' ),
            'post_status' => 'auto-draft',
            'post_type'   => 'movies',
            'post_author'   => 1
        );
    
        $post_id = wp_insert_post( $my_post );

    }elseif ($bk_type === 'update_links') {

        $post_id = $data['post_id'];

        // links movies
        $total = get_post_meta( $post_id, 'trgrabber_tlinks', true ) == '' ? 0 : get_post_meta( $post_id, 'trgrabber_tlinks', true )+1;
        
        if( isset( $total ) and isset( $_POST['trgrabber_link'] ) and $total > 0 and count( array_filter( $_POST['trgrabber_link'] ) ) < $total ) {
            for ($iii = 0; $iii <= $total; $iii++) { delete_post_meta( $post_id, 'trglinks_'.$iii ); }
            delete_post_meta( $post_id, 'trgrabber_tlinks' );
        }
        
        if( isset( $_POST['trgrabber_link'] ) and !empty( array_filter( $_POST['trgrabber_link'] ) ) > 0 and tr_grabber_type() == 1 ) {
            
            $i = 0; $count = ''; $array_links = array(); $server_id = array();
            
            foreach (  array_filter( $_POST['trgrabber_link'] ) as $key => $value ) {
                            
                //if( empty( $_POST['trgrabber_server'][$i] ) ) {
                    
                    preg_match( '@((https?://)?([-\\w]+\\.[-\\w\\.]+)+\\w(:\\d+)?(/([-\\w/_\\.]*(\\?\\S+)?)?)*)@', $_POST['trgrabber_link'][$i], $a );
                    
                    if(!empty($a[0])) {
                        
                        $url = wp_parse_url( str_replace( 'https://www.', 'https://' ,str_replace('http://www.', 'http://', $a[0]) ) );
                                            
                        if( isset( $url['host'] ) ) {
                            
                            $explode = explode('.', $url['host']);

                            $term_server = term_exists(ucwords( $explode[0] ), 'server');

                            if ($term_server !== 0 && $term_server !== null) {

                                $server_id[$i] = $term_server['term_id'];

                            } else {


                                $insert_server = wp_insert_term(ucwords( $explode[0] ), 'server', array());

                                $server_id[$i] = $insert_server['term_id'];

                            }
                                                    
                        }
                        
                    }else {
                        
                        $server_id[$i] = '';
                    
                    }
                                    
                //}
                
                if( isset( $_POST['trgrabber_lang'][$i] ) and !empty( $_POST['trgrabber_lang'][$i] ) ) {
                    
                    if( intval( $_POST['trgrabber_lang'][$i] ) ) {
                        $lang_id = intval( $_POST['trgrabber_lang'][$i] );
                    }else {
                        
                        $term_lang = term_exists(ucwords( $_POST['trgrabber_lang'][$i] ), 'language');

                        if ($term_lang !== 0 && $term_lang !== null) {

                            $lang_id = $term_lang['term_id'];

                        } else {


                            $insert_lang = wp_insert_term(ucwords( $_POST['trgrabber_lang'][$i] ), 'language', array());

                            $lang_id = $insert_lang['term_id'];

                        }
                        
                    }
                    
                }
                
                if( isset( $_POST['trgrabber_quality'][$i] ) and !empty( $_POST['trgrabber_quality'][$i] ) ) {
                    
                    if( intval( $_POST['trgrabber_quality'][$i] ) ) {

                        $quality_id = intval( $_POST['trgrabber_quality'][$i] );
                        
                    }else {

                        $term_quality = term_exists(ucwords( $_POST['trgrabber_quality'][$i] ), 'quality');
                        
                        if ($term_quality !== 0 && $term_quality !== null) {

                            $quality_id = $term_quality['term_id'];

                        } else {


                            $insert_quality = wp_insert_term(ucwords( $_POST['trgrabber_quality'][$i] ), 'quality', array());

                            $quality_id = $insert_quality['term_id'];

                        }
                        
                    }
                    
                }
                                                    
                $array_links[$i] = array(
                
                    'type' => get_term_meta($server_id[$i], 'type', true) == '' ? $_POST['trgrabber_type'][$i] : get_term_meta($server_id[$i], 'type', true),
                    'server' => empty($server_id[$i]) ? '' : $server_id[$i],
                    'lang' => isset( $_POST['trgrabber_lang'][$i] ) ? $lang_id : '',
                    'quality' => isset( $_POST['trgrabber_quality'][$i] ) ? $quality_id : '',
                    'link' => isset( $_POST['trgrabber_link'][$i] ) ? base64_encode ( stripslashes( esc_textarea( $_POST['trgrabber_link'][$i] ) ) ) : '',
                    'date' => !empty( $_POST['trgrabber_date'][$i] ) ? $_POST['trgrabber_date'][$i] : date('d').'/'.date('m').'/'.date('Y'),
                    
                );
                
                if( isset($array_links[$i]['link']) and !empty($array_links[$i]['link']) ) { $count .= $i.','; update_post_meta( $post_id, 'trglinks_'.$i, serialize( $array_links[$i] ) ); }
                
                $i++;
                
            }
                    
            if( isset( $count ) and !empty( $count ) ) update_post_meta( $post_id, 'trgrabber_tlinks', count( $array_links ) );
            
        }

        echo "PELI ACTUALIZADA!";
    }
  }