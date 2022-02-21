<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form1">
    <div>
        <label for="difficulty">Dificultad</label>
        <select name="difficulty">
            <?php
            foreach ($difficulty as $key => $value) {
                $selected = $difficultySelected ==  $key ? 'selected' : '';
                echo "<option value='$key' $selected> $value </option>";
            }
            ?>
        </select>
    </div>
    <div>
        <label for="quantity">Cantidad de verbos</label>
        <input type="number" name="quantity" min="1" max="161" value="<?= $quantity ?>">
    </div>
    <div>
        <span class="error"><?= $quantityErr ?></span>
        <input type="submit" name="submit" value="Empezar">
    </div>
</form>