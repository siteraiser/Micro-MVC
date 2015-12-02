<?php 
class home extends requestHandler{

	public function index(){
		$data['title']="Set the title";
		$data['meta']="";
		$data['description']="";
		$data['keywords']="";		

		$this->loadModel('demo_model');	
	
		$data['value']=$this->demo_model->getAValue('table');
		
		$this->addView('header',$data);	
		$this->addView('home',$data);
		$this->addView('footer',$data);
	}
}