<?php

/**
 * @author Laura Hidalgo Rivera
 *
 */
session_start();

if (!isset($_SESSION["quantity"])) {
    $_SESSION["quantity"] = 0;
}
if (!isset($_SESSION["randomVerbs"])) {
    $_SESSION["randomVerbs"] = 0;
}

include "verbs.php";

const TENSES = 4;

$quantityErr = $input = "";
$difficulty = array("Fácil", "Intermedio", "Difícil");
$difficultySelected = "";
$correctos = 0;

function clearData($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);

    return $data;
}

function randomGen($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

$processForm = false;
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $processForm = true;
    if (isset($_POST["submit"])) {
        if (!isset($_POST["quantity"]) || (isset($_POST["quantity"]) && ($_POST["quantity"] < 1 || $_POST["quantity"] > count($verbs)))) {
            $quantityErr = "Introduce un número del 1 al " . count($verbs);
            $error = true;
        } else {
            $_SESSION["quantity"] = clearData($_POST["quantity"]);
        }

        if (isset($_POST["difficulty"])) {
            $difficultySelected = $_POST["difficulty"];
        }
    }

    if ($error) {
        $processForm = false;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Laura Hidalgo Rivera">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Verbos</title>
</head>

<body>
    <?php
    if (!$processForm) {
        include "form1.php";
    } else if (isset($_POST["corregir"])) {
        include "form1.php";
    ?>
        <table>
            <tr>
                <th colspan="4">Verbos Irregulares</th>
            </tr>
            <?php
            for ($i = 0; $i < $_SESSION["quantity"]; $i++) {
                echo "<tr>";
                for ($j = 0; $j < TENSES; $j++) {
                    $pos = $_SESSION["randomVerbs"][$i];
                    echo "<td" . (isset($_POST["$pos$j"]) && $verbs[$pos][$j] == $_POST["$pos$j"] ? " class='correcto'" : "") .
                        (isset($_POST["$pos$j"]) && $verbs[$pos][$j] != $_POST["$pos$j"] ? " class='incorrecto'" : "") .
                        ">";
                    echo $verbs[$pos][$j];
                    if (isset($_POST["$pos$j"])) {
                        $correctos += $verbs[$pos][$j] == $_POST["$pos$j"] ? 1 : 0;
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }

            ?>
        </table>

    <?php
        print($correctos);
    } else {
        include "form1.php";
        include "formVerbs.php";
    }

    ?>
</body>

</html>