
// Premium AI Smart Assistant v3.5 - Next Gen Implementation
document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("ai-chat-toggle")) return;

    // Load Marked.js for Markdown Support
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/marked/marked.min.js';
    document.head.appendChild(script);

    const root = document.createElement("div");
    root.innerHTML = `
    <div id="ai-chatbot">
      <div id="ai-chat-header">
        <div class="title-group">
            <div style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%; box-shadow: 0 0 10px #22c55e;"></div>
            <span>Campus AI Assistant</span>
        </div>
        <button onclick="toggleChat()" title="Close">×</button>
      </div>

      <div id="ai-chat-messages"></div>

      <div id="ai-chat-input-container">
          <div id="ai-suggestions">
            <div class="suggestion-chip" onclick="quickAsk('What is my attendance status?')">📊 Attendance</div>
            <div class="suggestion-chip" onclick="quickAsk('Show my exam schedule')">📅 Exams</div>
            <div class="suggestion-chip" onclick="quickAsk('Any new notices today?')">🔔 Notices</div>
            <div class="suggestion-chip" onclick="quickAsk('How to pay fees?')">💰 Fees</div>
          </div>
          
          <div id="ai-chat-input">
            <input id="ai-user-input" placeholder="Type or use voice..." onkeypress="handleKey(event)" />
            <button class="ai-icon-btn" onclick="startVoice()" id="mic-btn" title="Voice Input">🎤</button>
            <button class="ai-icon-btn ai-send-btn" onclick="sendMessage()" title="Send">➤</button>
          </div>
      </div>
    </div>

    <button id="ai-chat-toggle" onclick="toggleChat()" title="Open Assistant">
        <span id="toggle-icon">💬</span>
    </button>
  `;

    document.body.appendChild(root);
    
    // Restore Session History
    loadHistory();

    // Welcome Message if first time
    if (document.getElementById("ai-chat-messages").children.length === 0) {
        setTimeout(() => {
            addMessage("Hey there! 👋 I'm your Campus Assistant. Need help with attendance, exams, or notices? Just ask! 😊", "bot");
        }, 500);
    }
});

let isTyping = false;

function toggleChat() {
    const c = document.getElementById("ai-chatbot");
    const toggle = document.getElementById("toggle-icon");
    const isOpen = c.style.display === "flex";
    
    c.style.display = isOpen ? "none" : "flex";
    toggle.innerText = isOpen ? "💬" : "×";
    
    if (!isOpen) {
        document.getElementById("ai-user-input").focus();
        scrollToBottom();
    }
}

function handleKey(e) {
    if (e.key === "Enter") sendMessage();
}

function addMessage(msg, type, isStreaming = false) {
    const chat = document.getElementById("ai-chat-messages");
    
    // Remove typing indicator if exists
    const existingTyping = document.querySelector(".typing-indicator");
    if (existingTyping) existingTyping.remove();

    const div = document.createElement("div");
    div.className = `ai-msg ai-msg-${type}`;
    
    if (type === "bot") {
        // Use marked for bot messages (if loaded)
        if (window.marked) {
            div.innerHTML = marked.parse(msg);
        } else {
            div.innerText = msg;
        }
    } else {
        div.innerText = msg;
    }

    chat.appendChild(div);
    scrollToBottom();
    
    if (!isStreaming) saveHistory();
    return div;
}

function showTyping() {
    const chat = document.getElementById("ai-chat-messages");
    const div = document.createElement("div");
    div.className = "ai-msg ai-msg-bot typing-indicator";
    div.innerHTML = `<div class="typing-dots"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>`;
    chat.appendChild(div);
    scrollToBottom();
}

function quickAsk(text) {
    document.getElementById("ai-user-input").value = text;
    sendMessage();
}

function sendMessage() {
    if (isTyping) return;
    const input = document.getElementById("ai-user-input");
    const text = input.value.trim();
    if (!text) return;

    addMessage(text, "user");
    input.value = "";
    
    showTyping();
    isTyping = true;

    fetch("ai-chat.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message: text, page: document.title })
    })
    .then(res => res.json())
    .then(data => {
        isTyping = false;
        if (data.reply) {
            streamResponse(data.reply);
        } else {
            addMessage("⚠️ System is currently busy. Please try again in a moment.", "bot");
        }
    })
    .catch(() => {
        isTyping = false;
        addMessage("❌ Connection error. Please check your internet.", "bot");
    });
}

function streamResponse(fullText) {
    const existingTyping = document.querySelector(".typing-indicator");
    if (existingTyping) existingTyping.remove();

    const div = addMessage("", "bot", true);
    let index = 0;
    const words = fullText.split(' ');
    
    function next() {
        if (index < words.length) {
            const currentText = words.slice(0, index + 1).join(' ');
            div.innerHTML = window.marked ? marked.parse(currentText) : currentText;
            index++;
            scrollToBottom();
            setTimeout(next, 30 + Math.random() * 50); // Natural varied typing speed
        } else {
            saveHistory();
        }
    }
    next();
}

function scrollToBottom() {
    const chat = document.getElementById("ai-chat-messages");
    chat.scrollTop = chat.scrollHeight;
}

// Voice Recognition
function startVoice() {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRecognition) {
        alert("Voice recognition not supported in this browser.");
        return;
    }

    const recognition = new SpeechRecognition();
    const micBtn = document.getElementById("mic-btn");
    
    recognition.onstart = () => {
        micBtn.innerText = "🛑";
        micBtn.style.color = "#ef4444";
    };
    
    recognition.onresult = (event) => {
        const transcript = event.results[0][0].transcript;
        document.getElementById("ai-user-input").value = transcript;
        sendMessage();
    };
    
    recognition.onend = () => {
        micBtn.innerText = "🎤";
        micBtn.style.color = "#64748b";
    };
    
    recognition.start();
}

// History Management
function saveHistory() {
    const chat = document.getElementById("ai-chat-messages");
    const msgs = Array.from(chat.children).map(m => ({
        html: m.innerHTML,
        type: m.classList.contains("ai-msg-user") ? "user" : "bot"
    }));
    localStorage.setItem("campus_ai_history", JSON.stringify(msgs.slice(-20))); // Keep last 20
}

function loadHistory() {
    const stored = localStorage.getItem("campus_ai_history");
    if (!stored) return;
    
    const msgs = JSON.parse(stored);
    const chat = document.getElementById("ai-chat-messages");
    
    msgs.forEach(m => {
        const div = document.createElement("div");
        div.className = `ai-msg ai-msg-${m.type}`;
        div.innerHTML = m.html;
        chat.appendChild(div);
    });
    scrollToBottom();
}
