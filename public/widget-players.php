<?php
    include './vendor/autoload.php';
    use Api\Players;
    use Api\Countries;
    use Helpers\HelperWidgets;

    //$players = new stdClass();
    $objPlayers = new Players();
    $players    = $objPlayers->getAllPlayers();
    $countries  = $objPlayers->getCountrieForPlayer( $players );
    $count      = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Widget</title>
</head>
<body>
    <?php if ( $players == 'error' ) : ?>

        <h1> No se encontraron resultados, intentelos más tarde </h1>

    <?php else: ?>

        <div class="container-filter">
            <h2> PLAYERS </h2>
            <select name="countries">
                <option value="">Filter by country</option>
                <option value="all">All countries</option>
                <?php foreach ( $countries as $country ) : ?>
                    <option value="<?= HelperWidgets::removeSpaces( $country ) ?>"> 
                        <?= $country ?> 
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <main>
            <table id="table">
                <thead>
                <tr>
                    <th></th>
                    <th>NAME</th>
                    <th>COUNTRY</th>
                    <th>POSITION</th>
                    <th>AGE</th>
                    <th>GENDER</th>
                    <th>TTW</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach( $players as $player ) : ?>
                        <tr class="<?= HelperWidgets::removeSpaces( $player->country->name ) ?>">
                            <td class="center padding-short"> 
                                <?= $count ?> 
                            </td>
                            <td> 
                                <img src="<?= $player->image_path ?>" alt="<?= $player->display_name ?>" /> 
                                <?= $player->display_name ?> 
                            </td>
                            <td class="country"> 
                                <img src="<?= $player->country->image_path ?>" alt="<?= $player->country->name ?>" /> 
                                <?= $player->country->name ?> 
                            </td>
                            <td> 
                                <?= isset( $player->position->name ) 
                                    ? $player->position->name : '-' ?> 
                            </td>
                            <td class="center"> 
                                <?= HelperWidgets::getAgePlayer( $player->date_of_birth ) ?> 
                            </td>
                            <td class="center"> <?= $player->gender ?> </td>
                            <td class="center"> <?= count( $player->trophies )  ?> </td>
                        </tr>
                        <?php $count++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    <?php endif; ?>
    <script type="text/javascript" src="assets/js/widget.js"></script>
</body>
</html>



