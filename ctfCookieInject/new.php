<?php  
include 'db-creds.inc';

// 数据库连接  

$conn = new mysqli($servername, $username, $password, $dbname, $dbport);
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}

//删除旧表
$result = $conn->query("SHOW TABLES LIKE 'users'");  
if ($result->num_rows > 0) {  
    // 如果表存在，删除它  
    $conn->query("DROP TABLE users");  
    echo "已删除现有表<br>";  
}

// 创建数据表  
$sql = "CREATE TABLE users (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, userid int(20) NOT NULL, password VARCHAR(30) NOT NULL)";  
if ($conn->query($sql) === FALSE) {  
    die("创建数据表失败: " . $conn->error);  
}  

// 创建数据插入的SQL语句  
$sql2 = "INSERT INTO users (userid, password) VALUES (2, 'pass4'), (12, 'pass5'), (23, 'pass6'), (25, 'pass6'), (225, 'pass6'),(870, 'pass6'), (1885, 'pass6'), (3213, 'pass6'), (32134, 'pass6'), (232135, 'pass6'), (897987, 'pass6')";  
  
// 执行插入操作  
if ($conn->query($sql2) === TRUE) {  
    echo "数据插入成功<br>";  
} else {  
    echo "数据插入失败: " . $conn->error;  
}  

echo "<a href=\"./index.php\">返回</a>"; 
// 关闭数据库连接  
$conn->close();  
  
?>  
  