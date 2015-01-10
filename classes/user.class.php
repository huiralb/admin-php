<?php 
	require_once("CRUD.class.php");

	class User  Extends Crud {
		
			# Your Table name 
			protected $table = 'admin';
			
			# Primary Key of the Table
			protected $pk	 = 'AdminId';

			public function getUser()
			{
				
			}
	}

?>