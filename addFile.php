<?php
$server = "tcp:techniondbcourse01.database.windows.net,1433";
$user = "adilevi";
$pass = "Qwerty12!";
$database = "adilevi";
$c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
sqlsrv_configure('WarningsReturnAsErrors', 0);
$conn = sqlsrv_connect($server, $c);
if($conn === false){
    echo "error";
    die(print_r(sqlsrv_errors(), true));
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add File</title>
</head>
<body style="text-align:center;background-color:skyblue;">
<h1 style="color:snow;font-family:Impact, Charcoal, sans-serif;font-size:500%;">Add File</h1>
<h2 style="color:white ;font-family:Impact white, Gadget, sans-serif;font-size:250%;"> Choose Users File:</h2><br><br>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" style="color:white">

    <input  name="csv" type="file" id="csv" style="color:white" /><br><br>
    <input  type="submit" name="user" value="submit" cols="30" />
</form>
<br>
<br>
<?php
if (isset($_POST["user"])){
$countS1=0;
$countF1=0;
$firstRow1=1;//we can assume that every csv file have header according to coral
$file = $_FILES[csv][tmp_name];
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($firstRow1==1){
            $firstRow1=0;
            continue;
        }
        $sql="INSERT INTO Users(ID,name,cName) VALUES
                    ('" . addslashes($data[0]) . "','" . addslashes($data[1]) . "','" . addslashes($data[2]) ."');";
        $result = sqlsrv_query($conn, $sql);
        if ($result){
            $countS1++;
        }
        else{
            $countF1++;
        }
    }
    echo "<span style=\"color:snow;text-align:center;\"> Number of failed tuples uploads: ".$countF1."<br></span>'";
    echo "<span style=\"color:snow;text-align:center;\"> Number of successful tuples uploads: ".$countS1."<br></span>'";

    fclose($handle);
}
}
?>
<h2 style="color:white ;font-family:Impact white, Gadget, sans-serif;font-size:250%;"> Choose Follows File:</h2><br><br>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" style="color:white">

    <input  name="csv" type="file" id="csv" style="color:white" /><br><br>
    <input  type="submit" name="follows" value="submit" cols="30" />
</form>
<br>
<br>
<?php
if (isset($_POST["follows"])){
$countS2=0;
$countF2=0;
$firstRow2=1;//we can assume that every csv file have header according to coral
$file = $_FILES[csv][tmp_name];
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($firstRow2==1){
            $firstRow2=0;
            continue;
        }
        $sql="INSERT INTO Follows(ID1,ID2) VALUES
                    ('" . addslashes($data[0]) . "','" . addslashes($data[1]) . "');";
        $result = sqlsrv_query($conn, $sql);
        if ($result){
            $countS2++;
        }
        else{
            $countF2++;
        }
    }
    echo "<span style=\"color:snow;text-align:center;\"> Number of failed tuples uploads: ".$countF2."<br></span>'";
    echo "<span style=\"color:snow;text-align:center;\"> Number of successful tuples uploads: ".$countS2."<br></span>'";

    fclose($handle);
}
}
?>

<h2 style="color:white ;font-family:Impact white, Gadget, sans-serif;font-size:250%;"> Choose Tweets File:</h2><br><br>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" style="color:white">

    <input  name="csv" type="file" id="csv" style="color:white" /><br><br>
    <input  type="submit" name="tweets" value="submit" cols="30" />
</form>
<br>
<br>
<?php
if (isset($_POST["tweets"])){
$countS3=0;
$countF3=0;
$firstRow3=1;//we can assume that every csv file have header according to coral
$file = $_FILES[csv][tmp_name];
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($firstRow3==1){
            $firstRow3=0;
            continue;
        }
        $sql="INSERT INTO Tweets(tID,uID,time) VALUES
                    ('" . addslashes($data[0]) . "','" . addslashes($data[1]) . "','" . addslashes($data[2]) ."');";
        $result = sqlsrv_query($conn, $sql);
        if ($result){
            $countS3++;
        }
        else{
            $countF3++;
        }
    }
    echo "<span style=\"color:snow;text-align:center;\"> Number of failed tuples uploads: ".$countF3."<br></span>'";
    echo "<span style=\"color:snow;text-align:center;\"> Number of successful tuples uploads: ".$countS3."<br></span>'";

    fclose($handle);
}
}
?>
<h2 style="color:white ;font-family:Impact white, Gadget, sans-serif;font-size:250%;"> Choose Words File:</h2><br><br>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" style="color:white">

    <input  name="csv" type="file" id="csv" style="color:white" /><br><br>
    <input  type="submit" name="word" value="submit" cols="30" />
</form>
<br>
<br>
<?php
if (isset($_POST["word"])){
$countS4=0;
$countF4=0;
$firstRow4=1;//we can assume that every csv file have header according to coral
$file = $_FILES[csv][tmp_name];
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($firstRow4==1){
            $firstRow4=0;
            continue;
        }
        $sql="INSERT INTO Words(tID,idx,content) VALUES
                    ('" . addslashes($data[0]) . "'," . addslashes($data[1]) . ",'" . addslashes($data[2]) ."');";
        $result = sqlsrv_query($conn, $sql);
        if ($result){
            $countS4++;
        }
        else{
            $countF4++;
        }
    }
    echo "<span style=\"color:snow;text-align:center;\"> Number of failed tuples uploads: ".$countF4."<br></span>'";
    echo "<span style=\"color:snow;text-align:center;\"> Number of successful tuples uploads: ".$countS4."<br></span>'";

    fclose($handle);
}
}
?>
</body>
</html>
