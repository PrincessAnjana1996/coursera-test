<!DOCTYPE html>
<html>
<head>
    <title>PHP Test Page</title>

<style>
    .error{
        color: red;
    }
</style>
</head>
<body>
<?php

    $nameErr = $emailErr = $genderErr = $websiteErr = " ";
    $name = $email = $geder = $website = $comment = " ";
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["name"])) 
        {
            $nameErr = "Name is required";
        }
        else
        {
            $name = test_input($_POST["name"]);

            if(!preg_match("/^[a-zA-Z ]*$/",$name))
            {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if(empty($_POST["email"]))
        {
            $emailErr = "Email is required";
        }
        else
        {
            $email = test_input($_POST["email"]);

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $emailErr = "Invalid email format";
            }
        }

        if(empty($_POST["website"]))
        {
            $website = " ";
        }
        else
        {
            $website = test_input($_POST["website"]);
            if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website))
            {
                $websiterErr = "Invalid URL";
            }
        }
        if(empty($_POST["comment"]))
        {
            $comment = "";
        }
        else
        {
            $comment = test_input($_POST["comment"]);
        }

        if(empty($_POST["gender"]))
        {
            $genderErr = "Gender is required";
        }
        else
        {
            $gender = test_input($_POST["gender"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<h2> PHP form validation example </h2>
<p><span class="error"> *required field </span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF]);?>">

Name: <input type= "text" name="name" value="<?php echo $name;?>">
<span class="error"> * <?php echo $emailErr;?></span>

<br><br>

Email: <input type="text" name="email" value="<?php echo $email;?>">
<span class="error"> * <?php echo $emailErr;?></span>

<br><br>

Website: <input type="text" name="website" value="<?php echo $website;?>">
<span class="error"><?php echo $websiteErr;?></span>

<br><br>

Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>

<br><br>

Gender: 

<input type="radio" name="gender" <?php if(isset($gender) && $gender == "female") echo "checked";?>
value="female">Female

<input type="radio" name="gender" <?php if(isset($gender) && $gender == "male") echo "checked";>
value="male">Male

<input type="radio" name="gender" <?php if(isser($gender) && $gender == "other") echo "checked";>
value="other">Other

<span class="error">* <?php echo $genderErr;?></span>

<br><br>

<input type="submit" name="submit" value="Sunbmit">

</form>
</body>
</html>