<?php
/**
 * monkey.php
 * Reusable monkey mascot SVG component for EventMS.
 *
 * Usage: <?php include "monkey.php"; ?>
 *
 * SVG coordinate reference (viewBox 0 0 200 230):
 *   Left  eye      : (80,  72)  -- L_EYE in monkey.js
 *   Right eye      : (120, 72)  -- R_EYE in monkey.js
 *   L palm at rest : (27,  183) -- L_REST in monkey.js
 *   R palm at rest : (173, 183) -- R_REST in monkey.js
 */
?>

<div class="monkey-stage bouncing" id="monkey-stage">

      <div class="bubble" id="bubble">👋 Hello there!</div>

      <!--
        SVG coordinate plan (viewBox 0 0 200 230):
        Head centre: (100, 78)
        Left eye centre: (80, 72)   ← left arm hand must land HERE
        Right eye centre: (120, 72) ← right arm hand must land HERE
        Left shoulder (arm pivot): (58, 125)
        Right shoulder (arm pivot): (142, 125)

        Arms hang DOWN in rest position.
        To cover eyes we translate the whole arm group so the palm
        sits directly on top of the eye, using JS-computed translateX/Y.
      -->
      <svg id="monkey-svg" viewBox="0 0 200 230" fill="none" xmlns="http://www.w3.org/2000/svg">

        <!-- TAIL (behind body) -->
        <path id="tail-path" d="M130 168 Q162 174 164 148 Q166 128 144 122"
              stroke="#b8712e" stroke-width="7" stroke-linecap="round" fill="none"/>

        <!-- BODY -->
        <ellipse cx="100" cy="168" rx="44" ry="46" fill="#d4874d"/>
        <!-- Belly -->
        <ellipse cx="100" cy="173" rx="26" ry="30" fill="#f5c48a"/>

        <!-- LEGS -->
        <path d="M82 208 Q73 220 68 230" stroke="#c07030" stroke-width="13" stroke-linecap="round" fill="none"/>
        <path d="M118 208 Q127 220 132 230" stroke="#c07030" stroke-width="13" stroke-linecap="round" fill="none"/>
        <ellipse cx="63" cy="229" rx="14" ry="7" fill="#b86828" transform="rotate(-8 63 229)"/>
        <ellipse cx="137" cy="229" rx="14" ry="7" fill="#b86828" transform="rotate(8 137 229)"/>

        <!--
          LEFT ARM GROUP
          Rest: arm hangs down-left, palm at roughly (28, 182)
          Cover: palm must reach left eye at (80, 72)
          JS will set transform="translate(Δx, Δy)" to shift the whole group
          so that palm (28,182) → (80,72): Δx=+52, Δy=-110
        -->
        <g id="arm-l-group">
          <!-- upper arm path from shoulder -->
          <path d="M60 128 Q38 148 26 168 Q20 180 28 182" stroke="#c07030" stroke-width="12" stroke-linecap="round" fill="none"/>
          <!-- palm -->
          <circle cx="27" cy="183" r="14" fill="#d4874d"/>
          <!-- 4 fingers -->
          <circle cx="14" cy="174" r="8" fill="#d4874d"/>
          <circle cx="11" cy="185" r="7.5" fill="#d4874d"/>
          <circle cx="17" cy="195" r="8" fill="#d4874d"/>
          <circle cx="29" cy="198" r="7.5" fill="#d4874d"/>
          <!-- knuckle shading -->
          <circle cx="14" cy="174" r="3" fill="#c07030" opacity="0.35"/>
          <circle cx="11" cy="185" r="2.5" fill="#c07030" opacity="0.35"/>
          <circle cx="17" cy="195" r="3" fill="#c07030" opacity="0.35"/>
          <circle cx="29" cy="198" r="2.5" fill="#c07030" opacity="0.35"/>
        </g>

        <!--
          RIGHT ARM GROUP
          Rest: arm hangs down-right, palm at roughly (172, 182)
          Cover: palm must reach right eye at (120, 72)
          Δx = 120-172 = -52,  Δy = 72-182 = -110
        -->
        <g id="arm-r-group">
          <path d="M140 128 Q162 148 174 168 Q180 180 172 182" stroke="#c07030" stroke-width="12" stroke-linecap="round" fill="none"/>
          <circle cx="173" cy="183" r="14" fill="#d4874d"/>
          <circle cx="186" cy="174" r="8" fill="#d4874d"/>
          <circle cx="189" cy="185" r="7.5" fill="#d4874d"/>
          <circle cx="183" cy="195" r="8" fill="#d4874d"/>
          <circle cx="171" cy="198" r="7.5" fill="#d4874d"/>
          <circle cx="186" cy="174" r="3" fill="#c07030" opacity="0.35"/>
          <circle cx="189" cy="185" r="2.5" fill="#c07030" opacity="0.35"/>
          <circle cx="183" cy="195" r="3" fill="#c07030" opacity="0.35"/>
          <circle cx="171" cy="198" r="2.5" fill="#c07030" opacity="0.35"/>
        </g>

        <!-- NECK -->
        <ellipse cx="100" cy="126" rx="22" ry="13" fill="#d4874d"/>

        <!-- EARS -->
        <circle cx="42" cy="82" r="24" fill="#d4874d"/>
        <circle cx="42" cy="82" r="15" fill="#b86030"/>
        <circle cx="42" cy="82" r="8"  fill="#a05028"/>
        <circle cx="158" cy="82" r="24" fill="#d4874d"/>
        <circle cx="158" cy="82" r="15" fill="#b86030"/>
        <circle cx="158" cy="82" r="8"  fill="#a05028"/>

        <!-- HEAD -->
        <ellipse cx="100" cy="78" rx="56" ry="54" fill="#d4874d"/>

        <!-- MUZZLE -->
        <ellipse cx="100" cy="98" rx="32" ry="21" fill="#f5c48a"/>

        <!-- EYES (opacity controlled via class on stage) -->
        <g id="eyes-group">
          <!-- left eye -->
          <ellipse cx="80"  cy="72" rx="14" ry="15" fill="white"/>
          <circle  cx="82"  cy="74" r="9"   fill="#2b1608"/>
          <circle  cx="84"  cy="72" r="4.5" fill="#130a02"/>
          <circle  cx="87"  cy="70" r="2.5" fill="white"/>
          <!-- right eye -->
          <ellipse cx="120" cy="72" rx="14" ry="15" fill="white"/>
          <circle  cx="122" cy="74" r="9"   fill="#2b1608"/>
          <circle  cx="124" cy="72" r="4.5" fill="#130a02"/>
          <circle  cx="127" cy="70" r="2.5" fill="white"/>
        </g>

        <!-- EYEBROWS -->
        <path id="brow-l" d="M70 57 Q80 52 90 57" stroke="#2b1608" stroke-width="3.5" stroke-linecap="round" fill="none"/>
        <path id="brow-r" d="M110 57 Q120 52 130 57" stroke="#2b1608" stroke-width="3.5" stroke-linecap="round" fill="none"/>

        <!-- NOSE -->
        <ellipse cx="100" cy="91" rx="10" ry="7" fill="#b06030"/>
        <circle cx="96"  cy="91" r="3.2" fill="#8a4220"/>
        <circle cx="104" cy="91" r="3.2" fill="#8a4220"/>

        <!-- HAPPY MOUTH -->
        <g id="mouth-happy">
          <path d="M82 104 Q100 122 118 104" stroke="#8a4220" stroke-width="2.5" stroke-linecap="round" fill="none"/>
          <path d="M82 104 Q100 122 118 104 Q109 115 91 115 Z" fill="#8a4220" opacity="0.10"/>
          <rect x="91" y="105" width="9" height="7" rx="2.5" fill="white" opacity="0.9"/>
          <rect x="101" y="105" width="9" height="7" rx="2.5" fill="white" opacity="0.9"/>
        </g>

        <!-- NEUTRAL MOUTH (shown when covering) -->
        <path id="mouth-neutral" d="M90 110 Q100 114 110 110" stroke="#8a4220" stroke-width="2.5" stroke-linecap="round" fill="none"/>

        <!-- BLUSH -->
        <ellipse cx="60"  cy="92" rx="12" ry="8" fill="rgba(220,90,60,0.17)"/>
        <ellipse cx="140" cy="92" rx="12" ry="8" fill="rgba(220,90,60,0.17)"/>

        <!-- HAIR TUFT -->
        <ellipse cx="86"  cy="28" rx="7" ry="11" fill="#c07030" transform="rotate(-12 86 28)"/>
        <ellipse cx="100" cy="24" rx="7" ry="12" fill="#c87838"/>
        <ellipse cx="114" cy="28" rx="7" ry="11" fill="#c07030" transform="rotate(12 114 28)"/>
      </svg>
    </div>