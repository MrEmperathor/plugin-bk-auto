<?php

echo '<div class="wrap">
  <h1>Hello!</h1>
  <p>This is my plugin\'s first page</p>
  </div>';

//   function get_meta_value_by_key($meta_key,$limit = 1){
//     global $wpdb;
//     if (1 == $limit)
//         return $value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s LIMIT 1" , $meta_key) );
//     else
//         return $value = $wpdb->get_results( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s LIMIT %d" , $meta_key,$limit) );
// }

// echo get_meta_value_by_key('custom_tags'.$userID);



global $post;

$args = array(
    'numberposts' => 1,
    'post_type'=> 'movies',
    'meta_key' => 'field_id'
    // 'offset'=> 1,
    // 'category' => 1
);

$my_posts = get_posts( $args );

if( ! empty( $my_posts ) ){
	$output = '<ul>';
	foreach ( $my_posts as $p ){
		$output .= '<li><a href="' . get_permalink( $p->ID ) . '">' 
		. $p->post_title . '</a></li>';

	}
	$output .= '<ul>';
}
echo $output;
echo('<pre>');
print_r($my_posts);
echo('</pre>');

$dato_array_result = json_encode(array("id" => $post_id, "url" => "https://google.com"));
var_dump($dato_array_result);