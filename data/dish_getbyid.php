<?php
/*
    ��PHPҳ������detail.html
    ���ݲ�Ʒ�����ͻ��˷���ĳһ����Ʒ���ݣ���json��ʽ
*/
$output=[];
@$did=$_REQUEST['did'];
if(!$did){//���ͻ���δ�ύ��Ʒ��Ż���Ϊ��
    echo '[]';
    return;
}



$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="SELECT did,name,price,img_lg,material,detail FROM kf_dish WHERE did=$did";
$result=mysqli_query($conn,$sql);
while( ($row=mysqli_fetch_assoc($result))!=null ){
    $output[]=$row;
}


echo json_encode($output);
?>