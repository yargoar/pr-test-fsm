<?php
use FSM\FSM;
use FSM\Alphabet;
use FSM\State;
use FSM\States;
use FSM\Transition;
use FSM\Transitions;

require_once __DIR__ . '/vendor/autoload.php';
require_once 'modthree.php';


$input = '1101'; // default 13
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST['binary_input'] ?? '1101';
    $result = modThree($input);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mod Three Demonstration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            height: 100vh;
            display: grid;
            place-items: center;
        }

        .container {
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-size: 1.1em;
            margin-bottom: 8px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 1.1em;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            font-size: 1.1em;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Mod Three Function Demonstration</h1>
    <form method="POST" action="">
        <label for="binary_input">Enter a binary string:</label>
        <input type="text" id="binary_input" name="binary_input" value="<?php echo $input; ?>" required>
        <button type="submit">Calculate</button>
    </form>

    <?php if (isset($result)): ?>
        <div class="result">
            Mod 3 for "<?php echo htmlspecialchars($input); ?>" :
            <b><?php echo $result; ?></b>
        </div>
    <?php endif; ?>

    <h2>Requested examples:</h2>
    <ul>
        <li><b>1101</b> → <?php echo modThree("1101"); ?> (13 mod 3 = 1)</li>
        <li><b>1110</b> → <?php echo modThree("1110"); ?> (14 mod 3 = 2)</li>
        <li><b>1111</b> → <?php echo modThree("1111"); ?> (15 mod 3 = 0)</li>
    </ul>
</div>

</body>
</html>
