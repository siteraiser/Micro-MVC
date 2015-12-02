<?php 
abstract class helpers{

	public function get_include_contents($filename,$data) {
		foreach($data as $key => $value){
			$$key = $value;
		}
		if (is_file('views/'.$filename.'.php')) {
			ob_start();
	
			include 'views/'.$filename.'.php';
			return ob_get_clean();
		}
		echo $filename . ' is not a valid file!';
		return false;
	}	
	
	public function addView($view,$data) {	
		//sets output in controller's var
		if(!isset($this->output)){$this->output='';}
		$this->output.=$this->get_include_contents($view,$data);		
	}	
	
	public function loadModel($path) {
		$name =	end(explode('/',$path));
		//echo'loading model: '.$name;
		$loadname = 'models/'.$path.'.php';
		if(file_exists($loadname) AND !isset($this->$name)){
			include_once($loadname);
			$this->$name = new $name;		

			//add pdo 
			include_once('secure/db.inc.php');		
			if(!is_object($this->pdo)){
				//echo'connected -';
				try {
					$this->pdo = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);    					
				} catch (PDOException $e) {
					print "Error!: " . $e->getMessage() . "<br/>";
					die();
				} 				
			}
			$this->$name->pdo=$this->pdo;		
			$this->add_props($this->$name);			
		}
	}	
	public function add_props($object){
	//controller or model
		$object->url_segments=$this->url_segments;	
		$object->doc_root=$this->doc_root;
		$object->path=$this->path;	
		$object->req_url=$this->req_url;
		$object->base_url=$this->base_url;
	}
	public function doc_root() {
		return $this->doc_root;
	}
	public function url_segments() {//no need in controller or view or model
		return $this->url_segments;
	}

	
	/*****extras ***********/
	public function slugify ($string) {
		$string = utf8_encode($string);
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);   
		$string = preg_replace('/^a-z0-9\-\_]/i', '', $string);
		$string = str_replace(' ', '-', $string);
		$string = trim($string, '-');
		$string = strtolower($string);

		if (empty($string)) {
			return '';
		}

		return $string;
	}
	public function imgSlug ($string) {
		$string = str_replace('?', '', $string);
		$string = str_replace(' ', '_', $string);
		return $string;
	}
	public function selectedOption($fields,$selected=''){
		$allOut = "";	
		foreach($fields as $field){
			$out = '<option ';
				if(@$selected == $field){
					$out.="selected";
				}
			$out.=' value="'.$field.'">';
			$out.=$field . '</option>';  
			$allOut.= $out;
			
		 }
		 return $allOut.'</select>';
	}	
	
	public function getSelectFields($array,$col_name){
		foreach(@$array as $value){
			$ret[]=$value[$col_name];
		}		
		return $ret;
	}
	
}

class requestHandler extends helpers{

	public $base_url;
	public $url_segments;
	public $req_url;
	public $path;	
	public $controllername;
	public $pdo;	
	public $doc_root;
	
	public function getContent(){
		$this->base_url    = 'http://localhost/';
		$this->doc_root    = $_SERVER['DOCUMENT_ROOT'].'/';
		
		$this->req_url     = parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH);
		//$query_str = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
		//echo$query_str;
		//parse_str($query_str, $_REQUEST);
		//parse_str($query_str, $_GET);
		//$requested_img  = basename($requested_uri);
	
		$this->output="";	//set default out html
		
		$this->path = trim($this->req_url, '/');    // Trim leading slash(es)
	
		if($this->path == null || $this->path == 'index.php'){   // No path url_segments means home
			$this->path='home';
			$this->url_segments[0] = 'home';//home controller
		
		}else
		{
			if(substr($this->path,-4) == '.xml'){		
				$this->path=substr($this->path,0,strlen($this->path)-4);
			}
			
			$this->url_segments = explode('/', urldecode($this->path));			
			$this->path=parse_url($this->path, PHP_URL_PATH);	//echo path here		
		}
		
		$this->controllername=$this->url_segments[0];	
		
		$controllerpath='controllers/'.$this->controllername.'.php';

		if(file_exists($controllerpath)){
			include_once($controllerpath);
			$controller = new $this->controllername();	
			if(isset($this->url_segments[1]) AND method_exists($controller, $this->url_segments[1])){
				$function = $this->url_segments[1];
				//call function set view data
				$this->add_props($controller);
				
				$controller->$function($this->path);
				$this->output=$controller->output;
				
			} else if(method_exists($controller, 'index')){
				//call function set view data
				$this->add_props($controller);
				
				$controller->index($this->path);
				$this->output=$controller->output;
			}else{//maybe add fallback controller for db etc:))
				$notfound=true;
			}			
		}else{
			$notfound=true;
	   }
	   if(isset($notfound)){$this->notFound();}
	}
	
	

	
	public function notFound(){
		header('HTTP/1.1 404 Not Found');
		print' Not Found! <a href="/">Home</a>';exit();   // Show404Error();$this->output=$this->path.
	}

}