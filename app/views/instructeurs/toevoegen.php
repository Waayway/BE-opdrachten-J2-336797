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
                <th>Wijzigen</th>
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
                        <td>
                            <a href="<?= URLROOT ?>/voertuigen/edit/<?= $row->id ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                            </svg>
                        </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </form>
        </tbody>
    </table>
</body>

</html>