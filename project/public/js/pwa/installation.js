// Listen for the beforeinstallprompt event
// Initialize deferredPrompt for use later to show browser install prompt.
let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
  // Prevent the mini-infobar from appearing on mobile
  e.preventDefault();
  // Stash the event so it can be triggered later.
  deferredPrompt = e;
  // Update UI notify the user they can install the PWA

  if(!(Cookies.get('pwa-prompt-closed')))
    showInstallPromotion();
});

// In-app installation flow
let buttonInstall = document.querySelector("#install_pwa");
let alertInstall = document.querySelector("#install_pwa_alert")
let buttonCloseInstallPrompt = document.querySelector("#install_pwa_alert .close")

buttonInstall.addEventListener('click', async () => {
    // Hide the app provided install promotion
    hideInstallPromotion();
    // Show the install prompt
    deferredPrompt.prompt();
    // Wait for the user to respond to the prompt
    const { outcome } = await deferredPrompt.userChoice;
    // We've used the prompt, and can't use it again, throw it away
    deferredPrompt = null;
});

// Detect when the PWA was successfully installed
window.addEventListener('appinstalled', () => {
    // Hide the app-provided install promotion
    hideInstallPromotion();
    // Clear the deferredPrompt so it can be garbage collected
    deferredPrompt = null;
});

// Track how the PWA was launched
function getPWADisplayMode() {
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches;
    if (document.referrer.startsWith('android-app://')) {
      return 'twa';
    } else if (navigator.standalone || isStandalone) {
      return 'standalone';
    }
    return 'browser';
}

// Track when the display mode changes
window.matchMedia('(display-mode: standalone)').addEventListener('change', (evt) => {
    let displayMode = 'browser';
    if (evt.matches) {
      displayMode = 'standalone';
    }
});

buttonCloseInstallPrompt.addEventListener('click', async () => {
  Cookies.set('pwa-prompt-closed', true)
});

function hideInstallPromotion(){
  alertInstall.style.display = "none";
}

function showInstallPromotion(){
  alertInstall.style.display = "block";
}
