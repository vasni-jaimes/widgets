<?php
    include '../vendor/autoload.php';
    use Api\Sessions;
    use Api\TopScores;
    use Helpers\HelperWidgets;

    $objSessions      = new Sessions();
    $sessionAll       = $objSessions->getAllSessions();

    $objTopScores     = new TopScores();
    $topScorePlayersBySesion = $objTopScores->getSesionByID( $sessionAll[0]->id );
    $count = 1;
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
    <?php if ( $topScorePlayersBySesion == 'error' ) : ?>
        <h1> No se encontraron resultados, intentelos más tarde </h1>
    <?php else: ?>
        <div class="container-filter">
            <h2>TOP SCORERS</h2>
            <select name="sessions">
                <option value="">Filter by session</option>
                <?php foreach ( $sessionAll as $session ) : ?>
                    <option value="<?= $session->id ?>"> 
                        <?= $session->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <main>
            <table id="table" class="widget-session">
                <thead>
                <tr>
                    <th></th>
                    <th>NAME</th>
                    <th>COUNTRY</th>
                    <th>POSITION</th>
                    <th>AGE</th>
                    <th>GENDER</th>
                    <th>GOALS</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach( $topScorePlayersBySesion as $session ) : ?>
                        <tr>
                            <td class="center padding-short"> 
                                <?= $count ?> 
                            </td>
                            <td> 
                                <img src="<?= $session->player->image_path ?>" alt="<?= $session->player->display_name ?>" /> 
                                <?= $session->player->display_name ?> 
                            </td>
                            <td class="country"> 
                                <img src="<?= $session->player->country->image_path ?>" alt="<?= $session->player->country->name ?>" /> 
                                <?= $session->player->country->name ?> 
                            </td>
                            <td> 
                                <?= isset( $session->player->position->name ) 
                                    ? $session->player->position->name : '-' ?> 
                            </td>
                            <td class="center"> 
                                <?= HelperWidgets::getAgePlayer( $session->player->date_of_birth ) ?> 
                            </td>
                            <td class="center"> <?= $session->player->gender ?> </td>
                            <td class="center"> <?= $session->total  ?> </td>
                        </tr>
                        <?php $count++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="assets/js/widget.js"></script>
</body>
</html>