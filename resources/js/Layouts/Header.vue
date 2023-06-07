<script setup>
import { handleColorSchemeToggle } from "@/Functions/helpers";
import { onMounted, onUnmounted, ref } from "vue";

const searchVisible = ref(false);
const searchPopup = ref(null);
const searchInput = ref(null);

const handleSearch = () => {
  if (!searchVisible.value) {
    searchVisible.value = true;
    searchInput.value.focus();
  }
};

const clickHandler = ({ target }) => {
  if (!searchVisible.value || searchPopup.value.contains(target)) return;
  searchVisible.value = false;
};

const keyHandler = ({ keyCode }) => {
  if (!searchVisible.value || keyCode !== 27) return;
  searchVisible.value = false;
};

onMounted(() => {
  document.addEventListener("click", clickHandler);
  document.addEventListener("keydown", keyHandler);
  handleColorSchemeToggle();
});

onUnmounted(() => {
  document.removeEventListener("click", clickHandler);
  document.removeEventListener("keydown", keyHandler);
});
</script>
<template>
  <div class="flex space-x-2">
    <div class="w-full">
      <div class="w-full flex justify-between items-center h-full">
        <div><h2 class="text-2xl mb-0 font-bold uppercase"></h2></div>
        <div></div>
      </div>
    </div>
    <div
      class="bg-slate-200 dark:bg-slate-800 rounded-lg shadow flex"
      @click="handleSearch()"
      ref="searchPopup"
    >
      <div>
        <input
          ref="searchInput"
          placeholder="Search movies and more..."
          type="text"
          class="form-input h-full transition-all duration-300"
          :class="searchVisible ? 'w-52 mr-2' : 'w-0 !p-0 !border-none'"
        />
      </div>
      <button class="btn-hover btn-primary">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-search"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
          <path d="M21 21l-6 -6"></path>
        </svg>
      </button>
    </div>
    <div class="bg-slate-200 dark:bg-slate-800 rounded-lg shadow">
      <button class="btn-hover btn-secondary" id="theme-toggle">
        <svg
          id="theme-toggle-dark-icon"
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-sun-low"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
          <path d="M4 12h.01"></path>
          <path d="M12 4v.01"></path>
          <path d="M20 12h.01"></path>
          <path d="M12 20v.01"></path>
          <path d="M6.31 6.31l-.01 -.01"></path>
          <path d="M17.71 6.31l-.01 -.01"></path>
          <path d="M17.7 17.7l.01 .01"></path>
          <path d="M6.3 17.7l.01 .01"></path>
        </svg>
        <svg
          id="theme-toggle-light-icon"
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-moon-stars"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path
            d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"
          ></path>
          <path
            d="M17 4a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2"
          ></path>
          <path d="M19 11h2m-1 -1v2"></path>
        </svg>
      </button>
    </div>
  </div>
</template>