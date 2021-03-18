<?php

echo '<div class="wrap">
  <h1>Hello!</h1>
  <p>Buen dia\'s </p>
  </div>';

//   function get_meta_value_by_key($meta_key,$limit = 1){
//     global $wpdb;
//     if (1 == $limit)
//         return $value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s LIMIT 1" , $meta_key) );
//     else
//         return $value = $wpdb->get_results( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s LIMIT %d" , $meta_key,$limit) );
// }

// echo get_meta_value_by_key('custom_tags'.$userID);



// global $post;

// $args = array(
//     // 'numberposts' => 1,
//     'post_type'=> 'movies',
//     'meta_key' => 'field_id'
//     // 'offset'=> 1,
//     // 'category' => 1
// );

// $my_posts = get_posts( $args );

// if( ! empty( $my_posts ) ){
// 	$output = '<ul>';
// 	foreach ( $my_posts as $p ){
// 		$output .= '<li><a href="' . get_permalink( $p->ID ) . '">' 
// 		. $p->post_title . '</a></li>';

// 	}
// 	$output .= '<ul>';
// }
// echo $output;
// echo('<pre>');
// print_r($my_posts);
// echo('</pre>');

// $dato_array_result = json_encode(array("id" => $post_id, "url" => "https://google.com"));
// var_dump($dato_array_result);

// // $term_id = 38;
// // echo "mi id".$term_id;
// // $term_vals = get_term_meta($term_id);
// // var_dump($term_vals);
// // foreach($term_vals as $key=>$val){
// //     echo $key . ' : ' . $val[0] . '<br/>';
// // }

// $term_id = 38;
// echo "mi id".$term_id;
// $term_vals = get_post_meta( $term_id );
// echo('<pre>');
// print_r($term_vals);
// echo('</pre>');
// foreach($term_vals as $key=>$val){
//     echo $key . ' : ' . $val[0] . '<br/>';
// }
// echo "--------------";



// // $slug_page = 527774; //slug de la página en donde se mostrará la tabla
// //   $table_name = 'wp_postmeta'; // nombre de la tabl
	
// // 	// if (is_page($slug_page)){
// // 	    global $wpdb;	
// // 	    $items = $wpdb->get_results("SELECT * FROM `$table_name` WHERE meta_value={$slug_page}");
// // 	    $result = '';
// //       echo('<pre>');
// //     print_r($items);
// //     echo('</pre>');
// //     echo $items[0]->meta_value;


// function bk_auto_buscar_url_id_tmdb($slug_page){

//   $table_name = 'wp_postmeta'; // nombre de la tabl
//   global $wpdb;	
//   $items = $wpdb->get_results("SELECT * FROM `$table_name` WHERE meta_value={$slug_page}");
//   $result = array();

//   foreach ($items as $item) {
//     $result[] = $item->post_id;
//     $result[] = get_permalink( $item->post_id );

//   }

// }

// bk_auto_buscar_url_id_tmdb(527774);

// // function dcms_list_data( $slug_page ) {
// // 	// $slug_page = '527774'; //slug de la página en donde se mostrará la tabla
// //   $table_name = 'wp_postmeta'; // nombre de la tabl
	
// // 	// if (is_page($slug_page)){
// //     global $wpdb;	
// //     $items = $wpdb->get_results("SELECT * FROM `$table_name` WHERE meta_value={$slug_page}");
// //     $result = '';
		
// // 		// nombre de los campos de la tabla
// // 		foreach ($items as $item) {
// // 			$result .= '<tr>
// // 				<td>'.$item->meta_id.'</td>
// // 				<td>'.$item->post_id.'</td>  
// // 				<td>'.$item->meta_key.'</td>
// // 				<td>'.$item->meta_value.'</td>
// // 			</tr>';
// // 		}

// // 		$template = '<table class="table-data">
// // 			          <tr>
// // 			            <th>ID</th>
// // 			            <th>Nombre</th>
// // 			            <th>Variedad</th>
// // 			          </tr>
// // 			          {data}
// // 			        </table>';

// // 	    return $content.str_replace('{data}', $result, $template);
// // 	// }

// // 	// return $content;
// // }

// // var_dump(dcms_list_data($content));
