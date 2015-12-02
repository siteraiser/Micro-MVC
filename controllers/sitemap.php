<?php 
class sitemap extends requestHandler{

	public function index(){

		$this->loadModel('sitemap_model');
        $data['urlslist'] = $this->sitemap_model->getURLS('table');		
		
		header("Content-Type: text/xml;charset=iso-8859-1");
		
		$this->addView('sitemap',$data);
	}

}