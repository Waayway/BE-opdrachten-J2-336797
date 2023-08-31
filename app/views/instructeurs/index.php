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
    <h1>Instructeurs in dienst</h1>
    <p>Aantal instructeurs: <?= $data["aantal"] ?></p>

    <table>
        <thead>
            <tr>
                <th>Voornaam</th>
                <th>Tussenvoegsel</th>
                <th>Achternaam</th>
                <th>Mobiel</th>
                <th>Datum in dienst</th>
                <th>Aantal sterren</th>
                <th>Voertuigen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data["instructeur-data"] as $row) {
            ?>
                <tr>
                    <td><?= $row->voornaam      ?></td>
                    <td><?= $row->tussenvoegsel ?></td>
                    <td><?= $row->achternaam    ?></td>
                    <td><?= $row->telefoon      ?></td>
                    <td><?= $row->datumInDienst ?></td>
                    <td><?= str_repeat("✦", $row->aantalSterren) ?></td>
                    <td><a href="<?= URLROOT ?>instructeurs/voertuigen/<?= $row->id ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                            </svg></a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>