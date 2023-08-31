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
    <h1>Door instructeur gebruikte voertuigen</h1>
    <?php
    if (array_key_exists("extra", $data)) {
        if (array_key_exists("success", $data["extra"])) {
            echo "<h1>" . $data["extra"]["success"] . "</h1>";
        }
    }
    ?>
    <p>Naam: <?= $data["instructeur"]->voornaam ?> <?= $data["instructeur"]->tussenvoegsel ?> <?= $data["instructeur"]->achternaam ?></p>
    <p>Datum in dienst: <?= $data["instructeur"]->datumInDienst ?></p>
    <p>Aantal Sterren: <?= str_repeat("✦", $data["instructeur"]->aantalSterren) ?></p>
    <a href="<?= URLROOT ?>instructeurs/toevoegen/<?= $data["instructeur"]->id ?>">Voertuigen toevoegen</a>
    <table>
        <thead>
            <tr>
                <th>Type voertuig</th>
                <th>Type</th>
                <th>Kenteken</th>
                <th>Bouwjaar</th>
                <th>Brandstof</th>
                <th>Rijbewijscategorie</th>
                <th>Toevoegen</th>
            </tr>
        </thead>
        <tbody>
            <form action="" method="post">
                <?php
                foreach ($data["voertuigen"] as $row) {
                ?>
                    <tr>
                        <td><?= $row->typevoertuig       ?></td>
                        <td><?= $row->type               ?></td>
                        <td><?= $row->kenteken           ?></td>
                        <td><?= $row->bouwjaar           ?></td>
                        <td><?= $row->brandstof          ?></td>
                        <td><?= $row->rijbewijscategorie ?></td>
                        <td><button type="submit" name="id" value="<?= $row->id ?>">+</button></td> <!-- Eerste instinct was om een request te sturen met js -->
                    </tr>
                <?php
                }
                ?>
            </form>
        </tbody>
    </table>
</body>

</html>