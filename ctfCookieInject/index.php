<?php  
include 'db-creds.inc';
session_start(); // 启用session支持 

// 数据库连接  
  
$conn = new mysqli($servername, $username, $password, $dbname, $dbport);  
if ($conn->connect_error) {  
    die("数据库连接失败: " . $conn->connect_error);  
}  
  
// 获取POST请求中的search值  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
	if (isset($_POST["search"])) {  
		$searchValue = $_POST["search"];  
	}  
}  

// 设置cookie  
if (isset($searchValue)) {  
    setcookie("search", $searchValue, time() + 36000); // 设置cookie名为"search"，有效期为10小时  
	echo "cookie ok<br>"; 
	header("Refresh:0");
}  


// 处理Cookie搜索型SQL注入 
if (isset($_COOKIE["search"])) {
	echo "okkkk<br>";
	$searchTerm = $_COOKIE["search"];  
	$searchSql = "SELECT * FROM users WHERE userid > $searchTerm";  
	$result = $conn->query($searchSql);  
	if ($result->num_rows > 0) {  
		while ($row = $result->fetch_assoc()) {  
			echo "用户id: " . $row["userid"] . "<br>";  
		}  
	} else {  
		echo "未找到匹配的用户名";  
		echo $searchSql;
	}  
}else {
	echo "<html>";  
	echo "<head>";  
	echo "<title>CTF注入靶场</title>";  
	echo "<a href=\"./new.php\">首次使用请先重置数据库</a>";  
	echo "</head>";  
	echo "<body>";  
	echo "<h2>Cookie搜索型SQL注入靶场</h2>";  
	echo "<h3>输入你想查询的用户id:</h3>";
	echo "<form method=\"post\" action=\"";  
	echo htmlspecialchars($_SERVER["PHP_SELF"]);  
	echo "\">";  
	echo "<input type=\"number\" name=\"search\">";  
	echo "<input type=\"submit\" value=\"搜索\">";  
	echo "</form>";  
	echo "</body>";  
	echo "</html>";  
}
  
// 处理Cookie数字型SQL注入的示例代码（需要进一步开发）  
?>  
  