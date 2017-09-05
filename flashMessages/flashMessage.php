<?php


class flashMessage{

	protected $flashes;		// array for temporarily hold the messages from cookies before print them
	protected $tags;		// bootstrap class => message type 		==		key => value
	protected $id;			// counters to create flashes and also to read them

	/**
	* __construct
	*
	*/
	public function __construct(){
		$this->flashes=array(
			'success' => array(),
			'warning' => array(),
			'error' => array(),
			'info' => array()
		);
		$this->tags=array(
			'info' => 'info',
			'danger' => 'error',
			'warning' => 'warning',
			'success' => 'success'
		);
		$this->id=array(
			'success' => 0,
			'warning' => 0,
			'error' => 0,
			'info' => 0
		);
	}

	/**
     * Functions to create the flash messages using "setFlash()" function
     *  
     * @param  string/array $message 		Message text 
     */
	public function success($message){
		$this->setFlash($this->id['success']++, $message, "success");
	}
	public function warning($message){
		$this->setFlash($this->id['warning']++, $message, "warning");
	}
	public function error($message){
		$this->setFlash($this->id['error']++, $message, "error");
	}
	public function info($message){
		$this->setFlash($this->id['info']++, $message, "info");
	}


	/**
     * Create cookies
     * 
     * @param  string 		$id 		Id to create multiple messagges of the same type
     * @param  string/array $message 	Message text 
     * @param  string 		$type 		Type of message (success,warning,error,info)
     * 
     */
	protected function setFlash($id, $message, $type){
		$cookieName="flash_".$type."_";

		if (is_array ($message))
			setcookie($cookieName.$id, json_encode($message), time() + 60 * 10, '/');  // json_encode/json_decode
		else
			setcookie($cookieName.$id, $message, time() + 60 * 10, '/');  //setcookie($cookieName.$id, $message, time() + 60 * 10, '/', '.example.com');
	}


	/**
     * Fill "$this->flashes" from cookies and delete them
     * 
     * @param  string 		$type 			The way we print flash messages (vertical/horizontal)
     */
	public function getFlashes($type="vertical"){

		$flag=false;

		//Free array flashes and reset the counters before fill it again
		$this->delFlashes();

		// Search for all the cookies
		foreach($_COOKIE as $key => $value){
			foreach ($this->tags as $value2) {
				if(strpos($key, "flash_".$value2."_") !== false){
					$this->flashes[$value2][$id[$value2]++] = $value;
					setcookie($key, "", -1, '/'); //clear cookie and set expiration to the past
					break;
				}
			}
		}

		if (!empty($this->flashes))
			$flag=true;

		if($flag){
			switch ($type) {
				case 'vertical':
					return $this->printFlashes();
					break;
				case 'horizontal':
					return $this->printFlashesHorizontal();
					break;
			}
		}
	}
	
	/**
     * Delete "$this->flashes" and reset "$this->id"
     * 
     */
	protected function delFlashes(){
		foreach ($this->tags as $value){
			unset($this->flashes[$value]);
		}	
		foreach ($this->id as  $value){
			$this->id[$value]=0;
		}	
	}


	/**
     *  Mount the flash messages from "$this-flashes" using "decodeFlashes()" function
     *  	//this will create a div with the class "alert-$key" for bootstrap on each type of message, and fill them with all the flash messages using "decodeFlashes()"
     * @return string
     */
	protected function printFlashes(){
		$outPut="";
		foreach ($this->tags as $key => $value){ 
			if(!empty($this->flashes[$value])){
				$outPut.="<div class='alert alert-".$key."'>";
				$outPut.="<a href='#' class='details_btn close active'>&times;</a>";
				$outPut.=$this->decodeFlashes($this->flashes[$value]);
				$outPut.="</div>";
			}
		}
		return $outPut;
	}

	/**
     *  Mount the flash messages horizontally from "$this-flashes" using "decodeFlashes()" function
     *  	//this will create a div with the class "alert-$key" for bootstrap on each type of message, and fill them with all the flash messages using "decodeFlashes()"
     * @return string
     */
	protected function printFlashesHorizontal(){
		$outPut="";
		foreach ($this->tags as $key => $value){
			if(!empty($this->flashes[$value])){
				$outPut.="<div class='alert alert-".$key." col-sm-3 col-centered'>";
				$outPut.="<a href='#' class='details_btn close active'>&times;</a>";
				$outPut.=$this->decodeFlashes($this->flashes[$value]);
				$outPut.="</div>";
			}
		}
		return $outPut;
	}


	/**
     *  Mount all flashMessages from each type together but separated by <hr>
     * 
     * @param array $data 		array with all messagges of the same type 	($this-flashes['success'])
     * @return string
     *  
     */
	protected function decodeFlashes($data){
		$outPut="";

		//Loop through each message
		foreach ($data as $key => $value) {

			//Message "$data" is JSON(array)
			if(substr($value, 0, 2 ) === '{"' && substr($value, strlen($value)-2, 2 ) === '}}'){
				
				$dataDecoded=json_decode($value);	//use json_decode to get an array from the string, (we used json_encode storing our flash messages)
				//Loop through the multidimensional array (JSON)
				foreach ($dataDecoded as $key2 => $value2) {
					foreach ($dataDecoded->$key2 as $key3 => $value3){

						//Last message of the JSON (nuevo || antiguo, etc)
						if( !next($dataDecoded->$key2) ){

							//There's no more arrays on this JSON
							if(!next($dataDecoded)){
								//last message
								if(!next($data))
									$outPut.=$value3;
								//still more messages on "$data"
								else
									$outPut.=$value3."<hr class='sShadow'/>";
							//There's still another array into this JSON
							}else{
								$outPut.=$value3."<hr/>";
							}

						//there's more messages on the array
						}else{
							$outPut.=$value3.PHP_EOL;
						}
					}
				}
			//Message "$data" is string
			}else{
				//last message
				if(!next($data))
					$outPut.=$value;
				//still more messages on "$data"
				else
					$outPut.=$value."<hr class='sShadow'/>";
			}
		}
		return $outPut;
	}

}
?>