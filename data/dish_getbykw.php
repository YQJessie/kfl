<?php
/*
    ��PHPҳ������main.html
    ���ݹؼ�����ͻ��˷�ҳ���ز�Ʒ���ݣ���json��ʽ
*/
$output=[];
@$kw=$_REQUEST['kw'];
if(!$kw){//���ͻ���δ�ύ���ύ���ַ���
    echo '[]';
    return;//�˳���ǰҳ���ִ��
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