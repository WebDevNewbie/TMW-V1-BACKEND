<?php

	class users_m extends CI_Model
	{
		public function mod_login($username, $password)
		{

		   $this -> db -> select('id, username, password, usertype');
		   $this -> db -> from("users");
		   $this -> db -> where('username', $username);
		   $this -> db -> where('password', MD5($password));
		   // $this -> db -> where('Password', $password);
		   $this -> db -> limit(1);
		 
		   $query = $this -> db -> get();
		 
		   if($query -> num_rows() == 1)
		   {
			 return $query->result();
		   }
		   else
		   {
			 return false;
		   }

		}
	
	
	}


?>