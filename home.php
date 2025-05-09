<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>QUICK PC SOLUTIONS - Home</title>
  <link rel="stylesheet" href="/quick-pc1/css/style.css" />
  <link rel="stylesheet" href="/quick-pc1/css/chatbot.css" />
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
        <li><a href="/quick-pc1/contact_us.php">Contact us</a></li>
        
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

        <li><button onclick="toggleSearch()">Search</button></li>
      </ul>

      <form id="search-form" onsubmit="return false;" style="display: none;">
        <input type="text" id="search-query" placeholder="Search..." />
        <button type="submit" onclick="performSearch()">Search</button>
      </form>
    </nav>
  </header>

  <main>
    <section class="hero">
      <h2>WELCOME TO QUICK PC SOLUTIONS</h2>
      <p>Your ultimate source for PC tech news, reviews, and guides.</p>
      <a href="#latest-articles" class="cta-button">Explore Now</a>
    </section>

    <section id="latest-articles" class="articles">
      <div class="article-row">
        <article>
          <img src="/quick-pc1/images/laptops.jpg" alt="PC Build Review" width="300"/>
          <h3>Best Gaming Laptops Under $1500 (2025 Edition)</h3>
          <p>Explore our in-depth reviews of the latest gaming budget laptops.</p>
          <a href="/quick-pc1/reviews/laptops.php">Read more</a>
        </article>

        <article>
          <img src="/quick-pc1/images/monitor.jpg" alt="Gaming Monitors" />
          <h3>Best budget Gaming Monitors of 2025</h3>
          <p>Discover the best budget gaming monitors that will elevate your gaming experience.</p>
          <a href="/quick-pc1/reviews/monitors.php">Read more</a>
        </article>
      </div>

      <div class="article-row">
        <article>
          <img src="/quick-pc1/images/cooling.jpg" alt="PC Cooling Solutions" />
          <h3>PC Cooling Solutions</h3>
          <p>Learn how to cool your high-end PC build with the latest cooling solutions.</p>
          <a href="/quick-pc1/guides/guide-cooling.php">Read more</a>
        </article>

        <article>
          <img src="/quick-pc1/images/bluescreen.avif" alt="Blue Screen Error" width="300" />
          <h3>How to Fix Blue Screen Errors</h3>
          <p>Learn how to diagnose and fix common blue screen errors on Windows.</p>
          <a href="/quick-pc1/guides/blue-screen.php">Read more</a>
        </article>
      </div>

      <div class="article-row">
        <article>
          <img src="/quick-pc1/images/cables.jpg" alt="Cable Connection" width="350" />
          <h3>Fix Cable Connection Problems</h3>
          <p>Learn how to diagnose and fix cable connection issues in your PC setup.</p>
          <a href="/quick-pc1/guides/guide-cables.php">Read more</a>
        </article>

        <article>
          <img src="/quick-pc1/images/how-to-fix-slow-computer.jpeg" alt="Slow PC" width="300" />
          <h3>Why Is My PC So Slow?</h3>
          <p>Find out what slows your PC down and how to make it faster.</p>
          <a href="/quick-pc1/guides/slow-pc.php">Read more</a>
        </article>

      </div>
      

    <div class="article-row">

    <article>
  <img src="/quick-pc1/images/cloud-comp.png" alt="Cloud Computing and Remote Work" width="300" />
  <h3>Cloud Computing and the Future of Remote Work</h3>
  <p>Explore how cloud computing is transforming remote work, offering flexible and scalable solutions for businesses and individuals alike.</p>
  <a href="/quick-pc1/news/cloud-comp.php">Read more</a>
</article>

<article>
  <img src="/quick-pc1/images/cyber.jpeg" alt="Cybersecurity in the Age of Ransomware" width="300" />
  <h3>Cybersecurity in the Age of Ransomware</h3>
  <p>Learn about the increasing threat of ransomware and the steps you can take to protect your data and prevent attacks.</p>
  <a href="/quick-pc1/news/Cybersecurity.php">Read more</a>
</article>
    </div>
    
    <div class="article-row">

    <article>
  <img src="/quick-pc1/images/alienWare.webp" alt="Alienware Aurora Review" width="300" />
  <h3>Alienware Aurora Review</h3>
  <p>Get an in-depth look at the Alienware Aurora gaming rig, offering impressive performance and sleek design. Is it worth the high price?</p>
  <a href="/quick-pc1/reviews/alienWare.php">Read more</a>
</article>

<article>
  <img src="/quick-pc1/images/phones.webp" alt="Best Budget Smartphones" width="300" />
  <h3>Best Budget Smartphones for 2025</h3>
  <p>Check out the best budget smartphones under $500 that offer great performance without breaking the bank.</p>
  <a href="/quick-pc1/reviews/phones.php">Read more</a>
</article>

    </div>
    
    <div class="article-row">

    <article>
    <img src="/quick-pc1/images/external-hard-drive.jpg" alt="Best External Hard Drives for 2025" width="300" />
   <h3>Best External Hard Drives for 2025</h3>
    <p>Discover the top external hard drives for 2025 that offer great storage, fast speeds, and reliability for all your data storage needs.</p>
   <a href="/quick-pc1/reviews/best-external-hard-drives-2025.php">Read more</a>
    </article>

    <article>
  <img src="/quick-pc1/images/wireless-router.jpg" alt="Best Wireless Routers for 2025" width="300" />
  <h3>Best Wireless Routers for 2025</h3>
  <p>Explore the top wireless routers for 2025 that provide fast speeds, better coverage, and advanced features like Wi-Fi 6 and mesh networking.</p>
  <a href="/quick-pc1/reviews/best-wireless-routers-2025.php">Read more</a>
</article>

    </div>

    <div class="article-row">
    <article>
  <img src="/quick-pc1/images/meta.webp" alt="Meta LlamaCon AI Event" width="300" />
  <h3>Meta Announces 'LlamaCon' AI Developer Event</h3>
  <p>Meta has unveiled plans for LlamaCon, a new event scheduled for April 29, 2025, to bring together developers and AI enthusiasts. The event will focus on open-source AI tools, specifically Meta’s LLaMA technology.</p>
  <a href="/quick-pc1/news/meta.php">Read more</a>
</article>
   
<article>
  <img src="/quick-pc1/images/5G.jpg" alt="The Future of 5G" width="300" />
  <h3>The Future of 5G</h3>
  <p>The global rollout of 5G networks is set to revolutionize industries, providing faster speeds, lower latency, and massive improvements in connectivity. The future of 5G promises new opportunities for businesses and consumers alike, from AI advancements to enhanced mobile experiences.</p>
  <a href="/quick-pc1/news/future-5G.php">Read more</a>
</article>

    </div>
    <div class="article-row" >
    <article>
  <img src="/quick-pc1/images/system-boot-failure.jpg" alt="System Boot Failure" width="300" />
  <h3>System Boot Failure</h3>
  <p>Diagnose and fix common causes of system boot failure to get your PC running smoothly again.</p>
  <a href="/quick-pc1/guides/system-boot-failure.php">Read more</a>
</article>

<article>
  <img src="/quick-pc1/images/laptop-battery.jpg" alt="Laptop Battery Failure" width="300" />
  <h3>Laptop Battery Failure</h3>
  <p>Learn how to identify the causes of laptop battery failure and what steps to take to fix or prevent it from happening.</p>
  <a href="/quick-pc1/guides/laptop-battery.php">Read more</a>
</article>


    </div>
    </section>
  </main>

  <!-- Chatbot -->
  <div class="chat-toggle" id="chat-toggle">ChatBot</div>
  <div class="chatbot-container" id="chatbot">
    <div class="chat-header">
      Chat with us 
      <span class="minimize-icon" id="minimize-chat">–</span>
    </div>
    <div class="chat-body" id="chat-body"></div>
    <div class="chat-input">
      <input type="text" id="user-input" placeholder="Type a message..." />
      <button id="send-btn">Send</button>
    </div>
  </div>

  <!-- Scripts -->
  <script src="/quick-pc1/chatbot.js"></script>
  <script src="/quick-pc1/searchF.js"></script>
  <script src="/quick-pc1/Logout.js"></script>

  <footer>
    <p>&copy; 2025 Quick PC Solutions</p>
  </footer>
</body>
</html>
