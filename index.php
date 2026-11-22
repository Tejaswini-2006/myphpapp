<?php
// Restaurant website - index.php (single file, no database)
$restaurant = "RajNandini Restaurant";

$menu = [
    "Starters" => [
        "Paneer Tikka" => 220,
        "Veg Spring Rolls" => 160,
    ],
    "Main Course" => [
        "Butter Chicken" => 320,
        "Dal Makhani" => 240,
        "Veg Biryani" => 260,
    ],
    "Desserts" => [
        "Gulab Jamun" => 90,
        "Ice Cream" => 80,
    ],
];

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name   = htmlspecialchars(trim($_POST["name"] ?? ""));
    $date   = htmlspecialchars($_POST["date"] ?? "");
    $guests = (int)($_POST["guests"] ?? 1);

    if ($name && $date && $guests > 0) {
        $message = "Thank you, $name! Table for $guests booked on $date.";
    } else {
        $message = "Please fill all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $restaurant ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #fffaf3; color: #333; }
        header { background: #b8321f; color: #fff; text-align: center; padding: 30px; }
        section { max-width: 700px; margin: 25px auto; padding: 0 15px; }
        h2 { color: #b8321f; border-bottom: 2px solid #b8321f; }
        .item { display: flex; justify-content: space-between; padding: 6px 0; }
        input, button { padding: 8px; margin: 5px 0; width: 100%; box-sizing: border-box; }
        button { background: #b8321f; color: #fff; border: 0; cursor: pointer; }
        .msg { background: #e6f4ea; padding: 10px; border-radius: 5px; }
        footer { text-align: center; padding: 15px; background: #eee; }
    </style>
</head>
<body>

<header>
    <h1><?= $restaurant ?></h1>
    <p>Fresh food, served with love</p>
</header>

<section>
    <h2>Menu</h2>
    <?php foreach ($menu as $category => $items): ?>
        <h3><?= $category ?></h3>
        <?php foreach ($items as $dish => $price): ?>
            <div class="item"><span><?= $dish ?></span><span>₹<?= $price ?></span></div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</section>

<section>
    <h2>Book a Table</h2>
    <?php if ($message): ?><p class="msg"><?= $message ?></p><?php endif; ?>
    <form method="post">
        <input type="text" name="name" placeholder="Your name" required>
        <input type="date" name="date" required>
        <input type="number" name="guests" min="1" placeholder="Number of guests" required>
        <button type="submit">Reserve</button>
    </form>
</section>

<footer>&copy; <?= date("Y") ?> <?= $restaurant ?> | Open daily 11 AM – 11 PM</footer>

</body>
</html>
