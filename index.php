<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Turing Machine</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="turingmachine.css">
</head>
<body>
    <div class="container">
        <h1>Turing Machine</h1>
        <section>
            <ul id="tape"></ul>
        </section>

        <section>
            <h4>Programs</h4>

            <ul>
                <?php foreach (scandir('programs') as $file) : if ($file == '.' || $file == '..') continue; ?>
                    <li><a href="index.php?prog=<?php print $file; ?>"><?php print
                                $file; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>

    <script src="turingmachine.js"></script>
</body>
</html>
