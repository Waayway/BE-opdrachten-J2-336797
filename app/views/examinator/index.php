<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Overzicht afgenomen examens examinator</h1>
    <table>
        <thead>
            <tr>
                <th>Naam examinator</th>
                <th>Datum Examen</th>
                <th>Rijbewijscategorie</th>
                <th>Rijschool</th>
                <th>Stad</th>
                <th>Uitslag examens</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data['examinators'] as $examinator) {
            ?>
                <tr>
                    <td><?= $examinator->voornaam . " " . ($examinator->tussenvoegsel == null ? "" : $examinator->tussenvoegsel . " ") . $examinator->achternaam ?></td>
                    <td><?= $examinator->datum ?></td>
                    <td><?= $examinator->rijbewijscategorie ?></td>
                    <td><?= $examinator->rijschool ?></td>
                    <td><?= $examinator->stad ?></td>
                    <td><?= $examinator->uitslag . "/" . $examinator->total ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>