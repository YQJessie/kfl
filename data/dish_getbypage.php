<?php
/*
    ��PHPҳ������main.html
    ��ͻ��˷�ҳ���ز�Ʒ���ݣ���json��ʽ
    ÿ����෵��5����Ʒ����
    ��Ҫ�ͻ����ṩ����һ�У�0/5/10/15����ʼ��ȡ����
    ���ͻ���δ�ṩ��ʵ������Ĭ�ϴ�0��ʼ��ȡ5��
*/
$output=[];
$count=5;
@$start=$_REQUEST['start'];

/*����Ĭ��start*/
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