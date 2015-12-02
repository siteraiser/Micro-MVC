<?php 
class sitemap_model extends requestHandler{

	public function getAValue($table){
		$stmt=$this->pdo->prepare("SELECT * FROM $table");
		$stmt->execute(array());
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}
?>