<?php
/** @var array $formats */
/** @var bool $success */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Awesome job exporter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .container {
            width: 400px;
            margin: 30px auto;
        }
    </style>
</head>
<body>

<?php
if ($success) {
    ?>
    <div class="alert alert-primary" role="alert">
        Awesome! Exported file has successfully sent to your email
    </div>
    <?php
}
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="card-title"><h2>Export all the jobs</h2></div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="format">Data format</label>
                    <select class="form-control" name="format" required id="format">
                        <?php
                        foreach ($formats as $code => $name) {
                            ?>
                            <option value="<?= $code ?>"><?= $name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email to receive</label>
                    <input class="form-control" type="text" name="email" id="email">
                    <small id="emailHelp" class="form-text text-muted">Enter your email if you want to receive exported file</small>
                </div>
                <button class="btn btn-primary" type="submit">Export</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
