<?php
/*
    该PHP页面用于main.html
    向客户端分页返回菜品数据，以json格式
    每次最多返回5条菜品数据
    需要客户端提供从哪一行（0/5/10/15）开始读取数据
    若客户端未提供其实航，则默认从0开始读取5条
*/
$output=[];
$count=5;
@$start=$_REQUEST['start'];

/*设置默认start*/
if($start===null){
    $start=0;
}

$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_sm,material FROM kf_dish LIMIT $start, $count";
$result=mysqli_query($conn,$sql);
while( ($row=mysqli_fetch_assoc($result))!=null ){
    $output[]=$row;
}



//var_dump($conn);



echo json_encode($output);
?>