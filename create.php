<?php
session_start();
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $email = $info = $password = '';
$name_err = $email_err = $info_err = $pass_err =  '';
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an e-mail.";     
    } else{
        $email = $input_email;
    }
    
    // Validate info
    $input_info = trim($_POST["info"]);
    if(empty($input_info)){
        $info_err = "Please enter the correct info.";     
    } else{
        $info = $input_info;
    }

    $input_password = trim($_POST["password"]);
    if (empty($input_password)){
        $password_err = "Please enter password";
    } else{
        $password = $input_password;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($info_err) && empty($password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, email, info, password, role) VALUES (:name, :email, :info, :password, :role)";

 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":info", $param_info);
            $stmt->bindParam(":password", password_hash($password, PASSWORD_DEFAULT));
            $stmt->bindParam(":role", $param_role);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_info = $info;
            $param_password = $password;

            if (isset($_POST["admin"]) && $_POST["admin"] == true){
                $param_role = "admin";
            } else{
                $param_role = "user";
            }

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($pass_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $pass_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($info_err)) ? 'has-error' : ''; ?>">
                            <label>Info</label>
                            <input type="text" name="info" class="form-control" value="<?php echo $info; ?>">
                            <span class="help-block"><?php echo $info_err;?></span>
                        </div>

                        <?php
                            if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){
                            echo "<div class=\"form-group\">";
                            echo "<label>Admin</label>";
                            echo "<br/>";
                            echo "<input type=\"checkbox\" name=\"admin\" value=false;>";
                            echo "Make Admin";
                            echo "</div>";
                            }
                        ?>


                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>