<?php

/**
 * @author Laura Hidalgo Rivera
 * 
 */
include "verbs.php";

?>
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form2">
    <table>
        <tr>
            <th colspan="4">Verbos Irregulares</th>
        </tr>
        <?php
        $_SESSION["randomVerbs"] = randomGen(0, count($verbs) - 1, $_SESSION["quantity"]);
        foreach ($_SESSION["randomVerbs"] as $key => $randomVerb) {
            echo "<tr>";
            $randomTenses = randomGen(0, 3, $difficultySelected + 1);
            for ($j = 0; $j < TENSES; $j++) {
                echo "<td>";
                if (in_array($j, $randomTenses)) {
                    echo "<input type='text' name='$randomVerb$j' value=''>";
                } else {
                    $verb = $verbs[$randomVerb];
                    echo $verb[$j];
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
    <div>
        <input type="submit" name="corregir" value="Corregir">
    </div>
</form>