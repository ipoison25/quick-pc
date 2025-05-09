document.addEventListener("DOMContentLoaded", function () {
    const chatToggle = document.getElementById("chat-toggle");
    const chatWindow = document.getElementById("chatbot");
    const chatBody = document.getElementById("chat-body");
    const chatInput = document.getElementById("user-input");
    const sendBtn = document.getElementById("send-btn");
    const minimizeIcon = document.getElementById("minimize-chat");

    let lastQuestion = null;

    // Toggle Chat Window
    chatToggle.addEventListener("click", function () {
        if (chatWindow.style.display === "none" || chatWindow.style.display === "") {
            chatWindow.style.display = "block";
            chatWindow.classList.remove("minimized");
            chatBody.innerHTML = `<p><strong>Bot:</strong> Ask me about tech news, reviews, or guides! or type help for helping</p>`;
        } else if (chatWindow.classList.contains("minimized")) {
            chatWindow.classList.remove("minimized");
        } else {
            chatWindow.style.display = "none";
        }
    });

    // Minimize/Maximize Chat Window
    minimizeIcon.addEventListener("click", function (e) {
        e.stopPropagation();
        chatWindow.classList.toggle("minimized");
    });

    // Send message
    sendBtn.addEventListener("click", sendMessage);
    chatInput.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    });

    function sendMessage() {
        let message = chatInput.value.trim();
        if (message === "") return;

        chatBody.innerHTML += `<p><strong>You:</strong> ${message}</p>`;
        chatInput.value = "";

        setTimeout(() => {
            let botResponse = getBotResponse(message);
            chatBody.innerHTML += `<p><strong>Bot:</strong> ${botResponse}</p>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 1000);
    }

    function getBotResponse(input) {
        input = input.toLowerCase().trim();

        // CONTEXTUAL RESPONSES
if (lastQuestion === "problem_type") {
    lastQuestion = null;
    const lowerInput = input.toLowerCase();

    if (lowerInput.includes("hardware")) {
        return `Here are common <strong>hardware problems</strong>:<ul>
          <li><a href="/quick-pc1/guides/guide-overheating.php" target="_blank">Overheating</a></li>
          <li><a href="/quick-pc1/guides/guide-cables.php" target="_blank">Loose or damaged cables</a></li>
          <li><a href="/quick-pc1/guides/guide-cooling.php" target="_blank">Cooling issues</a></li>
          <li><a href="/quick-pc1/guides/guide-cpu.php" target="_blank">CPU-related problems</a></li>
          <li><a href="/quick-pc1/guides/guide-gpu.php" target="_blank">GPU issues</a></li>
          <li><a href="/quick-pc1/guides/guide-ram.php" target="_blank">RAM errors</a></li>
          <li><a href="/quick-pc1/guides/guide-hard-drive.php" target="_blank">Hard drive failures</a></li>
          <li><a href="/quick-pc1/guides/guide-motherboard.php" target="_blank">Motherboard faults</a></li>
          <li><a href="/quick-pc1/guides/guide-psu.php" target="_blank">Power supply (PSU) issues</a></li>
          <li><a href="/quick-pc1/guides/system-boot-Failure.php" target="_blank">System Boot Failure</a></li>
          <li><a href="/quick-pc1/guides/laptop-battery.php" target="_blank">Laptop Battery Failure</a></li>
          
        </ul>`;
      } else if (lowerInput.includes("software")) {
        return `Here are common <strong>software issues</strong>:<ul>
          <li><a href="/quick-pc1/guides/blue-screen.php" target="_blank">Blue screen errors</a></li>
          <li><a href="/quick-pc1/guides/slow-pc.php" target="_blank">Slow computer performance</a></li>
          <li><a href="/quick-pc1/guides/guide-3.php" target="_blank">WiFi connection problems</a></li>
          <li><a href="/quick-pc1/guides/Driver-conflicts.php" target="_blank">Driver conflicts</a></li>
          <li><a href="/quick-pc1/guides/app-crashes.php" target="_blank">app crashes</a></li>
          <li><a href="/quick-pc1/guides/software-compatibility.php" target="_blank">software compatibility</a></li>
          <li><a href="/quick-pc1/guides/windows-update-errors.php" target="_blank">windows update errors</a></li>
          <li><a href="/quick-pc1/guides/system-file-repair.php" target="_blank">windows Corrupted system files</a></li>
          <li><a href="/quick-pc1/guides/file-explorer-fix.php" target="_blank">File Explorer not responding</a></li>
          <li><a href="/quick-pc1/guides/malware-removal.php" target="_blank">Malware and virus infections</a></li>
          <li><a href="/quick-pc1/guides/windows.php" target="_blank">windows activation</a></li>
        </ul>`;
      } else {
        return "Please specify: is it a <strong>hardware</strong> or <strong>software</strong> problem?";
      }  
}


        // INITIAL TRIGGER
        if (input.includes("problem")|| input.includes("issue")) {
            lastQuestion = "problem_type";
            return "Is it a <strong>software</strong> or <strong>hardware</strong> issue?";
        }

        // QUICK SEARCH HANDLING
        const searchTerms = ["reviews", "news", "guides", "help",];
        const queryMatch = searchTerms.find(term => input.includes(term));
        if (queryMatch) {
            return searchForContent(queryMatch);
        }

        // DEFAULT RESPONSES
        let responses = {
            "hello": "Hi there! How can I help you?",
            "hi": "Hi there! How can I help you?",
            "bye": "Goodbye! Have a great day!",
  
        };

        return responses[input] || "I'm not sure about that. Try asking about tech news, reviews, guides, or type 'problem' for help.";
    }

    function searchForContent(query) {
        let response = "";
      
        switch (query.toLowerCase()) {
          case "reviews":
            response = 'Check out our latest <a href="/quick-pc1/reviews.php" target="_blank">Reviews</a>!';
            break;
          case "news":
            response = 'Stay up to date with the latest <a href="/quick-pc1/news/news.php" target="_blank">Tech News</a>!';
            break;
          case "guides":
            response = 'Explore our helpful <a href="/quick-pc1/guides/guides.php" target="_blank">Guides</a>!';
            break;
          case "help":
            response = 'if you need help contact our support in <a href="/quick-pc1/contact_us.php">Contact us</a> page or type (problem / issue) to see if your problem are listed or vist our page<a href="/quick-pc1/guides/guides.php" target="_blank">Guides</a>!';
            break;
          default:
            response = "I couldn't find what you were looking for. Please try again.";
        }
      
        return response;
      }
      
});
