<!DOCTYPE html>
<html>
<head>
<link href="test.css" rel="stylesheet">
<style>
.nopost{

font-size: 80px;
color: darkgrey;
    width: 80%;
    border: 1px solid darkgray;
   font-weight: lighter;
    margin-top: 20px;
    margin-bottom: 20px;
    margin-left: 70px;
    box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
    
    min-height: 570px;
    /* display: grid;
    grid-template-columns: 100px;  */
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    
}
.namedate{
     display: flex;
     flex-direction: row;
   }
 .date{
     margin-left:70px;
     float: right;
     margin-top: 10px;
     color:darkgrey;
 }  
</style>
</head>
<body>


<div style="float: left; width: 30%;height: 100%; background:darkred"></div>
<div class="white" style="float: left; width: 40%;height:100%">
<?php
$uid=$_GET['userid'];
include '_dbconnect.php';
if(isset($_GET['postid']))
{   $pid=$_GET['postid'];
    $sql2="delete from Donation where UserID='$uid'AND PostId='$pid'";
    $result2 = mysqli_query($conn1, $sql2);
    if($result2)
    {
        
    }
}
$sql="select * from Donation where UserID ='$uid' order by time DESC";
$result = mysqli_query($conn, $sql);
$noResult = true;
while($row = mysqli_fetch_assoc($result)){
    $noResult = false;
    $uid = $row['UserID'];
    $sql2 = "select * from UserInfo where UserID='$uid'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $name= $row2['name'];
    $title = $row['title'];
    $body = $row['body']; 
    $contact = $row['contact']; 
    $pid = $row['PostId'];
    $dt=$row['time'];
        $dtob=new DateTime($dt);
        $date=$dtob->format('d');
        $month=$dtob->format('m');
        $year=$dtob->format('Y');
        $dtob2=DateTime::createFromFormat('!m', $month);
        $monthname=$dtob2->format('F');
        $time=$dtob->format('h:i A');
        $t=$date . " " . $monthname . " " . $year;

     echo'<div class="box">

    <div class="namedate"> 
    <div class="name">' .$name. '</div>
    <div class="date">' .$t. '<br>' .$time. '</div> 
    </div>
        <div class="title">' . nl2br($title). '</div>
       <div class="bodytext">' . nl2br($body). '</div>
       <div class="contact">' . nl2br($contact). '</div>
    </div>
        <a href="userblood.php?userid=' .$uid. '&postid=' .$pid. '"><center><button class="btn">Delete<button></center></a>';
        
}
if($noResult==true)
{
    echo '<div class="nopost">
    <center> NO POSTS TO SHOW</center>
 </div>';
}



?>

</div>
<div style="float: left; width: 30%;height:100%; background:darkred"></div>
</body>
</html>