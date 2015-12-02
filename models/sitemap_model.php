<?php 
class sitemap_model extends requestHandler{

	public function getURLS($table){
		$links = array();
		
		$stmt=$this->pdo->prepare("SELECT slug FROM $table");
		$stmt->execute(array());
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


		foreach($rows as $row)
		{
			$links[] = array('link'=>$row['slug'], 'priority' => '0.8');
		}
			
		$stmt=$this->pdo->prepare("SELECT DISTINCT description FROM $table");
		$stmt->execute(array());
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


		foreach($rows as $row)
		{
			$links[] = array('link'=>'gallery/'.$this->slugify($row['description']), 'priority' => '0.8');
		}	
		return $links;
	}
}