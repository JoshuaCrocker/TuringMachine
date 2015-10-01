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
                <div class="description">
                    <p>The turing machine is in state
                        <input type="text" name="state" id="state" placeholder="State" class="paragraph"/>
                        and the head is in position
                        <input type="text" name="head" id="head" placeholder="Head Pos." class="paragraph"/>.
                    </p>

                    <p>The initial tape is:
                        <input type="text" name="initial_tape" id="initial_tape" placeholder="Initial Tape" class="paragraph"/>
                    </p>

                </div>

                <div>
                    <table>
                        <thead>
                        <tr>
                            <th colspan="2">Initial</th>
                            <th colspan="3">Next</th>
                        </tr>

                        <tr>
                            <th>State</th>
                            <th>Input</th>
                            <th>State</th>
                            <th>Output</th>
                            <th>Movement</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($TM->getRules() as $state => $rule) : foreach ($rule as $input => $data) : ?>
                        <tr id="<?php print $state.'_'.$input; ?>">
                            <td><?php print $state; ?></td>
                            <td><?php print $input; ?></td>
                            <td><?php print $data[0]; ?></td>
                            <td><?php print $data[1]; ?></td>
                            <td><?php print $data[2] == 'l' ? 'Left' : $data[2] == 'r' ? 'Right' : '-'; ?></td>
                        </tr>
                        <?php endforeach; endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div>
                    <textarea name="program" id="program"></textarea>
                </div>
            </form>
        </section>
    </div>

    <script src="turingmachine.js"></script>
    <script>
        var elem = document.getElementById('tape');
        var TM = new TuringMachine(elem, ["<?php print join('","', str_split($TM->getTape())); ?>"], "<?php print $TM->getState(); ?>", "<?php print $TM->getHead(); ?>");

        <?php foreach ($TM->getRules() as $state => $rule) : foreach ($rule as $input => $data) : ?>
        TM.addRule("<?php print $state; ?>", "<?php print $input; ?>", "<?php print $data[0]; ?>", "<?php print $data[1]; ?>", "<?php print $data[2]; ?>");
        <?php endforeach; endforeach; ?>
    </script>
</body>
</html>
