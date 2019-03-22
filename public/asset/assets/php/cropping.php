<?php
    header('Content-Type: image/jpeg');
    
    include("image_resizing.php");
    
    $imgr = new imageResizing();

    if(isset($_POST['cropping-image']) && $_POST['cropping-image'] != NULL){
        
        $image = "/var/www/aqvatariusv/boooya.aqvatarius.com/assets/images/large/".$_POST['cropping-image'];        
        
        $imgr->load($image);        
        $imgX = intval($_POST['imgX']);
        $imgY = intval($_POST['imgY']);
        $imgW = intval($_POST['imgW']);
        $imgH = intval($_POST['imgH']);
        
        /*echo $imgX." ".$imgY." ".$imgW." ".$imgH;*/
        
        $imgr->resize($imgW,$imgH,$imgX,$imgY);
        $imgr->output($imgr->image_type);
    }

?>