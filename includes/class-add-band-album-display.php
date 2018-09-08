<?php

class Add_band_album_display{
    
    function __construct($album_array,$band_name) {
        $this->id=$album_array['Id'];
        $this->album_name=$album_array['Album_Name'];
        $this->soldout_state=$album_array['soldout_state'];
        $this->band_name=$band_name;
        $this->relase_date=$album_array['Datum'];
        $this->format=$album_array['Format'];
        $this->img_ID=$album_array['Img_URL'];
        $this->img_URL=wp_get_attachment_image_src( $this->img_ID, 'thumbnail' )[0];
        $this->shop_link=$album_array['Shop_Link'];
        $this->track_list=$album_array['track_list'];
        $this->description=$album_array['description'];
        
    }
    
    public function album_display(){
        $img="<img src=".$this->img_URL." style=\"height:50px;\">";
        $info="<p><span style=font-size: 30px;>";
        $info.=$this->album_name;
        $info.="<br>";
        $info.=$this->band_name;
        $info.="<br>";
        $info.=$this->format;
        $info.=$this->relase_date;
        $info.="<br>";
        //echo $info;
        $button="<a href=".$this->shop_link." class=\"button\">Order Now</>";
        if(!is_null($this->track_list)&&count($this->track_list)>0){
        $track_list_display="<br><span ><ol type=\"1\">";
        for($i=1;$i<count($this->track_list);$i++){
            $track_list_display.="<li>".$this->track_list[$i]."</li>";
        }
        $track_list_display.="</ol>";     
            $array =array($img , $info , $button , $track_list_display);
        }else {
            $array =array($img , $info , $button);
        }
        return implode("", $array);
    }
    public function album_info(){
        return implode(",",array("ALBUM INFO: ", $this->description));
    }
    
    public function album_listing(){
        return '<img src="'.$this->img_URL.'" width=\"100\" height=\"100\">';
    }
    
    
    public function get_album_id(){
        return $this->id;
    }
    
}

