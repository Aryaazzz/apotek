<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Apotek - Ramadhan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Quicksand', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #0f2027 0%, #2c5364 60%, #a8e063 100%);
  min-height: 100vh;
  margin: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;
  overflow-x: hidden;
}
body::before {
  content: '';
  position: absolute;
  top: 0; left: 0; width: 100vw; height: 100vh;
  background: url('https://svgshare.com/i/13wF.svg') repeat top center;
  opacity: 0.08;
  z-index: 0;
}
.ramadhan-ornament {
  position: absolute;
  top: 0; left: 0; width: 100vw; height: 100vh;
  pointer-events: none;
  z-index: 1;
}
.ramadhan-ornament .moon {
  position: absolute;
  top: 40px; left: 60px;
  font-size: 70px;
  color: #ffe066;
  filter: drop-shadow(0 0 16px #ffe06688);
  animation: moon-glow 3s ease-in-out infinite alternate, moon-move 8s ease-in-out infinite alternate;
}
@keyframes moon-move {
  0% { transform: translateY(0) scale(1) rotate(-5deg); }
  50% { transform: translateY(18px) scale(1.07) rotate(7deg); }
  100% { transform: translateY(0) scale(1) rotate(-5deg); }
}

.ramadhan-ornament .star {
  position: absolute;
  color: #fffbe6;
  font-size: 28px;
  filter: drop-shadow(0 0 8px #fffbe6cc);
  animation: star-twinkle 2s infinite alternate, star-move 7s ease-in-out infinite alternate;
}
@keyframes star-move {
  0% { transform: translateY(0) scale(1) rotate(0deg); }
  20% { transform: translateY(-7px) scale(1.08) rotate(-8deg); }
  40% { transform: translateY(5px) scale(0.95) rotate(8deg); }
  60% { transform: translateY(-4px) scale(1.04) rotate(-6deg); }
  80% { transform: translateY(6px) scale(1.02) rotate(6deg); }
  100% { transform: translateY(0) scale(1) rotate(0deg); }
}

.ramadhan-ornament .star.s1 { top: 80px; left: 140px; animation-delay: 0.2s; }
.ramadhan-ornament .star.s2 { top: 120px; left: 80vw; animation-delay: 0.7s; }
.ramadhan-ornament .star.s3 { top: 200px; left: 60vw; animation-delay: 1.2s; }
.ramadhan-ornament .star.s4 { top: 60vh; left: 90vw; animation-delay: 0.5s; }
.ramadhan-ornament .star.s5 { top: 70vh; left: 10vw; animation-delay: 1.5s; }
.ramadhan-ornament .lantern {
  position: absolute;
  top: 0; left: 50vw;
  transform: translateX(-50%);
  width: 80px;
  height: 120px;
  z-index: 2;
  animation: lantern-swing 3s ease-in-out infinite alternate;
}
@keyframes moon-glow {
  from { filter: drop-shadow(0 0 8px #ffe06644); }
  to { filter: drop-shadow(0 0 32px #ffe066cc); }
}
@keyframes star-twinkle {
  from { opacity: 0.7; }
  to { opacity: 1; }
}
@keyframes lantern-swing {
  0% { transform: translateX(-50%) rotate(-7deg); }
  100% { transform: translateX(-50%) rotate(7deg); }
}
.box {
  background: rgba(255,255,255,0.97);
  padding: 44px 36px 36px 36px;
  width: 400px;
  max-width: 92vw;
  border-radius: 28px;
  box-shadow: 0 24px 48px rgba(0,0,0,0.18), 0 8px 24px rgba(0,0,0,0.10);
  position: relative;
  z-index: 10;
  overflow: hidden;
  border: 2px solid #ffe06644;
  animation: box-fadein 1.2s cubic-bezier(.4,0,.2,1);
}
@keyframes box-fadein {
  from { opacity: 0; transform: translateY(60px) scale(0.95); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}
.box::before {
  content: '';
  position: absolute;
  top: -60px; left: -60px;
  width: 120px; height: 120px;
  background: radial-gradient(circle, #ffe06655 0%, transparent 70%);
  border-radius: 50%;
  animation: pulse 4s ease-in-out infinite;
}
.box::after {
  content: '';
  position: absolute;
  bottom: -60px; right: -60px;
  width: 100px; height: 100px;
  background: radial-gradient(circle, #a8e06355 0%, transparent 70%);
  border-radius: 50%;
  animation: pulse 5s ease-in-out infinite reverse;
}
@keyframes pulse {
  0%, 100% { transform: scale(1); opacity: 0.5; }
  50% { transform: scale(1.1); opacity: 1; }
}
.welcome {
  text-align: center;
  margin-bottom: 15px;
  color: #0f5132;
  font-size: 19px;
  font-weight: 600;
  line-height: 1.5;
  animation: fadeIn 2s ease-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #0f5132;
  font-size: 32px;
  font-weight: 800;
  letter-spacing: 1px;
  position: relative;
  text-shadow: 0 2px 8px #ffe06644;
}
h2::before {
  content: '\f186';
  font-family: 'Font Awesome 6 Free';
  font-weight: 900;
  position: absolute;
  left: -44px;
  top: 50%;
  transform: translateY(-50%);
  color: #ffe066;
  font-size: 28px;
  animation: spin 7s linear infinite;
}
@keyframes spin {
  from { transform: translateY(-50%) rotate(0deg); }
  to { transform: translateY(-50%) rotate(360deg); }
}
input {
  width: 100%;
  padding: 18px;
  margin-top: 15px;
  border: 2px solid #e0e0e0;
  border-radius: 13px;
  font-size: 16px;
  transition: all 0.3s;
  box-sizing: border-box;
  background: #f9f9f9;
}
input:focus {
  border-color: #ffe066;
  box-shadow: 0 0 15px #ffe06655;
  outline: none;
  background: #fff;
}
input::placeholder {
  color: #bdb76b;
  font-style: italic;
}
button {
  width: 100%;
  padding: 18px;
  margin-top: 25px;
  background: linear-gradient(90deg, #0f5132 0%, #a8e063 100%);
  color: white;
  border: none;
  border-radius: 13px;
  cursor: pointer;
  font-size: 18px;
  font-weight: 700;
  transition: all 0.3s;
  position: relative;
  overflow: hidden;
  box-shadow: 0 5px 18px #0f513244;
}
button::before {
  content: '';
  position: absolute;
  top: 0; left: -100%; width: 100%; height: 100%;
  background: linear-gradient(90deg, transparent, #ffe06655, transparent);
  transition: left 0.6s;
}
button:hover {
  transform: translateY(-2px) scale(1.01);
  box-shadow: 0 10px 28px #0f513244;
}
button:hover::before {
  left: 100%;
}
button:active {
  transform: translateY(0);
}
.role {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 32px;
  margin-bottom: 8px;
}
.role label {
  display: flex;
  align-items: center;
  cursor: pointer;
  font-size: 16px;
  color: #0f5132;
  transition: color 0.3s;
  padding: 10px 24px 10px 12px;
  border-radius: 10px;
  background: #a8e06322;
  font-weight: 600;
  min-width: 140px;
  justify-content: flex-start;
  box-shadow: 0 2px 8px #a8e06311;
}
.role label:hover {
  color: #ffe066;
  background: #0f513211;
}
.role input[type="radio"] {
  margin-right: 12px;
  accent-color: #ffe066;
  width: 20px;
  height: 20px;
}
#msg {
  color: #d32f2f;
  margin-top: 15px;
  text-align: center;
  font-weight: 600;
  animation: shake 0.5s;
}
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-5px); }
  75% { transform: translateX(5px); }
}
.footer {
  margin-top: 50px;
  text-align: center;
  color: #ffe066;
  font-size: 15px;
  opacity: 0.92;
  animation: fadeIn 2s ease-out 1s both;
  z-index: 10;
}
.footer p {
  margin: 5px 0;
}
.footer .icons {
  margin-top: 10px;
}
.footer .icons i {
  margin: 0 10px;
  font-size: 22px;
  color: #ffe066;
  transition: color 0.3s;
}
.footer .icons i:hover {
  color: #a8e063;
}
@media (max-width: 768px) {
  .box { padding: 28px; width: 96vw; }
  h2 { font-size: 25px; }
  h2::before { left: -30px; font-size: 20px; }
  .welcome { font-size: 15px; }
  .footer { margin-top: 30px; font-size: 12px; }
}
@media (max-width: 480px) {
  .box { padding: 18px; }
  h2 { font-size: 18px; }
  h2::before { left: -18px; font-size: 15px; }
  .welcome { font-size: 12px; }
  .footer { margin-top: 18px; }
}
</style>
</head>

<body>

  <!-- Ornamen Ramadhan: Bulan sabit, bintang, lentera -->
  <div class="ramadhan-ornament">
    <i class="fas fa-moon moon"></i>
    <i class="fas fa-star star s1"></i>
    <i class="fas fa-star star s2"></i>
    <i class="fas fa-star star s3"></i>
    <i class="fas fa-star star s4"></i>
    <i class="fas fa-star star s5"></i>
    <svg class="lantern" viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg">
      <ellipse cx="30" cy="15" rx="10" ry="15" fill="#ffe066" opacity="0.7"/>
      <rect x="20" y="30" width="20" height="35" rx="10" fill="#ffe066" stroke="#0f5132" stroke-width="2"/>
      <rect x="25" y="65" width="10" height="10" rx="5" fill="#a8e063" stroke="#0f5132" stroke-width="2"/>
      <line x1="30" y1="0" x2="30" y2="15" stroke="#0f5132" stroke-width="2"/>
    </svg>
  </div>

    <!-- Ornamen Ramadhan: Bulan sabit, bintang, lentera dengan Font Awesome -->
    <div class="ramadhan-ornament">
      <i class="fas fa-moon moon"></i>
      <i class="fas fa-star star s1"></i>
      <i class="fas fa-star star s2"></i>
      <i class="fas fa-star star s3"></i>
      <i class="fas fa-star star s4"></i>
      <i class="fas fa-star star s5"></i>
      <i class="fas fa-lantern lantern"></i>
      <i class="fas fa-lantern lantern2"></i>
      <i class="fas fa-lantern lantern3"></i>
    </div>

  <div class="box">

    <div class="welcome" style="margin-bottom: 0; display: flex; flex-direction: column; align-items: center;">
      <div style="font-size:20px;font-weight:500;color:#ffe066;text-shadow:0 2px 8px #0f513244;letter-spacing:1px;line-height:1.2;margin-bottom:10px;">
        <i class="fas fa-moon"></i>
        Marhaban yaa Ramadhan 1447 H
        <i class="fas fa-star-and-crescent"></i>
      </div>
      <div style="width:100%;text-align:center;">
        <div style="font-size:17px;color:#0f5132;font-weight:600;margin-bottom:2px;">
          Selamat datang di Apotek Kelompok Satu
        </div>
        <div style="font-size:15px;color:#0f5132;">
          Semoga bulan suci ini membawa berkah, kesehatan, dan kebahagiaan untuk kita semua.
        </div>
      </div>
    </div>
    <h2 style="margin-top:22px;"><i class="fas fa-mosque" style="color:#a8e063;margin-right:8px;"></i>Login Apotek</h2>

    <form id="loginForm">
      <input type="text" name="username" id="username" placeholder="Masukkan Username" required>
      <input type="password" name="password" id="password" placeholder="Masukkan Password" required>


      <div class="role">
        <label>
          <input type="radio" name="role" value="pembeli" checked>
          <span style="display:flex;align-items:center;gap:10px;">
            <i class="fas fa-user" style="font-size:20px;"></i> Pembeli
          </span>
        </label>
        <label>
          <input type="radio" name="role" value="admin">
          <span style="display:flex;align-items:center;gap:10px;">
            <i class="fas fa-user-shield" style="font-size:20px;"></i> Admin
          </span>
        </label>
      </div>

      <button type="submit">Login</button>
    </form>

    <p id="msg" style="color:red;margin-top:10px;"></p>
  </div>

  <!-- Footer untuk mengisi ruang bawah -->
  <div class="footer">
    <p><i class="fas fa-mosque"></i> <b>Ramadhan Kareem</b> | Apotek Kelompok Satu</p>
    <p><i class="fas fa-map-marker-alt"></i> Jl. Kesehatan No. 123, Kota Sehat</p>
    <p><i class="fas fa-clock"></i> 08:00 - 22:00 &nbsp;|&nbsp; <i class="fas fa-phone"></i> (021) 123-4567</p>
    <div class="icons">
      <i class="fab fa-facebook"></i>
      <i class="fab fa-instagram"></i>
      <i class="fab fa-twitter"></i>
      <i class="fas fa-moon"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-mosque"></i>
    </div>
  </div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('auth/login.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(res => {
    if (res.status === 'success') {
      window.location.href = res.redirect;
    } else {
      document.getElementById('msg').innerText =
        'Username, password, atau role salah';
    }
  })
  .catch(() => {
    document.getElementById('msg').innerText =
      'Server error';
  });
});
</script>

</body>
</html>