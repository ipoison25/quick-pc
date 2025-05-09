<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - Quick PC Solutions</title>
  <link rel="stylesheet" href="/quick-pc1/css/style.css">
  <link rel="stylesheet" href="/quick-pc1/css/chatbot.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('https://i.gifer.com/J4o.gif') repeat;
      animation: moveBackground 30s linear infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    @keyframes moveBackground {
      from {
        background-position: 0 0;
      }
      to {
        background-position: -2000px 0;
      }
    }

    .container {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      padding: 30px;
      width: 350px;
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
      font-size: 24px;
    }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ddd;
      box-sizing: border-box;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #45a049;
    }

    .message {
      margin-top: 10px;
      font-size: 14px;
    }

    .error {
      color: red;
    }

    .success {
      color: green;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Contact Us</h2>
    <form id="contactForm" action="contact.php" method="POST">
      <input type="text" id="name" name="name" placeholder="Your Name" required>
      <input type="email" id="email" name="email" placeholder="Your Email" required>
      <textarea id="message" name="message" placeholder="Your Message" rows="5" required></textarea>
      <button type="submit">Send Message</button>
    </form>
    <p id="message-status" class="message"></p>
  </div>

  <script>
    // Handle form submission without page reload
    document.getElementById("contactForm").addEventListener("submit", function(event) {
      event.preventDefault();

      let formData = new FormData(this);

      fetch("contact.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        let messageStatus = document.getElementById("message-status");
        if (data === "success") {
          messageStatus.textContent = "Your message has been sent successfully!";
          messageStatus.className = "message success";
          this.reset();
        } else {
          messageStatus.textContent = "There was an error sending your message. Please try again later.";
          messageStatus.className = "message error";
        }
      })
      .catch(error => console.error("Error:", error));
    });
  </script>
</body>
</html>
