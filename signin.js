const signInForm = document.getElementById('signInForm');
const signinTAB = document.getElementById('signintab');
const signupTAB = document.getElementById('signuptab');
if (signInForm) {
  signInForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    if (email && password) {
      
      //add logic to display 'Hello username'
      signinTAB.style.display = 'none'
      signupTAB.style.display = 'none'
      window.location.href = 'index.html';
      signInForm.reset();
      alert('Sign-in successful! (Placeholder functionality)');
      // Add logic to authenticate user via API
    } else {
      alert('Please fill in all fields.');
    }
  });
}


// document.getElementById('signInForm').addEventListener('submit', (e) => {
//     e.preventDefault();
//     const email = document.getElementById('email').value;
//     const password = document.getElementById('password').value;
//     if (email && password) {
//       alert('Sign-in successful! (Placeholder functionality)');
//       // Add logic to handle sign-in (e.g., API call to authenticate)
//     } else {
//       alert('Please fill in all fields.');
//     }
//  });