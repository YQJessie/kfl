<?php
/*
    ��PHPҳ������myorder.html
    ��ȡ�ͻ����ύ�ĵ绰���룬���غ����Ӧ�����ж�������json��ʽ
*/
$output=[];
@$phone=$_REQUEST['phone'];
if(!$phone){
    echo'[]';
    return;
}


$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="SELECT oid,user_name,order_time,img_sm,kf_order.did FROM kf_order,kf_dish WHERE phone='$phone' AND kf_order.did=kf_dish.did ORDER BY order_time DESC";
$result=mysqli_query($conn,$sql);
while( ($row=mysqli_fetch_assoc($result))!=null ){
    $output[]=$row;
}


echo json_encode($output);
?>