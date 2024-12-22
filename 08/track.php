<?php
    $counterFile = "counter.txt";

    // Check if the counter file exists; if not, create it with an initial value of 0
    if (!file_exists($counterFile)) {
        file_put_contents($counterFile, "0");
    }

    // Read the current count from the file
    $currentCount = (int) file_get_contents($counterFile);

    // Increment the count
    $newCount = $currentCount + 1;

    // Save the updated count back to the file
    file_put_contents($counterFile, $newCount);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Counter</title>
    <style>
        body{
            display:flex;
            text-align:center;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            position:relative;
        }
        .container{
            background: yellow;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 0 auto;
            width: 60%;
            position:absolute;
            top: 100px;
            

        }


    </style>
</head>
<body>
    <div class="container">
    <h1>Welcome to Website</h1>
    <p>You are visitor number <strong> <?php echo $newCount; ?> </strong></p>
    </div>
    
    
</body>
</html>
