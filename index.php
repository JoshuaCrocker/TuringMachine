<?php
require 'TuringMachine.php';
$TM = new TuringMachine((isset($_GET['prog']) ? $_GET['prog'] : null));
?>
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

        <section>
            <form action="index.php?save" method="post">
                <div>
                    <input type="text" name="state" id="state" placeholder="State"/>
                    <input type="text" name="initial_tape" id="initial_tape" placeholder="Initial Tape"/>
                    <input type="text" name="head" id="head" placeholder="Head Pos."/>
                </div>

                <div>
                    <textarea name="program" id="program"></textarea>
                </div>
            </form>
        </section>
    </div>

    <script src="turingmachine.js"></script>
</body>
</html>
