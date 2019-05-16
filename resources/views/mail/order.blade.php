<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        Dear {{$customer->name}},
        <p>Order Number {{$order->id}} has been dispatched</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi consectetur dolores eaque eos facere illo iure laboriosam molestiae molestias, necessitatibus neque nostrum officia quasi suscipit voluptatum! Accusantium expedita molestias quod!</p>
    </div>
</body>
</html>