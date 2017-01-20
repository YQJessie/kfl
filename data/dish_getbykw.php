<?php
/*
    该PHP页面用于main.html
    根据关键字向客户端分页返回菜品数据，以json格式
*/
$output=[];
@$kw=$_REQUEST['kw'];
if(!$kw){//若客户端未提交或提交空字符串
    echo '[]';
    return;//退出当前页面的执行
}

$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_sm,material FROM kf_dish WHERE name LIKE '%$kw%' OR material LIKE '%$kw%' ";
$result=mysqli_query($conn,$sql);
while( ($row=mysqli_fetch_assoc($result))!=null ){
    $output[]=$row;
}



echo json_encode($output);
?>