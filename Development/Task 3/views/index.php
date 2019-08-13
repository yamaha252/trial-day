<?php
/** @var array $formats */
/** @var bool $success */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Awesome job exporter</title>
</head>
<body>

<?php
if ($success) {
    ?>
    <div>Awesome! Exported file has successfully sent to your email</div>
    <?php
}
?>

<form action="" method="post">
    <div>
        <select name="format" required>
            <?php
            foreach ($formats as $code => $name) {
                ?>
                <option value="<?= $code ?>"><?= $name ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div>
        <input type="text" name="email" placeholder="Email to receive">
    </div>
    <button type="submit">Export</button>
</form>

</body>
</html>
