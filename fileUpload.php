<?php
 if (isset($_POST['submit'])){
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    $allowed = ['gif', 'jpg', 'png', 'jpeg'];
    $fileExt = explode('.', $fileName);
    $actualFileName = strtolower(end($fileExt));

    
    if (empty($fileName)){
        $errFile = "<span style='color: red'>Please select a file to upload</span>";
    } elseif (!in_array($actualFileName, $allowed)){
        $validFile = "<span style='color: red' >Please select a valid file format to upload</span>";
    } else {
        if (!is_dir('uploads')){
            mkdir('uploads');
        }
        
        // creating file name
        $newFileName = str_shuffle(date('HisAFdYDyl')).uniqid('', true) . '.' . $actualFileName;

        // uploading file
        $uploadFile = move_uploaded_file($fileTmpName, 'uploads/' . $newFileName);
        
        if ($uploadFile){
            $crrFile = "<span style='color: green' >File uploaded successfully</span>";
        } else {
            echo "Something went wrong";
        }
    }
}
?>

<form method="post" enctype="multipart/form-data" >
    <input type="file" name="file">
    <input type="submit" value="Upload" name="submit">
</form>
<br>
<?= $errFile ?? $validFile ?? $crrFile ??  null; ?>


<style>
    input{
        background-color: #ddd;
        padding: 10px;
        border-radius: 3px;
    }
    form, span{
        width: 350px;
        margin: auto;
        margin-top: 50px;
    }
    span{
        display: block;
        width: 350px;
        margin: auto;
    }
</style>