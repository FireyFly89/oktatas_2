<?php
$requestBody = json_decode(file_get_contents('php://input'), true);

if (!empty($requestBody) && is_array($requestBody) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = array_merge($_POST, $requestBody);
}

session_start();
$maxFields = 60;
require_once ('functions.php');
$selectedDice = "img/kocka.png";
$kocka = [
    "1" => "img/1.png",
    "2" => "img/2.png",
    "3" => "img/3.png",
    "4" => "img/4.png",
    "5" => "img/5.png",
    "6" => "img/6.png"
];

if (!empty($_SESSION['dice'])) {
    $selectedDice = $kocka[$_SESSION['dice']];
}

init();

if (isset($_POST['restart'])) {
    restart();
} else if (isset($_POST['dobas'])) {
    $randomIndex = roll($kocka);
}

$positionKincs = $_SESSION['positionKincs'] ?? [];

if ($_SESSION['position'] > $maxFields) { // ha beértünk a célba
    endLoop($maxFields);
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Társasjáték</title>
        <link rel="stylesheet" href="main.css">
        <script src="js/main.js" type="text/javascript"></script>
    </head>

    <style>
        <?php for ($i = 1; $i <= $maxFields; $i++) : ?>.div<?php echo $i; ?> {
            grid-area: div<?php echo $i; ?>;

            background-color: rgba(220, 220, 220, 0.9);
            border: thin solid black;
            box-shadow: 2px 2px 1px gray;
        }

        <?php endfor; ?>
    </style>

    <body>
        <div class="container">
            <div class="left-container">
                <form action="/" method="POST" name="dobas" class="form-container">
                    <img src="<?php echo $selectedDice ?>" alt="<?php echo $randomIndex ?? ''; ?>" class="kocka">
                    <input type="submit" class="dobas" name="dobas" value="Dobás" />
                    <input type="submit" class="restart" name="restart" value="Új játék" />
                </form>

                <h2>Összegyűjtött kincsek</h2>
                <span class="result"><?php echo $_SESSION['result']; ?></span>
                <h2>Megtett körök</h2>
                <span class="result"><?php echo $_SESSION['circle']; ?></span>

                <?php if ($_SESSION['result'] == 3) : ?>
                    <span class="win">Nyertél</span>
                <?php endif; ?>

                <h2 class="result">Játék menete</h2>
                <span class="">Dobj a kockával és lépj előre amennyit dobtál. Gyűjts össze 3 kincses ládát a győzelemhez!</span>
            </div>

            <div class="board">
                <?php for ($i = 1; $i <= $maxFields; $i++) : ?>
                    <div class="cell div<?php echo $i; ?>">
                        <?php echo $i; ?>
                        <?php if ($i == $_SESSION['position']): ?>
                            <img src="img/figure.png" alt="player" class="player">
                        <?php endif; ?>
                        <?php if (in_array($i, $positionKincs)): ?>
                            <img src="img/kincs.png" alt="kincs" class="kincs">
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </body>

    </html>

<?php

function dd(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

;

?>