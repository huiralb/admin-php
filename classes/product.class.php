<?php 
	require_once("CRUD.class.php");

	class Category  Extends Crud {
		
			# Your Table name 
			protected $table = 'category';
			
			# Primary Key of the Table
			protected $pk	 = 'catId';
			protected $stat = 'status';
			//protected $order = 'name';

			public function findOrder($status = "")
			{
				$status = (empty($this->variables[$this->stat])) ? $status : $this->variables[$this->stat];

				if(!empty($status)) {
					$sql = "SELECT * FROM " . $this->table ." WHERE " . $this->stat . "= :" . $this->stat;	
					$this->variables = $this->db->row($sql,array($this->stat=>$status));
				}
			}
	}

	class Product  Extends Crud {
		
			# Your Table name 
			protected $table = 'product';
			
			# Primary Key of the Table
			protected $pk	 = 'productId';
	}

?>