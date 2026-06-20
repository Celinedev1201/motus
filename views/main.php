<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Motus</title>

    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>

<div class="page">

    <?php require_once __DIR__ . '/../components/navbar.php'; ?>

    <main>
        <?php require_once __DIR__ . '/' . $page . '.php'; ?>
    </main>

</div>

</body>
</html>