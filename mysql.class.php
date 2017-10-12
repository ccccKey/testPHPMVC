<?php
class mysql{

	/**
	 * 报错函数
	 * 
	 * @param string $error
	 */
    function err($error){
  		die("操作有误,你的操作为:".$error);
  	}

  	/**
	 * 执行sql语句
	 *
	 * @param string $sql
	 * @return bool 返回执行成功、资源或执行失败
	 */
	function query($sql){
		if(!($query = mysql_query($sql))){//使用mysql_query函数执行sql语句
			$this->err($sql."<br />".mysql_error());//mysql_error 报错
		}else{
			return $query;
		}
	}

  	/**
	 * 连接数据库
	 * 
	 * @param string $dbhost 主机名
	 * @param string $dbuser 用户名
	 * @param string $dbpsw  密码
	 * @param string $dbname 数据库名
	 * @param string $dbcharset 字符集/编码
	 * @return bool  连接成功或不成功 
	 **/
  	// function connect($config){
  	// 	extract($config);
  	// 	if (!($con = mysqli_connect($dbhost, $dbuser, $dbpsw, $dbname))) {
  	// 		$this->err(mysql_error());
  	// 	}
  	// 	if (!mysqli_select_db($con, $dbname)) {
  	// 	    $this->err(mysql_error());
  	// 	}

  	// 	mysqli_query($con, "set names ".$dbcharset);
  	// }
  	

  	/**
	 * 执行sql语句
	 *
	 * @param string $sql
	 * @return bool 返回执行成功、资源或执行失败
	 */
	function query($link, $sql){
		if(!($query = mysqli_query($link, $sql))){//使用mysql_query函数执行sql语句
			$this->err($sql."<br />".mysql_error());//mysql_error 报错
		}else{
			return $query;
		}
	}

  	/**
	*列表
	*
	*@param source $query sql语句通过mysql_query 执行出来的资源
	*@return array   返回列表数组
	**/
	function findAll($query){
		if($rs = mysqli_fetch_array($query, MYSQL_ASSOC)){
			$list[] = $rs;
		}
		return isset($list)?$list:"";
	}

	/**
	*单条
	*
	*@param source $query sql语句通过mysql_query执行出的来的资源
	*return array   返回单条信息数组
	**/
	function findOne($query){
		$rs = mysqli_fetch_array($query, MYSQL_ASSOC);
		return $rs;
	}

	/**
	*指定行的指定字段的值
	*
	*@param source $query sql语句通过mysql_query执行出的来的资源
	*return array   返回指定行的指定字段的值
	**/
	function findResult($query, $row = 0, $file = 0){
		$rs = mysql_result($query, $row, $file);
		return $rs;
	}

	/**
	 * 添加函数
	 *
	 * @param string $table 表名
	 * @param array $arr 添加数组（包含字段和值的一维数组）
	 * 
	 */
	function insert($link, $table, $arr){
		foreach ($arr as $key => $value) {
			$value = mysql_real_escape_string($value);
			$keyArr[] = "`".$key."`";
			$valueArr[] = "'".$value."'";
		}	
		$keyStr = implode(",", $keyArr);
		$valueStr = implode(",", $valueArr);
		$sql = "insert into ".$table."(".$keyStr.") values(".$valueStr.")";
		$this->query($link, $sql);
		return mysql_insert_id();
	}

	/**
	*修改函数
	*
	*@param string $table 表名
	*@param array $arr 修改数组（包含字段和值的一维数组）
	*@param string $where  条件
	**/
	function update($link, $table, $arr, $where){
		foreach ($arr as $key => $value) {
			$value = mysql_real_escape_string($value);
			$keyValuesArr = "`".$key."`"."="."'".$value."'";

			$keyValuesStr = implode(",", $keyValuesArr);
			$sql = "update ".$table." set ".$keyValuesStr." where ".$where;
			$this->query($link, $sql);
		}
	}

	/**
	*删除函数
	*
	*@param string $table 表名
	*@param string $where 条件
	**/
	function delete($link, $table, $where){
		$sql = "delete from ".$table." where ".$where;
		$this->query($link, $sql);
	}

}

?>