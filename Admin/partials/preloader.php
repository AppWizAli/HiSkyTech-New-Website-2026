<!-- Preloader -->
<div id="preloader">
  <div class="loader">
    <div class="ring"></div>
    <span>Loading...</span>
  </div>
</div>
<style>
#preloader {
  position: fixed;
  inset: 0;
  background: #0f1424;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 2000;
}

.loader {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
}

.loader .ring {
  width: 46px;
  height: 46px;
  border: 4px solid rgba(255,255,255,0.12);
  border-top: 4px solid #6366f1;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

.loader span {
  color: #fff;
  font-weight: 600;
  font-size: 0.95rem;
  letter-spacing: 0.3px;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

#preloader.fade-out {
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.4s ease, visibility 0.4s ease;
}
</style>

<script>
  window.addEventListener("load", () => {
    document.getElementById("preloader").classList.add("fade-out");
  });
</script>
