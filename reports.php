=<?php
        ini_set("session.cookie_domain", ".cis355.com");
        session_start();
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
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body>
        <div class="col-md-12" style="background-color: tan; border-bottom: 2px solid black; box-shadow: 3px 3px 5px #888888;">
                 <a href="Startup.html"><img src="TeacheratiLogo.png" style="margin-top: 5px;width:250px;height:90px;"></a>
                <?php
                        if ($_SESSION["user"] != '')
                        {
                                $user = $_SESSION['user'];
                                echo '<p style="font-size:18px; float: right; margin-top: 40px; margin-right: 20px;">Welcome <b>' . $user . '</b>!</p>';
                        }

                        else
                        {
                                 echo '<form class="navbar-form navbar-right" style="margin-top: 35px;" method="POST" action="login.php">
                                <input type="text" size="9" name="username" class="form-control" placeholder="Username">
                                <input type="password" size="9" name="password" class="form-control" placeholder="Password">
                                <button type="submit" name="loginSubmit" class="btn btn-success">Submit</button>
                                </form>';
                        }
                ?>
                <br>
                <br>
        </div>
        <div class="col-md-12">
        <br/>
<?php

$hostname="localhost";
$username="CIS355ysaljoha";
$password="ysaljoha498889";
$dbname="CIS355ysaljoha";
$usertable="reports";


$mysqli = new mysqli($hostname, $username, $password, $dbname);
checkConnect($mysqli);

if($mysqli)
{
        $dTable = true;
        if($_POST["hid"] != "")
        {
                $newID = $_POST['hid'];
                deleteRecord($mysqli);
                displayTable($mysqli);
                $dTable = false;
        }

        if($_POST['uid'] != "" && isset($_POST['update']))
        {
                $index = $_POST['uid'];
                global $usertable;
                
                if($result = $mysqli->query("SELECT * FROM $usertable WHERE id = $index"))
                {
                        while($row = $result->fetch_row())
                        {
                                echo '        <br>
                                                <div class="col-md-4">
                                                <form name="basic" method="POST" action="reports.php">
                                                        <table class="table table-condensed" style="border: 1px solid #dddddd; border-radius: 5px; box-shadow: 2px 2px 10px;">
                                                                <tr><td colspan="2" style="text-align: center; border-radius: 5px; color: white; background-color:#333333;"><h2>Reports Form</h2></td></tr>
                                                                <tr><td></td><input type="hidden" name="id" value=' . $row[0] . '" size"11"></td></tr>
                                                                <tr><td>Report Name: </td><td><input type="edit" name="reportname" value="' . $row[1] . '" size="300"></td></tr>
                                                                <tr><td>Report Query: </td><td><input type="edit" name="reportquery" value="' . $row[2] . '" size="300"></td></tr>
                                                                <tr><td>Person: </td><td><input type="edit" name="persons_id" value="' . $row[3] . '" size="11"></td></tr>
                                                                <tr><td>Date Created: </td><td>'.$row[4].'</td></tr>';

                                                                
                                                                $mysqli = new mysqli($hostname, $username, $password, $dbname);
                                                                
                                                                // Init statement
                                                                $stmt = $mysqli->stmt_init();
                                                                
                                                                // Set Select query
                                                                $sql = "SELECT * FROM school";
                                                                
                                                                // Init school variable
                                                                $dbId = "";
                                                                $school = "";
                                                                
                                                                
                                                                // If the statement was prepared
                                                                if($stmt = $mysqli->prepare($sql))
                                                                {
                                                                        // Execute statement
                                                                        if($stmt->execute())
                                                                        {
                                                                                // Bind query result
                                                                                $stmt->bind_result($dbId, $school);
                                                                                
                                                                                // Fetch the statement
                                                                                while ($stmt->fetch())
                                                                                {
                                                                                        // Output the schools
                                                                                        echo "<option value='" . $dbId ."'>" . $school . "</option>";
                                                                                }
                                                                        }
                                                                }
                                                
                                                                $mysqli->close();
                                                                
                                                                echo '</select></td></tr>
                                                                <tr><td><input type="submit" name="submitUpdate" class="btn btn-primary" value="Update Entry"></td>
                                                                        <td style="text-align: right;"><input type="reset" class="btn btn-danger" value="Reset Form"></td></tr>
                                                        </table>

                                                        <input type="hidden" name="index" value="' . $row[0] . '">
                                                        <input type="hidden" id="hLoc" name="locId" value="' . $row[9] . '">
                                                </form>
                                                <script>
                                                        document.getElementById("loc").selectedIndex = ' . $row[9] .' - 1; 
                                                        function setLocId()
                                                        {
                                                                var selectBox = document.getElementById("loc");
                                                                document.getElementById("hLoc").value = selectBox.options[selectBox.selectedIndex].value;
                                                        }
                                                </script>
                                        </div>';
                        }
                        $result->close();
                        $dTable = false;
                }
        }
        
        if(isset($_POST['submitUpdate']))
        {
                $id = $_POST['id'];
                $reportname = $_POST['reportname'];
                $reportquery = $_POST['reportquery'];
                $persons_id = $_POST['persons_id'];
                $date_created = $_POST['date_created'];
                
                updateRecord($mysqli);
                displayTable($mysqli);
                $dTable = false;
        }
        
        if(isset($_POST['submit']))
        {   
                $id = $_POST['id'];
                $reportname = $_POST['reportname'];
                $reportquery = $_POST['reportquery'];
                $persons_id = $_POST['persons_id'];
                $date_created = $_POST['date_created'];
                
                createTable($mysqli);
                insertRecord($mysqli);
                displayTable($mysqli);
                $dTable = false;
        }
        if (isset($_POST['viewItem']))
        {
                viewRecord($mysqli);
                $dTable = false;
        }
        if($dTable)
        {
                displayTable($mysqli);
        }
}

function displayTable($mysqli)
{
        echo         '<div class="col-md-12"><form action="reports.php" method="POST"><table class="table table-condensed" style="border: 1px solid #dddddd; border-radius: 5px; box-shadow: 2px 2px 10px;">
                        <tr><td colspan="11" style="text-align: center; border-radius: 5px; color: white; background-color:#333333;"><h2 style="color: white;">Reviews Form</h2></td></tr>
                        <tr style="font-weight:800; font-size:20px;"><td>Report Name</td><td>Report Query</td><td>Persons Id</td><td>Date Created</td>';
        
        populateTable($mysqli);

        echo    '</table><input type="hidden" id="hid" name="hid" value=""><input type="hidden" id="uid" name="uid" value=""></form>';
        
        //if($_SESSION['user'] != "")
        {
                echo '<a href="insertReport.php" class="btn btn-primary">Add an Entry</a><br></div>';
        }
        
        echo "<a href='bio.html'>About Me</a><script>
                        function setHid(num)
                        {
                                document.getElementById('hid').value = num;
                    }
                    function setUid(num)
                        {
                                document.getElementById('uid').value = num;
                    }
                 </script>";
        
}

function checkConnect($mysqli)
{
    
    /* check connection */
    if ($mysqli->connect_errno) {
        die('Unable to connect to database [' . $mysqli->connect_error. ']');
        exit();
    }
}

function populateTable($mysqli)
{
        global $usertable;
        
        $i = 0;
        
        if($result = $mysqli->query("SELECT * FROM $usertable"))
        {
                while($row = $result->fetch_row())
                {
                        echo '<tr><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . 
                                 '</td><td>' . $row[4] . '</td>';
                                 
                                 
                        if ($row[8] == $_SESSION['id'])
                        {
                                echo '<td style="width: 213px;"><input name="delete" type="submit" class="btn btn-danger" value="Delete" onclick="setHid(' . $row[0] .')" /> <input type="submit" name="update" class="btn btn-primary" value="Update" onclick="setUid(' . $row[0] . ');" />';
                        }
                        else
                        {
                                echo "<td>";
                        }
                        echo '<input style="float: right;" name="viewItem" type="submit" class="btn btn-success" value="View" onclick="setUid(' . $row[0] .')" /></td> ';
                        $i++;
                }
        }
        $result->close();
}
function createTable($mysqli)
{
    global $usertable;
    /* test select via object */
    if($result = $mysqli->query("select id from $usertable limit 1"))
    {
        /* fetch results as object (since there is only 1 row, i dont need a while loop here). */
        $row = $result->fetch_object();
                /** The fields in the results come back as properties of the fetched object. 
                *   Here since I selected the "id", the row has a property called "id".
                */
                $id = $row->id;
        $result->close();
    }
    
    /* if nothing in $id*/
    if(!$id)
    {
            $sql = "CREATE TABLE $usertable (id INT NOT NULL AUTO_INCREMENT,PRIMARY KEY( id ),";
            $sql .= "reportname VARCHAR(300),";
            $sql .= "reportquery VARCHAR(300),";
            $sql .= "persons_id INT(11),";
            $sql .= "date_created datetime,";
            $sql .= ")";

        if($stmt = $mysqli->prepare($sql))
        {
            /* execute prepared statement */
            $stmt->execute();
        }
    }  
}

function insertRecord($mysqli)
{
    /* vars from the post data that we will use to bind */
    global $id, $reportname, $reportquery, $persons_id, $date_created, $usertable;
    
    /* Initialise the statement. */
    $stmt = $mysqli->stmt_init();
    /* Notice the two ? in values, these will be bound parameters*/
    if($stmt = $mysqli->prepare("INSERT INTO $usertable (id,reportname,reportquery,persons_id,date_created) VALUES (NULL, '$reportname', '$reportquery', '$persons_id', '$date_created')"))
    {
            /* Bind parameters. Types: s = string, i = integer, d = double,  b = blob, etc... */
            //$stmt->bind_param('sssssssii', $type, $id, $reportname, $reportquery, $persons_id, $date_created, $descript, $_SESSION['id'], $lid);

            /* execute prepared statement */
            $stmt->execute();
            /* close statment */
            $stmt->close();
    }
}

function deleteRecord($mysqli)
{
        /* vars from the post data that we will use to bind */
    global $newID, $usertable;
    
    /* Initialise the statement. */
    $stmt = $mysqli->stmt_init();
    /* Notice the two ? in values, these will be bound parameters*/
    if($stmt = $mysqli->prepare("DELETE FROM $usertable WHERE id=?"))
    {
            /* Bind parameters. Types: s = string, i = integer, d = double,  b = blob, etc... */
            $stmt->bind_param('i', $newID);

            /* execute prepared statement */
            $stmt->execute();
            /* close statment */
            $stmt->close();
    }
}

function updateRecord($mysqli)
{
         global $type, $id, $reportname, $reportquery, $persons_id, $date_created, $descript, $index, $lid, $usertable;
    
    /* Initialise the statement. */
    $stmt = $mysqli->stmt_init();
    /* Notice the two ? in values, these will be bound parameters*/
    if($stmt = $mysqli->prepare("UPDATE $usertable SET reportname = '$reportname', reportquery = '$reportquery', persons_id = '$persons_id', date_created = '$date_created' WHERE id = '$id'"))
    {
            /* Bind parameters. Types: s = string, i = integer, d = double,  b = blob, etc... */
            //$stmt->bind_param('sssssssiii', $type, $id, $reportname, $reportquery, $persons_id, $date_created, $descript, $_SESSION['id'], $lid, $index);

            /* execute prepared statement */
            $stmt->execute();
            /* close statment */
            $stmt->close();
    }
}

function viewRecord($mysqli)
{
        $index = $_POST['uid'];
        global $usertable;
        $result = $mysqli->query("SELECT * FROM $usertable WHERE id = $index");
        
        if($result)
        {
                while($row = $result->fetch_row())
                {
                        echo '        <br>
                                        <div class="col-md-4">
                                        <form name="basic" method="POST" action="reports.php">
                                                <table class="table table-condensed" style="border: 1px solid #dddddd; border-radius: 5px; box-shadow: 2px 2px 10px;">
                                                        <tr><td colspan="2" style="text-align: center; border-radius: 5px; color: white; background-color:#333333;"><h2>Report</h2></td></tr>
                                                        <tr><td><b>Report Name: </b></td><td>' . $row[1] . '</td></tr>
                                                        <tr><td><b>Report Query: </b></td><td>'. $row[2] . '</td></tr>
                                                        <tr><td><b>Person: </b></td><td>' . $row[3] . '</td></tr>
                                                        <tr><td><b>Date Created: </b></td><td>' . $row[4] . '</td></tr>
                                                </table>
                                        </form>
                                        <a href="reports.php" class="btn btn-primary">Display Database</a>
                                </div>';
                }
                $result->close();
        }
}

?>
</div>
</div>
</body>
</html>
