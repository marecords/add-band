<?php

class Add_band_add_entry{
    
    public function add_entry_to_band_list($input,$uid){
        $band_list_old= get_option('add-band-band-list');
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
        //foreach ($band_list as $bands => $band){
        $band=$band_list['5b93e76118eea'];
                if(!in_array($band['Band_Name'],array_column($posts_array,'post_title'))){
                    $html_page=$this->generate_band_page($band);
                    $my_post = array(
                        'post_title'    => $band['Band_Name'],
                        'post_content'  =>  implode($this->generate_band_page($band)),
                        'post_status'   => 'publish',
                        'post_author'   => 1,
                        'post_category' => array(2)
                    );
                    //echo $html_page;
                    wp_insert_post( $my_post );
                }
          //  }
    }
    
    public function delete_entry_delte_entry($id){
        $options = get_option('add-band-band-list');
        $index = array_search($id, array_column($options,'id'));
        array_splice($options,$index,1);
        update_option('add-band-band-list',$options);
    }
    public function generate_band_page($band){
        $album_list = $this->get_album_list($band['id']);
        $album_display_list=array();
        $album_display_html=array();
        $band_display_info=$band['Text'];
        $band_display_video=$this->get_video_list($band);
        if(count($album_list)>0){
            foreach ($album_list as $albums => $album){
                array_push($album_display_list,new Add_band_album_display($album,$band['Band_Name']));
            }
            foreach ($album_display_list as $albums => $album){
                $album_id=$album->get_album_id();
                $album_display_html[$album_id]=array();
                $album_display_html[$album_id]["display"]=$album->album_display();
                $album_display_html[$album_id]["info"]=$album->album_info(); 
                $album_display_html[$album_id]["listing"]=$album->album_listing();
            }
        }
        $html_page=array();
        
        array_push($html_page,"<div class=\"clearfix\">");
        array_push($html_page,"<div style=\"float: left;width: 30%;padding: 5px;\"><div style=\"width: 100%;background-color: red;\" >");
        foreach ($album_display_list as $albums => $album){
            array_push($html_page,$album_display_html[$album_id]["display"]);
        }
        array_push($html_page,"</div>");
        array_push($html_page,"</div>");
        array_push($html_page,"<div style=\"float: left;width: 70%;padding: 5px;\"><div style=\"width: 100%;background-color: blue;\" >");
        array_push($html_page,$band_display_info);
        foreach ($album_display_list as $albums => $album){
            var_dump($album_display_html[$album_id]["info"]);
            var_dump($album_display_html[$album_id]["listing"]);
            array_push($html_page,$album_display_html[$album_id]["info"]);
            array_push($html_page,$album_display_html[$album_id]["listing"]);
        }
        array_push($html_page,$band_display_video);
        array_push($html_page,"</div>");
        array_push($html_page,"</div>");
        return $html_page;
        //return $html_page;
        //return implode(",", $html_page);
    }
    public function get_album_list($band_id){
        $album_all_list = get_option('add-band-album-list');
        $album_list=array();
        foreach ($album_all_list as $albums => $album){
            if($album['Band_Id']==$band_id){
                array_push($album_list,$album);
            }
        }
            return $album_list;      
    }
    public function get_video_list($band){
        $return_html=array();
        foreach ($band as $videos => $video){
                array_push($return_html,$video);
            
        }
        return implode($return_html);
        
    }
}
