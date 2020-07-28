<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>twitter</title>

</head>
<body style="text-align:center;background-color:skyblue;">
<h1 style="color:snow;font-family:Impact, Charcoal, sans-serif;font-size:600%;"> Welcome to Corona Twitter website</h1>
<img src="twitter.jpeg" alt="twitter" style="width:1200px;">
<br>
<br>
<a href="addFile.php" target="_self" style="color:snow;font-family:Arial Black, Gadget, sans-serif;font-size:170%;">Add new files</a><br>
<br>
<a href="addTweet.php" target="_self" style="color:snow;font-family:Arial Black, Gadget, sans-serif;font-size:170%;">Add a new tweet</a><br>
<br>
<a href="userConnection.php" target="_self" style="color:snow;font-family:Arial Black, Gadget, sans-serif;font-size:170%;">Show user connections</a><br>
<br>
<br>
<br>
<h2 style="color:snow;font-family:Arial Black, Gadget, sans-serif;">Twitter Statistics</h2>
<br>
<br>

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


$sql1 = "select theBest.uID
        from (select top 1  T.uID , count(DISTINCT T.tID) as total
                from Tweets T
                group by T.uID
                order by total desc) theBest;";

$sql2 = "select theBest.cName
        from (
            select top 1  U.cName , count(DISTINCT T.tID) as total
            from Users U, Tweets T
            WHERE U.ID=T.uID
            group by u.cName
            order by total desc) theBest;";

$sql3="select distinct cast((1.0*Corona.numCorona)/total.allTweets as decimal(10,2)) as ratio
        from (select count(DISTINCT W.tID) as numCorona
                from words W
                where W.content like '%corona%') Corona,
             (select count(distinct T.tID) as allTweets
                from Tweets T) total;";

$sql4 ="select theBest.content
        from (select top 1  W.content, count(DISTINCT W.tID) as total
            from Words W
            where W.content like '#%'
            group by W.content
            order by total desc) theBest;";

$result1 = sqlsrv_query($conn, $sql1);
$result2 = sqlsrv_query($conn, $sql2);
$result3 = sqlsrv_query($conn, $sql3);
$result4 = sqlsrv_query($conn, $sql4);
$row1 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
$row2 = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC);
$row3 = sqlsrv_fetch_array($result3, SQLSRV_FETCH_ASSOC);
$row4 = sqlsrv_fetch_array($result4, SQLSRV_FETCH_ASSOC);


echo "<table border='1' style=color:snow; width=70% align=\"center\">";
echo "<tr><th>Most Active Twitter</th><th>Most Active Country</th><th>Ratio of Corona Tweets</th><th>Most Frequent Hashtag Word</th></tr>
<tr><th>".$row1['uID'] ."</th><th>".$row2['cName'] ."</th><th>0".$row3['ratio'] ."</th><th>".$row4['content']."</th></tr>";
echo "</table>";
?>

</body>
</html>


