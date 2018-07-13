<? ob_start(); ?>
<?php
session_start();
require 'common/connect.php';
include('common/Navigation.php');
echo $username = $_GET['username'];
echo $password = $_GET['password'];


if (!empty($username) && !empty($password))
{
    
 	$result = $con->query("select * from login where username='$username'") or die($con->error);
	
	$numrows = $con->affected_rows;
	
	if($numrows == 1)
	{
		while ($rows = $result->fetch_assoc())
		{
			$dbusername = $rows['username'];
			$dbpassword = $rows['password'];
			$dbusertype = $rows['usertype'];
			$dbuserid = $rows['id'];
		}
		
		if ($username==$dbusername && $password==$dbpassword)
		{
			
			$menu=file_get_contents('common/nav.obj');
			$d=unserialize($menu);

			if($d!='')
			{
			$_SESSION['user_id']=$dbuserid; 
			$_SESSION['u_type']=$dbusertype;
			$_SESSION['username']=$dbusername;
			$_SESSION['authorised']=$d;
			//$_SESSION['authorised']='123';
			header("Location: dashboard.php?flag=all");
			exit;
			}
			//
			header("Location: index.php?flag=unauthorisedUser");
			exit;
		}
		else
		    //die (" doesnt exist");
		    header("Location: index.php?flag=login_pass_err");
			exit;
			
	}
	else 
		//die ("doesnt exist");
		header("Location: index.php?flag=login_user_err");
}
else
	//die ("enter a username and password");
	header("Location: index.php?flag=null_err");
?>
<? ob_flush(); ?>