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
	 * 连接数据库
	 * 
	 * @param string $dbhost 主机名
	 * @param string $dbuser 用户名
	 * @param string $dbpsw  密码
	 * @param string $dbname 数据库名
	 * @param string $dbcharset 字符集/编码
	 * @return bool  连接成功或不成功 
	 **/
  	function connect($config){
  		extract($config);
  		if (!($con = mysqli_connect($dbhost, $dbuser, $dbpsw, $dbname))) {
  			$this->err(mysql_error());
  		}
  		if (!mysqli_select_db($con, $dbname)) {
  		    $this->err(mysql_error());
  		}

  		mysqli_query($con, "set names ".$dbcharset);
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
	function insert($table, $arr){
		foreach ($arr as $key => $value) {
			// $value = 
		}
	}

}

?>