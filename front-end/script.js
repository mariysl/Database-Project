const searchBtn = document.getElementById('searchBtn');
if (searchBtn) {
  searchBtn.addEventListener('click', () => {
    const query = document.getElementById('searchInput').value.trim();
    const sessions = document.getElementById('sessions');
    if (query) {
      sessions.innerHTML = `
        <div class="session-card">
          <h3 class="text-lg font-medium">Search Results</h3>
          <p class="text-gray-200">Showing results for "${query}" (static demo).</p>
        </div>
      `;
      // Add logic to fetch sessions via API in a real app
    } else {
      sessions.innerHTML = '<p class="text-gray-200">Please enter a search query.</p>';
    }
  });
}

const selectroom = document.getElementById('')

const createRoomForm = document.getElementById('createRoomForm');
const private = document.getElementById('Privateyes');
const privateinput = document.getElementById('privateInput')
if (private) {
  private.addEventListener('click', () => {
    if (private.checked) {
      privateinput.style.display = 'block';
    } else {
      privateinput.style.display = 'none';
    }
  });
}
if (createRoomForm) {
  createRoomForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const sessionName = document.getElementById('sessionName').value.trim();
    const subject = document.getElementById('subject').value.trim();
    if (sessionName && subject) {
      alert(`Room "${sessionName}" created for "${subject}"! (Placeholder functionality)`);
      createRoomForm.reset();
      // Add logic to create room via API and redirect to room.html
    } else {
      alert('Please fill in all fields.');
    }
  });
}

const chatForm = document.getElementById('chatForm');
if (chatForm) {
  chatForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const chatWindow = document.getElementById('chatWindow');
    const chatInput = document.getElementById('chatInput');
    const msg = chatInput.value.trim();
    if (msg) {
      const newMsg = document.createElement('div');
      newMsg.className = 'chat-message';
      newMsg.innerHTML = `<strong>You:</strong> ${msg}`;
      chatWindow.appendChild(newMsg);
      chatInput.value = '';
      chatWindow.scrollTop = chatWindow.scrollHeight;
      // Add logic to send message via WebSocket in a real app
    } else {
      alert('Please enter a message.');
    }
  });
}




const signUpForm = document.getElementById('signUpForm');
if (signUpForm) {
  signUpForm.addEventListener('submit', (e) => {
    e.preventDefault();
    // const username = document.getElementById('username').value.trim();
    // const email = document.getElementById('email').value.trim();
    // const password = document.getElementById('password').value.trim();
    // const confirmPassword = document.getElementById('confirmPassword').value.trim();

    const userData = {
      username: document.getElementById('username').value.trim(),
      email: document.getElementById('email').value.trim(), 
      password: document.getElementById('password').value.trim()
    };
    if (username && email && password && confirmPassword) {
      if (password === confirmPassword) {
        fetch('signup.php',{
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(userData)
        })
        .then(response => response.json())
        .then(data => {
          console.log('Success:', data);
        })
        .catch((error) => {
          console.error('Error:', error);
        });
        alert(`Sign-up successful for ${username}! (Placeholder functionality)`);
        signUpForm.reset();
        // Add logic to register user via API
      } else {
        alert('Passwords do not match.');
      }
    } else {
      alert('Please fill in all fields.');
    }
  });
}
