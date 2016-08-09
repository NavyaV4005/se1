<style type = "text/css">
    *{
        font-family: Tahoma, Geneva, sans-serif;
    }
    .logindiv
    {
        border-radius: 8px;
        width: 350px;
        height: auto;
        margin: auto;
        box-shadow: 0 0 30px #2d7699;
        padding-top: 20px;
        background-color: #d1ffec;
    }

    .title
    {
        font-size: 30px;
        font-weight: bold;
        color: blue;
        text-align: center;
        text-decoration: underline;
    }

    .logindivdiv
    {
        margin-right: 10px;
        margin-left: 10px;
        margin-top: 0;
        padding: 10px 10px 0;
    }

    .login
    {
        position: relative;
        padding: 7px;
        width: 310px;
        font-size: 18px;
        border-radius: 8px;
        border: none;
    }

    .loginbutton
    {
        margin-right: 20px;
        margin-left: 20px;
        padding: 10px 0 10px;
    }

    .submitdiv
    {
        color: white;
        font-size: 18px;
        background-color: #75b1ff;
        width: 310px;
        border: none;
        border-radius: 8px;
    }

    .cronbutton
    {
        padding: 10px 0 5px;
    }

    .cron
    {
        color: white;
        font-size: 18px;
        background-color: #75b1ff;
        width: 310px;
        border: none;
        border-radius: 8px;
    }

    .seecronjobpage
    {
        padding: 0;
    }

    .cron1
    {
        color: white;
        font-size: 18px;
        background-color: #75b1ff;
        margin-bottom: 10px;
        width: 310px;
        border: none;
        border-radius: 8px;
    }

    select
    {
        font-size: 20px;
    }


</style>

<?php session_start();
if($_POST)
{
    $valid = true;

    if(!isset($_POST['username']) || empty($_POST['username']) )
    {
        $valid = false;
    }


    if(!isset($_POST['pwd']) || empty($_POST['pwd']) )
    {
        $valid = false;
    }


    if($valid)
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

        $username = $_POST['username'];
        $password = $_POST['pwd'];

        $query = "SELECT * FROM  user_tb where username = \"$username\" AND password = \"$password\"";

        $result = mysql_query($query);

        $row = mysql_fetch_assoc($result);

        if( $row )
        {
                $_SESSION['user_id'] = $row['userid'];
                $_SESSION['logged_in']= true;
                $_SESSION['user_name']=$username;

                header("Location: signin.php");
        }

        else
        {
            echo "<div style='color:red; text-align: center; font-weight: bold; font-size: 30px; margin-top: 25px;'>
            Wrong credentials. Please try again or register!</div>";
        }
    }

    else
    {
        echo "<div style='color:red; text-align: center; font-weight: bold; font-size: 30px; margin-top: 25px;'>Please check your input.</div> ";
    }
} ?>

<?php
    if(!isset($_SESSION['logged_in']))
    { ?>
        <h3 style = 'text-align: center; margin-top: 25px;'>Don't have acccount? Register <a href="1.php">HERE</a></h3>

        <form method="post" action="">
            <div class = logindiv>
                <div class = title>SIGN IN</div>
                <div class = logindivdiv>
                    <input type="text" name="username" placeholder="Enter your username" class = "login">
                    <input type="text" name="pwd" placeholder="Enter your password" class = "login">
                </div>
                <div class = "loginbutton">
                    <input type="submit" value="Login" class = "submitdiv">
                </div>
            </div>
        </form>
    <?}

// if user LOGGED IN then display application
    else
    {
        ?>
        <h1 style = 'text-align: center; margin-top: 20px'> Welcome back: <?=$_SESSION['user_name']?> <a style = 'font-size: 18px;' href="logout.php">Log Out</a></h1>

        <?php
            if(isset($_SESSION['error']))
            {
                echo "<div style='color:red; text-align: center; font-size: 20px;'> " .$_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            }
        ?>

        <?php
        if(isset($_SESSION['success']))
        {
            echo "<div style='color:green; text-align: center; font-size: 20px;'> " .$_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }

        ?>
        <br/>
        <form class = 'logindiv' action="mailer.php" method="post">
            <div class = title>Scheduler Tool</div>

            <div class = 'logindivdiv'>
                <input type="email" name="email" placeholder="Please provide email" class = 'login'>
                <input type="text" name="message" placeholder="Your message goes here... " class = 'login'>
                <br/>
                Year: <select class = "year" id = "yearid" name ="selectyear">
                    <option value="">Select Year..</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                </select>
                <br/>
                Month: <select class = "month" id = "monthid" name="selectMonth">
                    <option value="">Select Month..</option>
                    <option value="01">Janurary</option>
                    <option value="02">Faburary</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <br/>
                Day: <select class = "day" id="dayid" name="selectday">
                    <option value = "">Select Day..</option>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07">7</option>
                    <option value="08">8</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <br/>

                Time: <select class = "time" id ="timeid" name="selecthour">
                    <option value="">Hour</option>
                    <option value="00">0</option>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07">7</option>
                    <option value="08">8</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>

                <select class = "time" id = "timemin" name = "selectmin">
                    <option value="">Minute</option>
                    <option value = "00">:00</option>
                    <option value = "30">:30</option>
                </select>
                <br/>

                <div class = 'cronbutton' style = 'margin-right: 10px;'>
                    <input class = 'cron' type="submit" value="Schedule Cron Job Email">
                </div>

                <div class = 'seecronjobpage'>
                        <input type="button" value="Click here to see Cron Job" class = 'cron1' onclick = "window.location.href='cron.php'">
                </div>
            </div>
        </form>
    <?} ?>
