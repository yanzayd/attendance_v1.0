<?php
/**
 *
 */
class Extra
{

	function __construct()
	{
		# code...
	}

	public function ezpk($subject)
	{
	  $subject=trim($subject);//Remove blank space
	  $search=[' ','  ','   ','-',' -','~'];
	  $subject=str_replace($search, "_", $subject);//Replace inside listed chars  by '_'
	  $subject=strtolower($subject);//to lower  char
	  return $subject;
	}

	public function cleanWord($subject)
	{
		$subject=trim($subject);//Remove blank space
	  $search=["'"];
	  $subject=str_replace($search, "\'", $subject);//Replace inside listed chars  by \'
	  return $subject;
	}

	public function clean($subject)
	{
		$subject=trim($subject);//Remove blank space
	  $search=["'", "=", "/", "``", "`", "`"];
	  $subject=str_replace($search, "", $subject);//Replace inside listed chars  by \'
	  return $subject;
	}

	public function encryptToken($ctx){
		$result=(97531*$ctx)+24680;
		return $result;
	}

	public function decryptToken($ctx){
		$result=($ctx-24680)/97531;
		return $result;
	}

	public function createParentFolder($parentFolder)
	{
		//code to create the Directory
        $current_path="../img/product/".$this->ezpk($parentFolder);
        if(!file_exists($current_path)){
             mkdir($current_path,0777,true);
        }
        return $current_path;
	}

	public function createFolder($parentFolder,$foldername)
	{
		//code to create the Directory
        $current_path="../img/product/".$this->ezpk($parentFolder).'/'.$this->ezpk($foldername);
        if(!file_exists($current_path)){
             mkdir($current_path,0777,true);
        }
	}

	public function renameParentFolder($currentPath,$parentFolder)
	{
		//code to Rename the Directory
        $old_path="../img/product/".$this->ezpk($currentPath);//Old Path
        $current_path="../img/product/".$this->ezpk($parentFolder);
        if(!file_exists($current_path)){
            rename($old_path, $current_path);//Rename the Directory
        }
	}

	public function deleteParentFolder($parentFolder)
	{
		//code to Delete the Directory
        $current_path="../img/product/".$this->ezpk($parentFolder);
        rmdir($current_path);//delete the Directory
	}

	
	
	/*
	*Compress Image Method
	*@param string source File : ex. $fileName['tmp_name']
	*@param string Target File : ex. New Name of File
	*@param int New Width Size : ex. 269 px
	*@param int New Height Size : ex. 265 px
	*@param int New Quality [0-100]    : ex. 75
	*
	*return true if compressed successfuly or false otherwise
	*/
	public function compress_image($source_file, $target_file, $nwidth, $nheight, $quality) {
	  //Return an array consisting of image type, height, widh and mime type.
	  $image_info = getimagesize($source_file);
	  if(!($nwidth > 0)) $nwidth = $image_info[0];
	  if(!($nheight > 0)) $nheight = $image_info[1];

	  if(!empty($image_info)) {
	    switch($image_info['mime']) {
	      case 'image/jpeg' :
	        if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality
	        // Create a new image from the file or the url.
	        $image = imagecreatefromjpeg($source_file);
	        $thumb = imagecreatetruecolor($nwidth, $nheight);
	        //Resize the $thumb image
	        imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
	        // Output image to the browser or file.
	        return imagejpeg($thumb, $target_file, $quality);

	        break;

	      case 'image/png' :
	        if($quality == '' || $quality < 0 || $quality > 9) $quality = 6; //Default quality
	        // Create a new image from the file or the url.
	        $image = imagecreatefrompng($source_file);
	        $thumb = imagecreatetruecolor($nwidth, $nheight);
	        //Resize the $thumb image
	        imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
	        // Output image to the browser or file.
	        return imagepng($thumb, $target_file, $quality);
	        break;

	      case 'image/gif' :
	        if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality
	        // Create a new image from the file or the url.
	        $image = imagecreatefromgif($source_file);
	        $thumb = imagecreatetruecolor($nwidth, $nheight);
	        //Resize the $thumb image
	        imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
	        // Output image to the browser or file.
	        return imagegif($thumb, $target_file, $quality); //$success = true;
	        break;

	      default:
	        echo "<h4>Not supported file type!</h4>";
	        break;
	    }
	  }
	}

	public function uploadImageResize($path, $fileName, $width, $height, $quality, $saveCopy=false)
	{
		$_response_['status']=false;
		$_response_['message']='...';
		$_response_['imageName']='...';
		$source_file = $fileName['tmp_name'];
		$newName=sha1(date('YmdHis')).'.png';
		$target_file = $path.$newName;
		$quality=100;
		if(isset($fileName['name']) && @$fileName['name'] != "") {
			if($fileName['error'] > 0) {
				$_response_= 'INCREASE_POST_AND_UPPLOAD_MAX_SIZEFILE_IN_PHP_INI';
			} else {
				if($fileName['size'] / 1024 <= 15120) { // 15MB
					if($fileName['type'] == 'image/jpeg' ||
						 $fileName['type'] == 'image/pjpeg' ||
						 $fileName['type'] == 'image/png' ||
						 $fileName['type'] == 'image/gif'){

								$success = $this->compress_image($source_file, $target_file, $width, $height, $quality);
								if($success) {
									if($saveCopy==true)
										copy($source_file, $path.'original_'.$newName);
									$_response_['status']=true;
									$_response_['imageName']=$newName;
								}
					}
				} else {
					$_response_['message']= 'IMAGE_MAX_SIZE_15_G0!';
				}
			}
		} else {
			$_response_['message']= 'PLEASE_SELECT_IMAGE!';
		}
		return $_response_;
	}

	public function uploadPicture($path,$fileName)
	{
		$name=$fileName['name'];
	    $ext=strrchr($name, '.');
        $tmp_name = $fileName['tmp_name'];
        $dir_picture = $path.$name;
        $valables = array('.jpg','.JPG','.PNG','.png','.jpeg','.JPEG');
		if(in_array($ext, $valables)):
                if(move_uploaded_file($tmp_name, $dir_picture)):
                  	return $name;
                else:
                 	return false;
                endif;
        else:
        	return false;
    	endif;
	}

	public function uploadFile($path,$fileName)
	{
	    $ext=strrchr($fileName['name'], '.');
			$name=sha1($fileName['name'].date('YmdHis')).$ext;
        $tmp_name = $fileName['tmp_name'];
        $dir_picture = $path.$name;
        $valables = array('.docx','.doc','.xls','.xlsx','.pdf','.PDF');
		if(in_array($ext, $valables)):
                if(move_uploaded_file($tmp_name, $dir_picture)):
                  	return $name;
                else:
                 	return false;
                endif;
        else:
        	return false;
    	endif;
	}

	public function downloadFile($pathFile, $fileName='ezpk.jpg')
	{
		header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($fileName) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($pathFile));
    ob_clean();
    flush();
    readfile($pathFile);
    exit;
	}
	
	/**
	*@Internet connection Status
	*@Return True if the device is connected to the Internet
	*/
	public function internetConnected(){
	    $connected = @fsockopen("www.google.com", 80);
	    return ($connected)?true:false;
	}

}


?>
