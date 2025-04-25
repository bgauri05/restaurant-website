<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login if not logged in
    header("Location: membership.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>INKA Member Perks</title>
  <style>
    body {
      font-family: 'Georgia', serif;
      background-color: #fdf5ed;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .perks-container {
      background-color: white;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      padding: 40px;
      max-width: 600px;
      text-align: center;
    }

    h2 {
      color: #7b0000;
      font-size: 32px;
      margin-bottom: 30px;
    }

    ul {
      text-align: left;
      padding: 0;
      list-style: none;
      color: #3e2723;
      font-size: 18px;
      line-height: 1.8;
    }

    li::before {
      content: "🍷 ";
    }

    button {
      margin-top: 30px;
      padding: 12px 28px;
      background-color: #a43535;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }

    button:hover {
      background-color: #6a1b1b;
    }
  </style>
</head>
<body>
  <div class="perks-container">
    <h2>Your INKA Membership Perks</h2>
    <ul>
      <li>Free Dessert after 5 visits</li>
      <li>10% Off on your Birthday</li>
      <li>Priority Reservations</li>
      <li>Exclusive Weekly Deals</li>
      <li>Bonus points for every visit</li>
      <li>Surprise Gifts for Loyal Customers</li>
      <li>VIP Access to New Dishes</li>
    </ul>
    <button onclick="window.location.href='membership.html'">Logout</button>
  </div>
</body>
</html>
