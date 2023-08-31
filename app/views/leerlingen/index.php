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
    <h1>Overzicht rijpakketten leerlingen</h1>
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Mobiel</th>
                <th>Pakketnaam</th>
                <th>Aantal lessen</th>
                <th>Prijs</th>
                <th>StartDatum</th>
                <th>Datum Rijbewijs</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data["data"] as $row) { ?>
                <tr>
                    <td><?= $row->voornaam . " " ?><?= ($row->tussenvoegsel != null) ? $row->tussenvoegsel . " " : "" ?><?= $row->achternaam ?></td>
                    <td><?= $row->mobiel ?></td>
                    <td><?= $row->pakketnaam ?></td>
                    <td><?= $row->aantalLessen ?></td>
                    <td><?= $row->prijs ?></td>
                    <td><?= $row->startdatum ?></td>
                    <td><?= $row->datumrijbewijsgehaald ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>