<div>
  <label for="designSelector" class="block text-sm font-medium text-indigo-700 mb-2">Pilih warna dan ikon</label>
  <!-- Wrapping container for side-by-side -->
    <div class="flex items-center gap-4 w-full" id="designSelector">
      <!-- ICON SELECTOR -->
      <div class="relative inline-block" id="iconDropdown">
        <!-- Toggle -->
        <div id="toggle"
             class="flex items-center justify-center w-12 h-12 bg-black cursor-pointer border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-xl">
          <span id="selectedLabel" class="flex items-center text-white"><i class="fa-solid fa-chalkboard-user"></i></span>
        </div>

        <!-- Panel -->
        <div id="iconPanel"
             class="absolute top-full left-0 mt-2 bg-white border border-gray-300 rounded-md p-3 hidden z-10 w-44">
          <div class="grid grid-cols-4 gap-3">
            <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-md cursor-pointer hover:bg-gray-100 icon-item"
                 data-value="fa-solid fa-chalkboard-user">
              <i class="fa-solid fa-chalkboard-user text-lg"></i>
            </div>
            <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-md cursor-pointer hover:bg-gray-100 icon-item"
                 data-value="fa-solid fa-user-check">
              <i class="fa-solid fa-user-check text-lg"></i>
            </div>
            <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-md cursor-pointer hover:bg-gray-100 icon-item"
                 data-value="fa-solid fa-briefcase">
              <i class="fa-solid fa-briefcase text-lg"></i>
            </div>
            <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-md cursor-pointer hover:bg-gray-100 icon-item"
                 data-value="fa-solid fa-users">
              <i class="fa-solid fa-users text-lg"></i>
            </div>
            <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-md cursor-pointer hover:bg-gray-100 icon-item"
                 data-value="fa-solid fa-user-gear">
              <i class="fa-solid fa-user-gear text-lg"></i>
            </div>
            <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-md cursor-pointer hover:bg-gray-100 icon-item"
                 data-value="fa-solid fa-user-tag">
              <i class="fa-solid fa-user-tag text-lg"></i>
            </div>
            <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-md cursor-pointer hover:bg-gray-100 icon-item"
                 data-value="fa-solid fa-user-shield">
              <i class="fa-solid fa-user-shield text-lg"></i>
            </div>
            <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-md cursor-pointer hover:bg-gray-100 icon-item"
                 data-value="fa-solid fa-user-graduate">
              <i class="fa-solid fa-user-graduate text-lg"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- COLOR SELECTOR -->
      <div class="relative inline-block w-full" id="colorDropdown">
        <!-- Toggle -->
        <div id="colorToggle"
            class="flex items-center justify-between w-full h-12 px-3 bg-white pr-4 py-2 border border-indigo-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer">
          <span id="selectedColorLabel">Select color</span>
          <i class="fa-solid fa-caret-down"></i>
        </div>

        <!-- Panel -->
        <div id="colorPanel"
            class="absolute top-full left-0 mt-2 bg-white border border-gray-300 rounded-md p-3 hidden z-10 w-44">
          <div class="grid grid-cols-4 gap-3">
            <div class="w-8 h-8 rounded-md cursor-pointer border border-gray-300 hover:scale-105 transition-transform color-item"
                data-value="linear-gradient(to bottom right, #f87171, #ef4444)"
                style="background: linear-gradient(to bottom right, #f87171, #ef4444);"><span class="hidden">red</span></div>

            <div class="w-8 h-8 rounded-md cursor-pointer border border-gray-300 hover:scale-105 transition-transform color-item"
                data-value="linear-gradient(to bottom right, #facc15, #eab308)"
                style="background: linear-gradient(to bottom right, #facc15, #eab308);"><span class="hidden">yellow</span></div>

            <div class="w-8 h-8 rounded-md cursor-pointer border border-gray-300 hover:scale-105 transition-transform color-item"
                data-value="linear-gradient(to bottom right, #4ade80, #22c55e)"
                style="background: linear-gradient(to bottom right, #4ade80, #22c55e);"><span class="hidden">green</span></div>

            <div class="w-8 h-8 rounded-md cursor-pointer border border-gray-300 hover:scale-105 transition-transform color-item"
                data-value="linear-gradient(to bottom right, #60a5fa, #3b82f6)"
                style="background: linear-gradient(to bottom right, #60a5fa, #3b82f6);"><span class="hidden">blue</span></div>

            <div class="w-8 h-8 rounded-md cursor-pointer border border-gray-300 hover:scale-105 transition-transform color-item"
                data-value="linear-gradient(to bottom right, #a78bfa, #8b5cf6)"
                style="background: linear-gradient(to bottom right, #a78bfa, #8b5cf6);"><span class="hidden">purple</span></div>

            <div class="w-8 h-8 rounded-md cursor-pointer border border-gray-300 hover:scale-105 transition-transform color-item"
                data-value="linear-gradient(to bottom right, #f472b6, #ec4899)"
                style="background: linear-gradient(to bottom right, #f472b6, #ec4899);"><span class="hidden">pink</span></div>

            <div class="w-8 h-8 rounded-md cursor-pointer border border-gray-300 hover:scale-105 transition-transform color-item"
                data-value="linear-gradient(to bottom right, #fb923c, #f97316)"
                style="background: linear-gradient(to bottom right, #fb923c, #f97316);"><span class="hidden">orange</span></div>

            <div class="w-8 h-8 rounded-md cursor-pointer border border-gray-300 hover:scale-105 transition-transform color-item"
                data-value="linear-gradient(to bottom right, #94a3b8, #64748b)"
                style="background: linear-gradient(to bottom right, #94a3b8, #64748b);"><span class="hidden">gray</span></div>
          </div>
        </div>
      </div>

      <!-- Hidden inputs -->
      <input type="hidden" name="style" id="styleInput" value="{{ request()->routeis('criteria.edit') ? old('style', $selectedStyle) : '' }}">
      <input type="hidden" name="icon" id="iconInput" value="{{ request()->routeIs('criteria.edit') ? old('icon', $selectedIcon) : '' }}">




    </div>

    <script>
      // ICON SELECTOR
const toggle = document.getElementById('toggle');
const panel = document.getElementById('iconPanel');
const items = document.querySelectorAll('.icon-item');
const label = document.getElementById('selectedLabel');

// Hidden inputs
const styleInput = document.getElementById('styleInput');
const iconInput = document.getElementById('iconInput');

toggle.addEventListener('click', () => {
  panel.classList.toggle('hidden');
});

items.forEach(item => {
  item.addEventListener('click', () => {
    const value = item.getAttribute('data-value');
    label.innerHTML = `<i class="${value}"></i>`;
    iconInput.value = value; // set hidden icon input
    panel.classList.add('hidden');

    // Keep color if already selected
    if (label.firstChild && selectedColor) {
      label.firstChild.style.color = selectedColor;
    }
  });
});

document.addEventListener('click', e => {
  if (!toggle.contains(e.target) && !panel.contains(e.target)) {
    panel.classList.add('hidden');
  }
});

// COLOR SELECTOR
let selectedColor = null;
const colorToggle = document.getElementById('colorToggle');
const colorPanel = document.getElementById('colorPanel');
const colorItems = document.querySelectorAll('.color-item');
const colorLabel = document.getElementById('selectedColorLabel');

colorToggle.addEventListener('click', () => {
  colorPanel.classList.toggle('hidden');
});

colorItems.forEach(item => {
  item.addEventListener('click', () => {
    const value = item.getAttribute('data-value'); // gradient
    const labelText = item.querySelector('span').textContent.trim(); // hidden color name
    selectedColor = value;

    // Show gradient preview + color name
    colorLabel.innerHTML =
      `<span class="inline-block w-4 h-4 rounded-sm mr-2" style="background: ${value}"></span>${labelText}`;

    // Set hidden color input value
    styleInput.value = value;

    colorPanel.classList.add('hidden');

    // Apply gradient to icon toggle background
    const iconToggle = document.getElementById('toggle');
    iconToggle.style.background = value;
  });
});

document.addEventListener('click', e => {
  if (!colorToggle.contains(e.target) && !colorPanel.contains(e.target)) {
    colorPanel.classList.add('hidden');
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const styleInput = document.getElementById('styleInput');
  const iconInput = document.getElementById('iconInput');
  const label = document.getElementById('selectedLabel');
  const colorLabel = document.getElementById('selectedColorLabel');
  const iconToggle = document.getElementById('toggle');

  // Ambil nilai lama dari hidden input
  const initialIcon = iconInput.value;
  const initialStyle = styleInput.value;

  // Set ikon awal
  if (initialIcon) {
    label.innerHTML = `<i class="${initialIcon}"></i>`;
  }

  // Set warna awal
  if (initialStyle) {
    let colorName = "Custom";
    const matchedItem = Array.from(document.querySelectorAll('.color-item'))
      .find(item => item.getAttribute('data-value') === initialStyle);
    if (matchedItem) {
      colorName = matchedItem.querySelector('span').textContent.trim();
    }

    colorLabel.innerHTML =
      `<span class="inline-block w-4 h-4 rounded-sm mr-2" style="background: ${initialStyle}"></span>${colorName}`;
    iconToggle.style.background = initialStyle;
  }
})
    </script>
</div>
