<?php
$conn = mysqli_connect("localhost","root","root","application");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$user="moderator2";
$id=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Moderator WHERE Username='".$user."'"))[0];
echo $id;
//$sql="UPDATE Moderator SET (UserName='".$_POST['username']."',FirstName='".$_POST['firstname']."', LastName='".$_POST['lastname']."', Email='".$_POST['email']."', Contact='".$_POST['contact']."',DateOfBirth='".$_POST['DateOfBirth']."', Gender='".$_POST['Gender']."', Address='".$_POST['Address']."')
//         WHERE ModeratorId='".$id."'";
$sql="UPDATE `application`.`Moderator` SET `FirstName`='abcbcbc', `LastName`='Smith', `Contact`='1-193-661-1889' WHERE `ModeratorID`='6';";
mysqli_query($conn,$sql);

//echo mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Chat WHERE UserId='".$user."'"))[0];
?>
