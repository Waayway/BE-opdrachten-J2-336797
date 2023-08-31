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
        <div>
            <label for="instructeur">Instructeur:</label>
            <select name="instructeur" id="instructeur" >
                <?php 
                foreach ($data["instructeurs"] as $row) {
                    echo $row->id;
                    echo $data["voertuig"]->instructeurID;
                    $selected = $row->id == $data["voertuig"]->instructeurID ? "selected" :"";
                    echo "<option value='$row->id' $selected>$row->voornaam $row->tussenvoegsel $row->achternaam</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="typevoertuig">Type voertuig:</label>
            <select name="typevoertuig" id="typevoertuig">
                <?php 
                foreach ($data["typevoertuigen"] as $row) {
                    $selected = $row->id == $data["voertuig"]->typevoertuigID ? "selected" :"";
                    echo "<option value='$row->id' $selected>$row->typevoertuig</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="type">Type:</label>
            <input type="text" name="type" id="type" value="<?= $data["voertuig"]->type ?>">
        </div>
        <div>
            <label for="bouwjaar">Bouwjaar:</label>
            <input type="date" name="bouwjaar" id="bouwjaar" value="<?= $data["voertuig"]->bouwjaar ?>">
        </div>
        <div>
            <label for="brandstof">Brandstof:</label>
            <input <?= $data["voertuig"]->brandstof == "Benzine" ? "checked" : "" ?> type="radio" name="brandstof" id="benzine" value="benzine" <?= $data["voertuig"]->brandstof == "benzine" ? "checked" : "" ?>>
            <label for="benzine">Benzine</label>
            <input <?= $data["voertuig"]->brandstof == "Diesel" ? "checked" : "" ?> type="radio" name="brandstof" id="diesel" value="diesel" <?= $data["voertuig"]->brandstof == "diesel" ? "checked" : "" ?>>
            <label for="diesel">Diesel</label>
            <input <?= $data["voertuig"]->brandstof == "Elektrisch" ? "checked" : "" ?> type="radio" name="brandstof" id="elektrisch" value="elektrisch" <?= $data["voertuig"]->brandstof == "elektrisch" ? "checked" : "" ?>>
            <label for="elektrisch">Elektrisch</label>
        </div>
        <div>
            <label for="kenteken">Kenteken:</label>
            <input type="text" name="kenteken" id="kenteken" value="<?= $data["voertuig"]->kenteken ?>">
        </div>
        <input type="hidden" name="id" value="<?= $data["voertuig"]->id ?>">
        <input type="submit" value="Wijzig">
    </form>
</body>
</html>