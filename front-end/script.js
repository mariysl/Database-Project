/* script.js */
// Handle fake search
const searchBtn = document.getElementById('searchBtn');
if (searchBtn) {
  searchBtn.addEventListener('click', () => {
    const sessions = document.getElementById('sessions');
    sessions.innerHTML = '<p>Showing results for your search (static demo).</p>';
  });
}

// Handle fake room creation
const createRoomForm = document.getElementById('createRoomForm');
if (createRoomForm) {
  createRoomForm.addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Room created! (In real app, this would redirect to the live session.)');
  });
}

// Handle fake chat
const chatForm = document.getElementById('chatForm');
if (chatForm) {
  chatForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const chatWindow = document.getElementById('chatWindow');
    const chatInput = document.getElementById('chatInput');
    const msg = chatInput.value.trim();
    if (msg) {
      const newMsg = document.createElement('div');
      newMsg.textContent = 'You: ' + msg;
      chatWindow.appendChild(newMsg);
      chatInput.value = '';
      chatWindow.scrollTop = chatWindow.scrollHeight;
    }
  });
}
