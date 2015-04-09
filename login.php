<?php

    ini_set("session.cookie_domain", ".cis355.com");
        
        // Start the session
        session_start();
        
        // Set an error message
        $error = "";
        
        // If the user pressed the Submit button
        if(isset($_POST['loginSubmit']))
        {
                // This will not be used if successful login
                $error = '<div class="alert alert-danger" role="alert"><b>Login Error:</b> Please enter a valid username and password.</div>';
                
                // Required Databsae Information
                
				$hostname="localhost";
                $username="CIS355ysaljoha";
                $password="ysaljoha498889";
                $dbname="CIS355ysaljoha";
                
                // Entered user information
                $uname = $_POST['username'];
                $pass = $_POST['password'];
                
                // Session Information
                $dataID = "";
                $dataUname = "";
                $dataLocation = "";
                
                // Create a mysqli object
                $mysqli = new mysqli($hostname, $username, $password, $dbname);
                
                // Init statement
                $stmt = $mysqli->stmt_init();
                
                // Create query
                $sql = "SELECT id, email, role, secondary_role FROM persons WHERE email = ? AND password_hash = ?";
                
                if($stmt = $mysqli->prepare($sql))
                {
            // Bind params
            $stmt->bind_param('ss', $uname, $pass);

                        // Execute statement
            if($stmt->execute())
            {
                                // Bind query result
                                $stmt->bind_result($dataID, $dataUname, $dataRole, $dataSecondaryRole);
                                
                                // Fetch the statement
                                if ($stmt->fetch())
                                {
                                        // Set SESSION vars
                                        $_SESSION["id"] = $dataID;
                                        $_SESSION["user"] = $dataUname;
                                        $_SESSION["role"] = $dataRole;
                                        $_SESSION["secondary_role"] = $dataSecondaryRole;
                                        
                                        // Close statement and mysqli object
                                        $stmt->close();
                                        $mysqli->close();
                                        
                                        // If the user came from the login page, direct them to the landing page
                                        if ($_SERVER['HTTP_REFERER'] == "http://csis.svsu.edu/~ysaljoha/group/startup.html" || $_SERVER['HTTP_REFERER'] == "http://csis.svsu.edu/~ysaljoha/group/login.php" )
                                        {
                                                // Relocate to landing page
                                                header('Location: lessons.php');
                                                exit;
                                        }
                                        
                                        else
                                        {
                                                // Relocate to landing page
                                                header('Location: '. $_SERVER['HTTP_REFERER']);
                                                exit;
                                        }
                                }
                                
                        }
                      
            // Close statement
                        $stmt->close();
                }
                $mysqli->close();
        }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
        <title>Look What I Paid</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="generator" content="Geany 1.23.1" />
        
        <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
        <div class="col-md-12" style="background-color: tan; border-bottom: 2px solid black; box-shadow: 3px 3px 5px #888888;">
                <a href="Startup.html"><img src="TeacheratiLogo.png" style="margin-top: 5px;width:250px;height:90px;"></a>
                <br>
                <br>
        </div>
        <div class="col-md-4"></div>        
        <div class="col-md-4" style="margin-top: 40px;">

                <br/>
                <div class="panel panel-default" style="box-shadow: 2px 2px 7px #888888;">
                        <div class="panel-heading"><b>Login</b></div>
                                <div class="panel-body">
                                <?php
                                        echo '<form method="POST" action="lessons.php">
                                        <input type="text" size="10" name="username" class="form-control" value="'. $uname .'" placeholder="Username">
                                        <input type="password" size="10" name="password" style="margin-top: 5px;" class="form-control" placeholder="Password"><br>
                                        '.$error.'
                                        <button type="submit" name="loginSubmit" style="width: 100%;" class="btn btn-success">Submit</button>
                                </form>';
                                ?>
                                </div>
                </div>
                <a href="startup.html" style="text-decoration: none;"><span class="glyphicon glyphicon-arrow-left" style="padding-right:3px;"></span> Back to Home</a>
                
        </div>
        <div class="col-md-4"></div>
        </div>
        </center>
        </body>
        </html>        
                
                
