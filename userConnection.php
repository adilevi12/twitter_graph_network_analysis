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
    <title>Show user connections</title>
</head>
<body style="text-align:center;background-color:skyblue" >
<h1 style="color:snow;font-family:Impact, Charcoal, sans-serif;font-size:500%;">Show user connections</h1>
<h3 style="color:snow;font-family:Impact, Charcoal, sans-serif;font-size:300%;">Select user ID</h3>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <label style="color: snow" for='ID'>User ID: *</label>

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

    <button  type="submit" name="submit" value="Send"> Send</button><br><br>
    <button  type="reset" value="Clear"> reset</button>
</form>
<?php
if (isset($_POST["submit"])) {
    $UserID = $_POST['ID'];
    $sql2 = "select u.name
from Users u,
(select f.ID2
from FriendsOfUser f
where f.ID1 = '" . $UserID . "') as friendsOf
where friendsOf.ID2=u.ID
order by u.name asc;";
    $result2 = sqlsrv_query($conn, $sql2);


    $sql4 = "select u.name
from Users u
where u.ID='" . $UserID . "';";
    $result4 = sqlsrv_query($conn, $sql4);
    $row22 = sqlsrv_fetch_array($result4, SQLSRV_FETCH_ASSOC);

    echo "<table border='1' style=color:snow; width=20% align=\"center\">";
    echo "<tr><th>Friends of User: " . $row22['name'] . "</th></tr>";
    while ($row = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)) {
        echo "<tr><td>" . $row['name'] . "</td></tr>";
    }
    echo "</table>";
    ?>
    <br>
    <br>
    <br>
    <?php
    $UserID = $_POST['ID'];
    $sql3 = "select u.name
from Users u,
    (select s.semi2
    from SemiFriends s
    where s.semi1 = '" . $UserID . "') as semiFriendsOf
where semiFriendsOf.semi2=u.ID
order by u.name asc;";
    $result3 = sqlsrv_query($conn, $sql3);


    echo "<table border='1' style=color:snow; width=20% align=\"center\">";
    echo "<tr><th>Semi Friends of User: " . $row22['name'] . "</th></tr>";
    while ($row = sqlsrv_fetch_array($result3, SQLSRV_FETCH_ASSOC)) {
        echo "<tr><td>" . $row['name'] . "</td></tr>";
    }
    echo "</table>";
}
?>
