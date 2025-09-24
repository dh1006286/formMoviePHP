<?php
$name = '';
$movie = '';
$errors=[];

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $name = $_POST['name'] ?? '';
    $movie = $_POST['favorite_movie'] ?? '';

    if (trim($name) === '') 
    {
        $errors['user'] = "Name is required";
    }
    if (trim($movie) === '') 
    {
        $errors['email'] = "Movie is required";
    }

    if (empty($errors)) 
    {
    // PRG
    $qs = 'ok=1&name=' . urlencode($name) . '&movie=' . urlencode($movie);
    header('Location: signup.php?' . $qs);
    exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=0, initial-scale=1.0">
    <title>Document</title>
    <?php require "includes\bootstrapcdnlinks.php" ?>
</head>
<body>
    <?php if(isset($_GET['ok']) && $_GET['ok']==='1'):?>
        <div class='alert alert-success'>
            Thanks <?= $_GET['name'] ?> we've added your favorite movie <?= $_GET['movie'] ?> to our club list
        </div>
    <?php endif; ?>

       <!-- Error message -->
        <?php if (($errors)): ?>
            <div class="alert alert-danger">
                Please fix:
                <ul class="mb-0">
                    <?php foreach ($errors as $msg): ?>
                        <li><?= $msg; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php endif; ?>

    <?php if($_SERVER['REQUEST_METHOD'] !== 'POST' || $errors): ?>
    
        <form action="signup.php" method="post">
            <input type="text" name="name" value=<?=$name?>>
            <input type="text" name="favorite_movie" value=<?=$movie?>>
            <button type="submit">Submit</button>
        </form>

    <?php else: ?>
        <pre><?php print_r($_POST)?></pre>
    <?php endif ?>
</body>
</html>