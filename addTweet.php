<?php
$server = "tcp:techniondbcourse01.database.windows.net,1433";
$user = "adilevi";
$pass = "Qwerty12!";
$database = "adilevi";
$c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
sqlsrv_configure('WarningsReturnAsErrors', 0);
$conn = sqlsrv_connect($server, $c);
if($conn === false)
{
    echo "error";
    die(print_r(sqlsrv_errors(), true));
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a new tweet</title>
<body style="text-align:center;background-color:skyblue;">
<h1 style="color:snow;font-family:Impact, Charcoal, sans-serif;font-size:600%;">Add New Tweet</h1>
<h2 style="color:snow;font-family:Arial Black, Gadget, sans-serif;">Fill Tweet Details</h2>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <table border="0" cellpadding="5" style="margin-left:auto; color:white; margin-right:auto;">
        <tr><td> Content:</td><td> <textarea name="Content" rows="5" cols="30" required="required" maxlength="280" "></textarea></td></tr>
        <tr><td> <label for='ID'>User ID: </label></td><td>

            <?php $sql="select u.ID from Users u;";
        $result = sqlsrv_query($conn, $sql);?>
        <select id="ID" name="ID" required>
            <option value="" selected disabled hidden>Choose User ID...</option>
            <?php
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $id=$row['ID'];
                echo "<option value='$id'>$id</option>";
            }
            ?>
        </select>
            </td></tr>
    </table><br>
    <button  type="submit" name="submit" value="Send"> Send</button><br><br>
    <button  type="reset" value="Clear"> reset</button>
</form>
<?php


if (isset($_POST["submit"])){
    $UserID=$_POST['ID'];
    $sql1 ="select max(tID)+1 as newtID
            from Tweets;";
    $result1 = sqlsrv_query($conn, $sql1);
    $row1 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
    $pieces = explode(" ", $_POST['Content']);
    $time = date('m/d/Y h:i:s a', time());


    $sql3 = "INSERT INTO  Tweets(tID,uID,time) VALUES ('".$row1['newtID'] ."','".$UserID."', '".$time."');";
    $result3 = sqlsrv_query($conn, $sql3);

    $index = 0;
    foreach($pieces as $val) {
        $TweetID = $row1['newtID'];
        $index++;
        $sql4 = "INSERT INTO Words(tID,idx,content) VALUES ('".$TweetID ."','".$index."', '".$val."');";
        $result2 = sqlsrv_query($conn, $sql4);
    }

    if (!$result or !$result2) {
        die("<span style=\"color:snow;text-align:center;\">Couldn't add the part to the catalog.<br></span>'");
    }
    echo "<span style=\"color:snow;text-align:center;\">The Tweet was added to the DB successfully.<br><br></span>'";
}
?>
</body>
</html>
