<?php
class Uploader {
	private $filename;
	private $fileData;
	private $destination;
	private $errorMessage;
	private $errorCode;
	private $fileType;

	public function __construct($key){
		$this->filename = $_FILES[$key]['name'];
		$this->fileData = $_FILES[$key]['tmp_name'];
		$this->errorCode = $_FILES[$key]['error'];
		$this->fileType = $_FILES[$key]['type'];
	}

	private function readyToUpload(){
		$folderIsWriteAble = is_writable($this->destination);
		if($folderIsWriteAble === false){
			$this->errorMessage = "Error: destination folder is ";
			$this->errorMessage .= "not writable, change permissions";
			//indicate that code is NOT ready to upload file
			$canUpload = false;
		} else if ( $this->errorCode === 1 ) {
			$maxSize = ini_get( 'upload_max_filesize' ); 
			$this->errorMessage = "Error: File is too big. "; 
			$this->errorMessage .= "Max file size is $maxSize."; 
			$canUpload = false;
			//end of new code
    	} else if ( $this->errorCode === 2 ) {
	        $this->errorMessage = "Error: the file is bigger than the MAX_FILE_SIZE set in the HTML form.";
	        $canUpload = false;
        } else if ( $this->errorCode === 3 ) {
	        $this->errorMessage = "Error: Only partial of file was uploaded.";
	        $canUpload = false;
        } else if ( $this->errorCode === 4 ) {
	        $this->errorMessage = "Error: No file was uploaded.";
	        $canUpload = false;
        } else if ( $this->errorCode === 6 ) {
	        $this->errorMessage = "Error: Cannot find temp directory.";
	        $canUpload = false;
        } else if ( $this->errorCode === 7 ) {
	        $this->errorMessage = "Error: Failed to write the file.";
	        $canUpload = false;
        } else if($fileType !== 'image/jpeg'){
			$this->errorMessage = "Error: the uploaded file is not jpeg file";
			$canUpload = false;
		} else {
			$canUpload = true;
		}
		return $canUpload;
	}

	public function saveIn ($folder){
		$this->destination = $folder;
	}

	public function save() {
		if($this->readyToUpload()){
			move_uploaded_file(
			             $this->fileData,
			            "$this->destination/$this->filename" );
		}else {
        	//if not create an exception - pass error message as argument
        	$exc = new Exception( $this->errorMessage );
        	//throw the exception
        	throw $exc;
    	}
	}
}