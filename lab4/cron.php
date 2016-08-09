<style type = "text/css">
    *{
        font-family: Tahoma, Geneva, sans-serif;
    }
    </style>

<?php
$hostname="localhost"; //local server name default localhost
$username="bbobbo216";  //mysql username default is root.
$password="tkfkdgo1";       //blank if no password is set for mysql.
$database="lab4";  //database name which you created

$con=mysql_connect($hostname,$username,$password);
$db = mysql_select_db('lab4', $con);

if(!$con)
    die('Connection Failed'.mysql_error());


if (!$db)
    die('Database connection failed'.mysql_error());

date_default_timezone_set("America/Los_Angeles");
$now = date('Y/m/d H:i:s');
echo nl2br ("<div style='color:#20B2AA; text-align: center; font-size: 20px;margin-top: 10px;'>Current Time: " . $now);

$selectsent = "SELECT * FROM msg_tb WHERE sent = '0' and timedate < \"$now\"";
$result1 = mysql_query($selectsent);
if (mysql_num_rows($result1))
{
    echo nl2br ("<div style='color:green; text-align: center; font-size: 30px;'>\nSome Schedules has been sent since some schdules' time has been passed");
}
else
{
    echo nl2br ("<div style='color:red; text-align: center; font-size: 30px;'>\nThere is no schedule has been sent");
}

$updatesent = "UPDATE msg_tb SET sent = 1 WHERE timedate < \"$now\" and sent = '0'";
$result2 = mysql_query($updatesent);
?>

    <div>
        <h5 style = 'text-align: center;font-size: 20px;color: #20B2AA; margin-top: 10px; '>
            <a href="logout.php">Log Out</a>
             |
            <a href="signin.php">Back to scheduler tool </a></h5>
    </div>

<?php
echo nl2br ("<div style='color:#20B2AA; text-align: left; font-size: 20px;'>\nRecords that are going to send in the future");

$query = "SELECT * FROM msg_tb WHERE timedate > \"$now\" and sent = '0'";
$result = mysql_query($query);

while($row = mysql_fetch_assoc($result))
{

    $email_to_send = $row['email'];
    $message_to_send = $row['msg'];

    //the whole record from db:
    echo "<div style='color:black; text-align: left;font-size: 12px;'><pre>"; print_r($row);
}