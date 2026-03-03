// ─── Elements ───────────────────────────────────────────────
  const stage    = document.getElementById('monkey-stage');
  const bubble   = document.getElementById('bubble');
  const browL    = document.getElementById('brow-l');
  const browR    = document.getElementById('brow-r');
  const armL     = document.getElementById('arm-l-group');
  const armR     = document.getElementById('arm-r-group');
  const eyeGroup = document.getElementById('eyes-group');
  const svgEl    = document.getElementById('monkey-svg');
  const emailIn  = document.getElementById('email');
  const passIn   = document.getElementById('password');

  // ─── Arm positions (SVG-space coordinates) ─────────────────
  // Palm centre in REST position (where we drew it)
  const L_REST = { x: 27,  y: 183 };
  const R_REST = { x: 173, y: 183 };
  // Where we want palms to land (over each eye)
  const L_EYE  = { x: 78,  y: 68  };
  const R_EYE  = { x: 122, y: 68  };
  // Wave tip (arms raised but out to sides for greeting)
  const L_WAVE = { x: 10,  y: 90  };
  const R_WAVE = { x: 190, y: 90  };

  // ─── State ──────────────────────────────────────────────────
  // 'idle'    – no input, no content → bounce + arms rest
  // 'waving'  – page-load greeting → arms wave once then → idle
  // 'covered' – any field has content → arms over eyes
  let covered = false;

  // ─── Helpers ────────────────────────────────────────────────
  function setArm(el, target, restPos) {
    const dx = target.x - restPos.x;
    const dy = target.y - restPos.y;
    el.style.transform = `translate(${dx}px, ${dy}px)`;
  }
  function resetArm(el) {
    el.style.transform = 'translate(0px, 0px)';
  }

  function coverEyes() {
    if (covered) return;
    covered = true;
    stage.classList.remove('bouncing');
    // Move arms to eyes
    setArm(armL, L_EYE, L_REST);
    setArm(armR, R_EYE, R_REST);
    // After arms start moving, hide eyes & change expression
    setTimeout(() => {
      eyeGroup.style.opacity = '0';
      stage.classList.add('mouth-sad', 'eyes-hidden');
      browL.setAttribute('d', 'M70 53 Q80 48 90 53');
      browR.setAttribute('d', 'M110 53 Q120 48 130 53');
    }, 150);
    bubble.classList.add('hidden');
  }

  function uncoverEyes() {
    if (!covered) return;
    covered = false;
    // Restore eyes & expression immediately
    eyeGroup.style.opacity = '1';
    stage.classList.remove('mouth-sad', 'eyes-hidden');
    browL.setAttribute('d', 'M70 57 Q80 52 90 57');
    browR.setAttribute('d', 'M110 57 Q120 52 130 57');
    // Move arms back down
    resetArm(armL);
    resetArm(armR);
    // Resume bounce after arms finish returning
    setTimeout(() => {
      stage.classList.add('bouncing');
      bubble.classList.remove('hidden');
    }, 450);
  }

  function hasContent() {
    return emailIn.value.trim().length > 0 || passIn.value.length > 0;
  }

  function checkState() {
    if (hasContent()) {
      coverEyes();
    } else {
      uncoverEyes();
    }
  }

  // ─── Listen on both inputs ───────────────────────────────────
  // 'input' fires whenever value changes (typing, paste, autofill)
  emailIn.addEventListener('input', checkState);
  passIn.addEventListener('input', checkState);

  // Also re-check on focus (catches autofill that doesn't fire 'input')
  emailIn.addEventListener('focus', checkState);
  passIn.addEventListener('focus', checkState);
  emailIn.addEventListener('blur',  checkState);
  passIn.addEventListener('blur',   checkState);

  // ─── Page-load entrance wave ─────────────────────────────────
  // Set arms to raised-wave position immediately (no transition)
  armL.style.transition = 'none';
  armR.style.transition = 'none';
  setArm(armL, L_WAVE, L_REST);
  setArm(armR, R_WAVE, R_REST);

  // After a tick, re-enable transition and lower arms back to rest
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      armL.style.transition = 'transform 0.55s cubic-bezier(0.34,1.3,0.64,1)';
      armR.style.transition = 'transform 0.55s cubic-bezier(0.34,1.3,0.64,1)';
      // Wait 1.2 s then lower arms (wave duration)
      setTimeout(() => {
        resetArm(armL);
        resetArm(armR);
      }, 1200);
    });
  });

  // ─── Password reveal toggle ──────────────────────────────────
  const toggleBtn = document.getElementById('toggle-pw');
  const pwInput   = document.getElementById('password');
  const eyeIcon   = document.getElementById('eye-icon');
  toggleBtn.addEventListener('click', () => {
    const show = pwInput.type === 'password';
    pwInput.type = show ? 'text' : 'password';
    eyeIcon.innerHTML = show
      ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
         <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
         <line x1="1" y1="1" x2="23" y2="23"/>`
      : `<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>
         <circle cx="12" cy="12" r="3"/>`;
  });

  (function () {
  'use strict';

  /* ── Extra inputs not watched by monkey.js ─────────────────── */
  var nameIn    = document.getElementById('name');
  var confirmIn = document.getElementById('password_confirmation');
  var emailIn   = document.getElementById('email');
  var passIn    = document.getElementById('password');

  /* ── Monkey elements (same as monkey.js) ────────────────────── */
  var stage    = document.getElementById('monkey-stage');
  var bubble   = document.getElementById('bubble');
  var browL    = document.getElementById('brow-l');
  var browR    = document.getElementById('brow-r');
  var armL     = document.getElementById('arm-l-group');
  var armR     = document.getElementById('arm-r-group');
  var eyeGroup = document.getElementById('eyes-group');

  /* ── SVG coordinate constants (must match monkey.js) ──────── */
  var L_REST = { x: 27,  y: 183 };
  var R_REST = { x: 173, y: 183 };
  var L_EYE  = { x: 78,  y: 68  };
  var R_EYE  = { x: 122, y: 68  };

  /* ── Shared state flag (mirrors monkey.js internal state) ──── */
  /* We piggyback on the CSS class .eyes-hidden on stage as the
     single source of truth so both scripts stay in sync.         */
  function isCovered() {
    return stage.classList.contains('eyes-hidden');
  }

  function moveArm(el, target, origin) {
    el.style.transform = 'translate(' + (target.x - origin.x) + 'px, '
                                      + (target.y - origin.y) + 'px)';
  }
  function resetArm(el) {
    el.style.transform = 'translate(0px, 0px)';
  }

  function coverEyes() {
    if (isCovered()) return;
    stage.classList.remove('bouncing');
    moveArm(armL, L_EYE, L_REST);
    moveArm(armR, R_EYE, R_REST);
    setTimeout(function () {
      eyeGroup.style.opacity = '0';
      stage.classList.add('mouth-sad', 'eyes-hidden');
      browL.setAttribute('d', 'M70 53 Q80 48 90 53');
      browR.setAttribute('d', 'M110 53 Q120 48 130 53');
    }, 150);
    bubble.classList.add('hidden');
  }

  function uncoverEyes() {
    if (!isCovered()) return;
    eyeGroup.style.opacity = '1';
    stage.classList.remove('mouth-sad', 'eyes-hidden');
    browL.setAttribute('d', 'M70 57 Q80 52 90 57');
    browR.setAttribute('d', 'M110 57 Q120 52 130 57');
    resetArm(armL);
    resetArm(armR);
    setTimeout(function () {
      stage.classList.add('bouncing');
      bubble.classList.remove('hidden');
    }, 450);
  }

  function hasAnyContent() {
    return (nameIn    && nameIn.value.trim().length    > 0)
        || (emailIn   && emailIn.value.trim().length   > 0)
        || (passIn    && passIn.value.length           > 0)
        || (confirmIn && confirmIn.value.length        > 0);
  }

  function checkState() {
    if (hasAnyContent()) { coverEyes(); } else { uncoverEyes(); }
  }

  /* ── Bind extra fields ─────────────────────────────────────── */
  ['input', 'focus', 'blur', 'change'].forEach(function (evt) {
    if (nameIn)    nameIn.addEventListener(evt, checkState);
    if (confirmIn) confirmIn.addEventListener(evt, checkState);
    /* Re-bind email + password too so this script owns the full
       hasAnyContent() check instead of just the subset in monkey.js */
    if (emailIn) emailIn.addEventListener(evt, checkState);
    if (passIn)  passIn.addEventListener(evt, checkState);
  });

  /* ── Confirm-password toggle ───────────────────────────────── */
  var toggleConfirm = document.getElementById('toggle-confirm');
  var eyeIconConfirm = document.getElementById('eye-icon-confirm');
  if (toggleConfirm && confirmIn && eyeIconConfirm) {
    toggleConfirm.addEventListener('click', function () {
      var show = confirmIn.type === 'password';
      confirmIn.type = show ? 'text' : 'password';
      eyeIconConfirm.innerHTML = show
        ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8'
        + 'a18.45 18.45 0 0 1 5.06-5.94"/>'
        + '<path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8'
        + 'a18.5 18.5 0 0 1-2.16 3.19"/>'
        + '<line x1="1" y1="1" x2="23" y2="23"/>'
        : '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>'
        + '<circle cx="12" cy="12" r="3"/>';
    });
  }

  /* ── Password strength meter ───────────────────────────────── */
  var strengthFill  = document.getElementById('strength-fill');
  var strengthLabel = document.getElementById('strength-label');

  var levels = [
    { label: '',          color: 'transparent', width: '0%'   },
    { label: 'Weak',      color: '#ef4444',     width: '25%'  },
    { label: 'Fair',      color: '#f97316',     width: '50%'  },
    { label: 'Good',      color: '#eab308',     width: '75%'  },
    { label: 'Strong',    color: '#22c55e',     width: '100%' }
  ];

  function scorePassword(pw) {
    if (!pw) return 0;
    var score = 0;
    if (pw.length >= 8)  score++;
    if (pw.length >= 12) score++;
    if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
    if (/[0-9]/.test(pw))  score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;
    return Math.min(4, score);
  }

  if (passIn && strengthFill && strengthLabel) {
    passIn.addEventListener('input', function () {
      var lvl = levels[scorePassword(passIn.value)];
      strengthFill.style.width      = lvl.width;
      strengthFill.style.background = lvl.color;
      strengthLabel.textContent     = lvl.label;
      strengthLabel.style.color     = lvl.color;
    });
  }

}());