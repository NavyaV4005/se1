<!DOCTYPE html>
<html>
<head>
    <title>REGISTRATION FORM</title>
    <style TYPE = "text/css">
        *{
            font-family: Tahoma, Geneva, sans-serif;
        }
        .outerbox_register
        {
            width: 300px;
            height: auto;
            margin: auto;
            padding: 10px;
            border: solid 1px #83ffcb;
            background-color: #d1ffec;
            border-radius: 8px;
        }
        .title
        {
            font-size: 30px;
            font-weight: bold;
            color: blue;
            text-align: center;
            margin-bottom: 10px;
            margin-top: 15px;
            text-decoration: underline;
        }

        .register_div
        {
            margin-right: 10px;
            margin-left: 10px;
            padding: 5px 0 5px;
        }

        .register
        {
            position: relative;
            padding: 7px;
            width: 265px;
            font-size: 18px;
            border-radius: 8px;
            border: none;
        }

        .submit_div
        {
            margin-right: 10px;
            margin-left: 10px;
            padding: 5px 0 5px;
        }

        .submit
        {
            color: white;
            font-size: 18px;
            background-color: #75b1ff;
            width: 280px;
            border: none;
            border-radius: 8px;
        }

        .error
        {
            font-size: 18px;
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>

    <script type ="text/javascript">
        function checkempty(elem, helperMsg)
        {
            if(elem.value.length == 0)
            {
                alert(helperMsg);
                elem.focus();
                return false;
            }
            return true;
        }

    </script>
</head>

<body>

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

$errorempty = "";

if ($_POST)
{
    if (empty($_POST["username"]) || empty($_POST["pwd"])) {
        $errorempty = "Please fill required field";
    }
    else if (isset($_POST['username']) && isset($_POST['pwd']))
    {
        $username = $_POST['username'];
        $password = $_POST['pwd'];

        /*
        if (preg_match('/[0-9]/', $password) == 0 || preg_match('/[a-zA-Z]', $password) == 0 || preg_match('/[!@#$%^&*-+=_]/', $password) )
        {
            $errorempty = "Password must contains at least one number, one letter, and one special characters";
        }
        */

     //   else
     //   {
            $query = "INSERT INTO user_tb (username, password) VALUES ('" . $username . "', '" . $password . "')";
            $result = mysql_query($query);

            if($result)
            {
                echo "<br/><div style='color:lightseagreen; text-align: center; font-weight: bold; font-size: 30px; margin-top: 25px;'>User Created Successfully.</div>";
            }
     //   }
    }
}
?>
<h3 style = 'text-align: center'>Sign In <a href="signin.php">HERE</a></h3>
<form name="registration" method="post" action="register.php" onsubmit="return validation()">
    <div class = outerbox_register>
        <div class = "title">Registration Form</div>
        <div class = "register_div">
            <input type = "text" class = "register" name = "username" placeholder="Username (*Required)">
            <input type = "text" class = "register" name = "pwd" placeholder="Password (*Required)">
        </div>
        <div class="submit_div">
            <input type="submit" name="submit" value="Register" class = "submit">
            <span class = error> <?php echo "</br><div style='text-align: center'>$errorempty</div>"?></span>
        </div>
    </div>
</form>
</body>
</html>
