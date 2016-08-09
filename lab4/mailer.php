<?php session_start();


if($_SESSION['logged_in']) {
}
if($_POST) {
    if(!isset($_POST['email']) || empty($_POST['email']) )
    {
        $_SESSION['error'] = 'Fail to schedule. Email is missing.';
        header("Location: signin.php"); //go back to form scheduler
    }

    else if(!isset($_POST['message']) || empty($_POST['message']) )
    {
        $_SESSION['error'] = 'Fail to schedule. Message is missing.';
        header("Location: signin.php"); //go back to form scheduler
    }

    else if(!isset($_POST['selectyear']) || empty($_POST['selectyear']) )
    {
        $_SESSION['error'] = 'Fail to schedule. Year is missing.';
        header("Location: signin.php"); //go back to form scheduler
    }

    else if(!isset($_POST['selectMonth']) || empty($_POST['selectMonth']) )
    {
        $_SESSION['error'] = 'Fail to schedule. Month is missing.';
        header("Location: signin.php"); //go back to form scheduler
    }

    else if(!isset($_POST['selectday']) || empty($_POST['selectday']) )
    {
        $_SESSION['error'] = 'Fail to schedule. Day is missing.';
        header("Location: signin.php"); //go back to form scheduler
    }

    else if(!isset($_POST['selecthour']) || empty($_POST['selecthour']) )
    {
        $_SESSION['error'] = 'Fail to schedule. Hour is missing.';
        header("Location: signin.php"); //go back to form scheduler
    }

    else if(!isset($_POST['selectmin']) || empty($_POST['selectmin']) )
    {
        $_SESSION['error'] = 'Fail to schedule. Minute is missing.';
        header("Location: signin.php"); //go back to form scheduler
    }

    else
    {
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

        $emailadd = $_POST['email'];
        $mesg = $_POST['message'];
        $year = $_POST['selectyear'];
        $month = $_POST['selectMonth'];
        $day = $_POST['selectday'];
        $hour = $_POST['selecthour'];
        $min = $_POST['selectmin'];
        $user_id = $_SESSION['user_id'];

        $d1 = mktime($hour, $min, '00', $month, $day, $year);
        $d2 = date('Y/m/d H:i:s ', $d1);
        date_default_timezone_set("America/Los_Angeles");
        $now = date('Y/m/d H:i:s');

        if ($d2 < $now)
        {
            $_SESSION['error'] = 'Fail to schedule. The time that you chose is already been passed.';
            header("Location: signin.php");
        }

        else
        {
            $query = "INSERT INTO msg_tb (userid, email, msg, timedate) VALUES (\"$user_id\", \"$emailadd\", \"$mesg\", \"$d2\")";
            $result = mysql_query($query);

            if($result)
            {
                $_SESSION['success'] = 'Yay! You scheduled it! Would you like to schedule another one?';
                header("Location: signin.php");
            }

            else
            {
                $_SESSION['error'] = 'Hmmm.. Could not insert record into the table. Please check your input.';
                header("Location: signin.php");
            }
        }
    }
}