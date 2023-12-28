<!-- <?php
// if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["displayName"])){
//     echo $_POST["name"]. "<br/>". $_POST["age"]. "<br/>". $_POST["gender"];
// }
// ?> -->

<!-- <form action="" method="post">
    <input type="text" placeholder="name" name="name"><br />
    <input type="text" placeholder="age" name="age"><br />
    <input type="text" placeholder="gender" name="gender"><br />
    <input type="submit" value="Submit" name="displayName">
</form> -->


<?php 

function clean($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}

if(isset($_POST["formsub"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    $name = clean($_POST["name"]);
    $email = clean($_POST["email"]);
    $gender = clean($_POST["gender"] ?? null);
    $skills = $_POST["skills"] ?? null;

    //name
    if(empty($name)){
       $errName = "Name field can't be empty";
    } elseif(!preg_match("/^[A-Za-z. ]*$/", $name)){
        $errName = "Name can only contain letters and spaces";
    } else {
        $crrName = $name;
    }

    //email
    if(empty($email)){
        $errEmail = "Email field can't be empty";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errEmail = "invalid email format";
    } else {
        $crrEmail = $email;
    }

    //gender
    if(empty($gender)){
        $errGender = "Gender can't be empty";
    } else {
        $crrGender = $gender;
    }

    //skills
    if(empty($skills)){
        $errSkills = "Skills can't be empty";
    } else {
        $crrSkills = $skills;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap 5.1.3 cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="<KEY>" crossorigin="anonymous">
    <title>Form Validation</title>


</head>
<body class="p-5 " >
    
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 w-75 mt-5 ">
                <form action="" method="post">
                    <div class="mb-3 form-floating ">
                        <input type="text" placeholder="Your Name" name="name" class="form-control <?= isset($errName) ? "is-invalid" : null ?> <?= isset($crrName) ? "is-valid" : null; ?> " value="<?= $name ?? null; ?>" >
                        <div class="invalid-feedback" >
                            <?= $errName ?? null; ?>
                        </div>
                        <div class="valid-feedback " >
                            <?= $crrName ?? null ?>
                        </div>
                        <label for="">Your Name</label>
                    </div>
                    <div class="mb-3 form-floating ">
                        <input type="text" placeholder="Your Email" name="email" class="form-control <?= isset($errEmail) ? "is-invalid" : null; ?> <?= isset($crrEmail) ? "is-valid" : null; ?> ">
                        <label for="">Your Email</label>
                        <div class="invalid-feedback" >
                            <?= $errEmail ?? null ?>
                        </div>
                        <div class="valid-feedback ">
                            <?= $crrEmail ?? null ?>
                        </div>
                    </div>
                    <div class="form-check-inline border p-3 w-100 rounded <?= isset($errGender) ? "border-danger" : (isset($crrGender) ? "border-success" : null) ?> ">
                        <div class="form-check form-check-inline" >
                            <label class="fw-bold" >Gender :</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="gender" id="male" value="Male" <?= isset($gender) && $gender == "Male" ? "checked" : null ?> >
                            <label class="form-check-label " for="male">Male</label>
                        </div>   
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="gender" id="female" value="Female">
                            <label class="form-check-label" for="female">Female</label>
                        </div> 
                    </div>
                    <div class="<?= isset($errGender) ? "text-danger" : (isset($crrGender) ? "text-success" : null )?>">
                            <?= $errGender ?? $gender ?? null ?>
                     </div>
                    
                     <div class="form-check form-check-inline  border rounded p-3 mt-3 w-100 <?= isset($errSkills) ? "border-danger" : (isset($crrSkills) ? "border-success" : null) ?> ">
                        <div class="form-check form-check-inline">
                            <label class="fw-bold" >Skills :</label>
                        </div>
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input " type="checkbox" name="skills[]" id="HTML" value="HTML" <?= isset($crrSkills) && in_array("HTML", $crrSkills) ? "checked" : null ?> >
                            <label class="form-check-label" for="HTML">HTML</label>
                        </div>
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input " type="checkbox" name="skills[]" id="CSS" value="CSS" <?= isset($crrSkills) && in_array("CSS", $crrSkills) ? "checked" : null ?> >
                            <label class="form-check-label" for="CSS">CSS</label>
                        </div>
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input " type="checkbox" name="skills[]" id="JS" value="JS" <?= isset($crrSkills) && in_array("JS", $crrSkills) ? "checked" : null ?> >
                            <label class="form-check-label" for="JS">JS</label>
                        </div>
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input " type="checkbox" name="skills[]" id="PHP" value="PHP" <?= isset($crrSkills) && in_array("PHP", $crrSkills) ? "checked" : null ?> >
                            <label class="form-check-label" for="PHP">PHP</label>
                        </div>
                     </div>
                     <div class="<?= isset($errSkills) ? "text-danger" : (isset($crrSkills) ? "text-success" : null) ?>" >
                        <?= $errSkills ?? null ?>
                        <?php
                           if (isset($skills)){
                            foreach ($skills as $skill){
                                echo $skill . ", " ;
                            }
                           }
                        ?>
                    </div>

                    <input type="submit" class="btn btn-primary mt-3 " name="formsub" value="Submit">
                </form>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

<!-- bootstrap 5.1.3 js cdn link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="<KEY>" crossorigin="anonymous"></script>

</body>
</html>