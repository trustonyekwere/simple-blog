# Extra notes
## Ternary operators

```

<?php

// ternary operators

$score = 50;

// $val = $score > 40 ? 'high score!' : 'low score :(';        // first 'if' : second 'else'
// echo $val;

//or

//echo $score > 40 ? 'high score!' : 'low score :('; (not storing in a variable)

?>

```

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ternary operators</title>
</head>
<body>
    
    <p><?php echo $score > 40 ? 'high score!' : 'low score :('; ?></p>

</body>
</html>
```

## Superglobals

```

<?php

// superglobals
// $_GET['name'], $_POST['name']

echo $_SERVER['SERVER_NAME'] . '<br />'; // server name
echo $_SERVER['REQUEST_METHOD'] . '<br />'; // request method (GET/POST)
echo $_SERVER['SCRIPT_FILENAME'] . '<br />'; // script file name (directory)
echo $_SERVER['PHP_SELF'] . '<br />'; // location of the current file, regardless of the name of the file

?>

<!DOCTYPE html>
<html>
<head>
    <title>Superglobals</title>
</head>
<body>

</body>
</html>

``` 

## Sessions