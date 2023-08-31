<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= URLROOT ?>style.css">
</head>
<body>
    <h1>Voertuig aanpasen</h1>
    <form action="/voertuigen/edit" method="post">

        <?php 
    $ignore = [
        "id" => "id",
    ];
    $obj = array_diff_key(get_object_vars($data["voertuig"]), $ignore);
    
    foreach ($obj as $key => $value) {
        $name = ucfirst($key);
        echo "<div>";
        echo "<label for='$key'>$name</label>";
        echo "<input type='text' name='$key' id='$key' value='$value'>";
        echo "</div>";
    }
    
    ?>
    </form>
</body>
</html>