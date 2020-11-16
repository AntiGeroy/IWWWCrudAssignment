<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">User Management</h2>
                        <?php

                        if (isset($_SESSION['loggedin'])){
                            echo "<a href=\"logout.php\" class=\"btn btn-success pull-right\">Log Out</a>";
                        }

                        if ((isset($_SESSION['role'])) &&  $_SESSION["role"] == "admin"){
                            echo "<a href=\"create.php\" class=\"btn btn-success pull-right\">Add New User</a>";
                        }

                        ?>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";


                    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != "true"){
                        echo "<p>You are not logged in. You can log in by clicking the button.<p>";
                        echo "<a href=\"login.php\" class=\"btn btn-success \">Log In</a>";
                        exit();
                    }


                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM users";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Name</th>";
                                        echo "<th>E-Mail</th>";
                                        echo "<th>Info</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                if ($_SESSION["role"] == "admin"){
                                    while($row = $result->fetch()){
                                        echo "<tr>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['info'] . "</td>";
                                            echo "<td>";
                                                echo "<a href='read.php?id=". $row['userId'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                                echo "<a href='update.php?id=". $row['userId'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                echo "<a href='delete.php?id=". $row['userId'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                } else{
                                    while($row = $result->fetch()){
                                        if ($row['userId'] == $_SESSION['id']){
                                            echo "<tr>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['info'] . "</td>";
                                            echo "<td>";
                                                echo "<a href='read.php?id=". $row['userId'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                                echo "<a href='update.php?id=". $row['userId'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</td>";
                                        echo "</tr>";
                                        }
                                    }
                                }
                                
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>