<?php
/*
    ��PHPҳ������order.html
    ��ȡ�ͻ����ύ�Ķ������ݣ����浽���ݿ���
    ��ͻ��˷�ҳ���ر���Ľ������json��ʽ
*/
$output=[];
@$user_name=$_REQUEST['user_name'];
@$phone=$_REQUEST['phone'];
@$sex=$_REQUEST['sex'];
@$addr=$_REQUEST['addr'];
@$did=$_REQUEST['did'];
$order_time=time()*1000;
if(!$user_name || !$addr || !$phone || !$did){
    echo '{"result":"err","msg":"INVALID REQUEST DATA"}';
    return;
}

$conn=mysqli_connect('127.0.0.1','root','','kaifanla');
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
$sql="INSERT INTO kf_order VALUES(null,'$phone','$user_name','$sex','$order_time','$addr','$did') ";
$result=mysqli_query($conn,$sql);
if( $result ){//ִ�гɹ�
    $output['result']='ok';
//    ��ȡ�ո�ִ�е�sql������ɵ��������
    $output['oid']=mysqli_insert_id($conn);
}else{//ִ��ʧ��
    $output['result']='fail';
    $output['msg']='���ʧ�ܣ�';
}


echo json_encode($output);
?>