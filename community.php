<?php
session_start();

// Connect to database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=quick-pc1", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("DB Connection failed: " . $e->getMessage());
}

// Handle new top-level message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message']) && isset($_SESSION['username'])) {
    $stmt = $pdo->prepare("INSERT INTO community_messages (user, message) VALUES (?, ?)");
    $stmt->execute([$_SESSION['username'], htmlspecialchars($_POST['message'])]);
}

// Handle reply
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply'], $_POST['reply_to']) && isset($_SESSION['username'])) {
    $stmt = $pdo->prepare("INSERT INTO community_replies (message_id, user, reply) VALUES (?, ?, ?)");
    $stmt->execute([(int)$_POST['reply_to'], $_SESSION['username'], htmlspecialchars($_POST['reply'])]);
}

// Load messages
$messages = $pdo->query("SELECT * FROM community_messages ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Load replies
$replies = $pdo->query("SELECT * FROM community_replies ORDER BY created_at ASC")->fetchAll(PDO::FETCH_ASSOC);
$repliesByMessage = [];
foreach ($replies as $r) {
    $repliesByMessage[$r['message_id']][] = $r;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Community Chat - Quick PC Solutions</title>
  <link rel="stylesheet" href="/quick-pc1/css/style.css" />
  <style>
    .community-container {
      max-width: 800px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .message {
      background: #f1f1f1;
      padding: 15px;
      margin-bottom: 20px;
      border-left: 4px solid #4CAF50;
      border-radius: 6px;
    }
    .message small {
      float: right;
      color: #888;
    }
    .replies {
      margin-top: 15px;
      padding-left: 20px;
      border-left: 2px dashed #ccc;
    }
    .reply {
      background: #f9f9f9;
      padding: 10px;
      margin-bottom: 10px;
      border-left: 4px solid #2196F3;
      border-radius: 6px;
    }
    textarea {
      width: 100%;
      height: 80px;
      padding: 10px;
      margin-bottom: 10px;
      font-size: 14px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .btn {
      background-color: #4CAF50;
      color: white;
      padding: 8px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn.reply-btn {
      background-color: #2196F3;
      margin-top: 5px;
    }
  </style>
</head>
<body>
<div class="background-container"></div>

<header>
  <div class="logo">
    <img src="/quick-pc1/images/logo.webp" alt="Quick PC Solutions Logo" />
  </div>
  <h1>QUICK PC SOLUTIONS</h1>
  <nav>
    <ul>
      <li><a href="/quick-pc1/home.php">Home</a></li>
      <li><a href="/quick-pc1/news/news.php">Tech News</a></li>
      <li><a href="/quick-pc1/reviews/reviews.php">Reviews</a></li>
      <li><a href="/quick-pc1/guides/guides.php">Guides</a></li>
      <li><a href="/quick-pc1/community.php">Community</a></li>
      <li><a href="/quick-pc1/contact_us.php">Contact</a></li>
      <?php if (isset($_SESSION['username'])): ?>
        <li>
          <span style="color:white; padding-right:10px;">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
        </li>
        <li>
          <button onclick="logoutUser()" style="background:none; border:none; color:white; font-size:16px; cursor:pointer;">Logout</button>
        </li>
      <?php else: ?>
        <li><a href="/quick-pc1/Register.php">Register</a></li>
        <li><a href="/quick-pc1/Login.php">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>

<main>
  <div class="community-container">
    <h2>Community Chat</h2>

    <?php foreach ($messages as $msg): ?>
      <div class="message">
        <strong><?= htmlspecialchars($msg['user']) ?></strong>
        <small><?= date("H:i", strtotime($msg['created_at'])) ?></small>
        <p><?= htmlspecialchars($msg['message']) ?></p>

        <div class="replies">
          <?php if (!empty($repliesByMessage[$msg['id']])): ?>
            <?php foreach ($repliesByMessage[$msg['id']] as $reply): ?>
              <div class="reply">
                <strong><?= htmlspecialchars($reply['user']) ?></strong>
                <small><?= date("H:i", strtotime($reply['created_at'])) ?></small>
                <p><?= htmlspecialchars($reply['reply']) ?></p>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if (isset($_SESSION['username'])): ?>
            <form method="POST" class="reply-form">
              <input type="hidden" name="reply_to" value="<?= $msg['id'] ?>">
              <textarea name="reply" placeholder="Write a reply..." required></textarea>
              <button class="btn reply-btn" type="submit">Reply</button>
            </form>
          <?php else: ?>
            <p style="color:gray; font-style:italic;">Log in to reply.</p>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>

    <?php if (isset($_SESSION['username'])): ?>
      <form method="POST">
        <textarea name="message" placeholder="Start a new conversation..." required></textarea>
        <button class="btn" type="submit">Post Message</button>
      </form>
    <?php else: ?>
      <p style="font-style: italic; color: gray;">
        You must <a href="/quick-pc1/Login.php">log in</a> to post a message.
      </p>
    <?php endif; ?>
  </div>
</main>

<script src="/quick-pc1/Logout.js"></script>

<footer>
  <p>&copy; 2025 Quick PC Solutions</p>
</footer>
</body>
</html>
