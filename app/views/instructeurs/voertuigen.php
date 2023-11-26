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
    <p>Naam: <?= $data["instructeur"]->voornaam ?> <?= $data["instructeur"]->tussenvoegsel ?> <?= $data["instructeur"]->achternaam ?></p>
    <p>Datum in dienst: <?= $data["instructeur"]->datumInDienst ?></p>
    <p>Aantal Sterren: <?= str_repeat("✦", $data["instructeur"]->aantalSterren) ?></p>
    <a href="<?= URLROOT ?>instructeurs/toevoegen/<?= $data["instructeur"]->id ?>">Voertuigen toevoegen</a>
    <?php if ($data["deleted"] == "true") {
        echo "<h1>Voertuig verwijderd</h1>";
    } ?>
    <table>
        <thead>
            <tr>
                <th>Type voertuig</th>
                <th>Type</th>
                <th>Kenteken</th>
                <th>Bouwjaar</th>
                <th>Brandstof</th>
                <th>Rijbewijscategorie</th>
                <th>Wijzigen</th>
                <th>Toegewezen</th>
            </tr>
        </thead>
        <tbody>
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
                    <td>
                        <a href="<?= URLROOT ?>voertuigen/edit/<?= $row->id ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                            </svg>
                        </a>
                        <a href="<?= URLROOT ?>voertuigen/delete/<?= $row->id ?>?type=voertuigen&ins=<?= $data["instructeur"]->id ?>">
                            <svg height= "1em" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                            </svg>
                        </a>
                    </td>
                    <td><?= $row->toegewezenAantal > 1 ? "✔" : "✖" ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?= $data["geen_voertuigen"] ?>
    <a href="<?= URLROOT ?>instructeurs">Terug</a>
</body>

</html>