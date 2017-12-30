<?php

/**
* 
*/
class database
{
	/**
	* Khai báo biến kết nối
	* $conn
	*/
	public $conn = null;
	
	public function __construct()
	{
		$this->conn = mysqli_connect("localhost","root","","codethuan_banhang") or die("Không thể kết nối với cơ sở dữ liệu");
		mysqli_set_charset($this->conn,'utf8');
	}

	/*
	*	Disconnect
	*/
	public function disconnect()
	{
		if($this->conn)
		{
			mysqli_close($this->conn);
		}
	}
	/**
	* Khai báo hàm insert
	* $table
	* array $param
	*/
	public function insert($table,array $data)
	{
		//code
		$sql = "INSERT INTO {$table} ";
		$column = implode(',',array_keys($data));
		$value = "";
		$sql .= "(".$column.")";
		foreach ($data as $key => $val) {
			if(is_string($val))
			{
				$value .= "'".mysqli_real_escape_string($this->conn,$val)."',";
			}
			else
			{
				$value .= mysqli_real_escape_string($this->conn,$val).",";
			}
		}
		$value = trim($value,",");
		$sql .= " VALUES (".$value.")";
		
		//debug//die
		mysqli_query($this->conn,$sql) or die("Không thể chèn...".mysqli_error($this->conn));

		//id cuối vừa chèn vào
		return mysqli_insert_id($this->conn);
	}

	/**
	* Khai báo hàm update
	* $table
	* array $param
	* array $condition
	*/
	public function update($table,array $data,array $dieukien)
	{
		$sql = "UPDATE {$table}";

		$set = " SET ";

		$where = " WHERE ";

		foreach ($data as $key => $value) {
			if(is_string($value)){
				$set .= $key." = '".mysqli_real_escape_string($this->conn,$value)."' ,";
			}
			else{
				$set .= $key." = ".mysqli_real_escape_string($this->conn,$value)." ,";
			}
		}

		$set = substr($set,0,-1);

		foreach ($dieukien as $key => $value) {
			if(is_string($value)){
				$where .= $key." = '".mysqli_real_escape_string($this->conn,$value)."' AND ";
			}else{
				$where .= $key." = ".mysqli_real_escape_string($this->conn,$value)." AND ";
			}
		}
		$where = substr($where,0,-5);

		$sql .= $set.$where;

		//debug//die
		mysqli_query($this->conn,$sql) or die("Không thể update".mysqli_error($this->conn));

		return mysqli_affected_rows($this->conn);
	}

	// UPDATE với $sql
	public function updateview($sql)
	{
		mysqli_query($this->conn,$sql) or die("Không thể update".mysqli_error($this->conn));
		return mysqli_affected_rows($this->conn);
	}

	// Đếm số hàng truy vấn
	public function countTable($table)
	{
		$sql = "SELECT * FROM {$table}";
		$query = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		return mysqli_num_rows($query);
	}

	/*
	* Xóa bảng
	*/
	public function delete($table,$id)
	{
		$sql = "DELETE FROM {$table} WHERE id = $id";
		mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		return mysqli_affected_rows($this->conn);
	}

	/*
	* Xóa bảng
	*/
	public function delete_multi($table,array $data)
	{
		foreach ($data as $key => $value) {
			$sql = "DELETE FROM {$table} WHERE ".$value;
			mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		}
		return true;
	}

	public function fetch_sql($sql=null)
	{
		$result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		$data = [];
		if($result)
		{
			while ($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
		}
		return $data;
	}

	public function fetch_id($table,$id)
	{
		$sql = "SELECT * FROM {$table} WHERE id = $id";
		$result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		return mysqli_fetch_assoc($result);
	}

	public function fetch_one($sql=null)
	{
		$sql .= " LIMIT 1";
		$result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		return mysqli_fetch_assoc($result);
	}

	public function fetch_all($table)
	{
		$sql = "SELECT * FROM {$table} WHERE 1";
		$result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn:".mysqli_error($this->conn));
		$data = [];
		if($result)
		{
			while ($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
		}
		return $data;
	}

	public function fetch_pagi($sql=null,$page_current=1,$limit=10,$total,$pagi=true)
	{
		$data = [];
		if($pagi == true)
		{
			$total_page = ceil($total/$limit);
			$start = ($page_current-1)*$limit;
			$sql .= " ORDER BY id DESC LIMIT $start,$limit";
			$data = ["page"=>$total_page];

			$result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		}
		else
		{
			$result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		}

		if($result)
		{
			while ($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
		}
		return $data;
	}

	public function fetch_pagination($table,$sql=null,$page_current=1,$limit=10,$pagi=false)
	{
		$data = [];
		if($pagi == true)
		{
			$total = countTable($table);
			$total_page = ceil($total/$limit);
			$start = ($page_current-1)*$limit;
			$sql .= " LIMIT $start,$limit";
			$data = ["page"=>$total_page];

			$result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		}
		else
		{
			$result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn: ".mysqli_error($this->conn));
		}

		if($result)
		{
			while ($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
		}
		return $data;
	}

	public function total_data($sql=null)
	{
		$result = mysqli_query($this->conn,$sql);
		$row = mysqli_num_rows($result);
		return $row;
	}
}

?>