<?php

// ternary operators

$score = 50;

// $val = $score > 40 ? 'high score!' : 'low score :(';        // first 'if' : second 'else'
// echo $val;

//or

//echo $score > 40 ? 'high score!' : 'low score :('; (not storing in a variable)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extra Stuff</title>
</head>
<body>
    
    <p><?php echo $score > 40 ? 'high score!' : 'low score :('; ?></p>

</body>
</html>