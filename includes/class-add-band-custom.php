<?php

class Add_band_add_entry{
    
    public function add_entry_to_band_list($input,$uid){
        //$band_list_old= get_option('add-band-band-list');
        $id = $uid;
        $band_list_new =
                [
			"id" => $uid, 
			"Band_Name" => sanitize_text_field($input['band_name']),  	
			"Text" => sanitize_text_field($_REQUEST['editor_text']) 
		];
        
        if(array_key_exists('video',$input)){
            $band_list_new["videolist"]=  $input['video'];    
        }
        $band_list_old[$id]= $band_list_new;
        update_option('add-band-band-list',$band_list_old);
    }
    
    public function add_entry_create_post(){
        $band_list= get_option('add-band-band-list');
        $get_posts_args = array(
            'category'         => 'bands',
            'post_type'        => 'post',
            'post_status'      => 'publish',
            'suppress_filters' => true,
        );
        $posts_array = get_posts( $get_posts_args );
        foreach ($band_list as $bands => $band){
                if(!in_array($band['Band_Name'],array_column($posts_array,'post_title'))){
                    $my_post = array(
                        'post_title'    => $band['Band_Name'],
                        'post_content'  => $band['Text'],
                        'post_status'   => 'publish',
                        'post_author'   => 1,
                        'post_category' => array(2)
                    );
                    wp_insert_post( $my_post );
                }
            }
    }
    
    public function delete_entry_delte_entry($id){
        $options = get_option('add-band-band-list');
        $index = array_search($id, array_column($options,'id'));
        array_splice($options,$index,1);
        update_option('add-band-band-list',$options);
    }
    
    public function add_entry_create_post_generate_content($band){
        
    }
}