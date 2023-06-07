<script setup>
import ChevronRight from "@/Components/Icons/ChevronRight.vue";
import ChevronLeft from "@/Components/Icons/ChevronLeft.vue";

import { nextTick, onMounted, ref, watch } from "vue";

const props = defineProps({
  list: Array,
  title: String,
});

const scrollArea = ref(null);
const scrollLeft = ref(0);
const cardWidth = ref(224);
const areaWidth = ref(0);
const scrollWidth = ref(0);
const areaFocused = ref(false);

watch(
  () => props.list,
  (newList, oldList) => {
    scrollWidth.value = newList.length * cardWidth.value;
    updateIndicatiors();
  }
);

const initScroll = async () => {
  await nextTick();
  scrollLeft.value = scrollArea.value.scrollLeft;
  areaWidth.value = scrollArea.value.clientWidth;

  window.addEventListener("wheel", onScroll, { passive: false });
  updateIndicatiors();
};

const scrollToPosition = (pos) => {
  scrollArea.value.scrollLeft = pos;
  scrollLeft.value = pos;
  updateIndicatiors();
};

const getScrollLeftValue = () => {
  if (scrollLeft.value < 0) return 0;
  if (scrollLeft.value > scrollWidth.value - areaWidth.value)
    return scrollWidth.value - areaWidth.value;
  return scrollLeft.value;
};

const updateIndicatiors = async () => {
  await nextTick();
  const rectViewport = scrollArea.value.getBoundingClientRect();
  const left = getScrollLeftValue();
  const leftEnd = rectViewport.left + left - cardWidth.value;
  const rightEnd = rectViewport.left + left + areaWidth.value;
  props.list.forEach((item, index) => {
    const condition =
      index * cardWidth.value >= leftEnd && index * cardWidth.value <= rightEnd;
    const indicator = document.getElementById("card-indicatior-" + item.id);
    if (!indicator) return;
    if (condition) {
      indicator.classList.add("active");
    } else {
      indicator.classList.remove("active");
    }
  });
};

const onScroll = (event) => {
  if (areaFocused.value) {
    event.preventDefault();
    areaWidth.value = scrollArea.value.clientWidth;
    const newPosition = scrollArea.value.scrollLeft + event.deltaY * 7;
    scrollToPosition(newPosition);
  }
};

const moveRight = (event) => {
  const newPosition = scrollArea.value.scrollLeft + areaWidth.value - 200;
  scrollToPosition(newPosition);
};

const moveLeft = (event) => {
  const newPosition = scrollArea.value.scrollLeft - areaWidth.value + 200;
  scrollToPosition(newPosition);
};

onMounted(() => {
  initScroll();
});
</script>
<template>
  <div class="flex justify-between items-center">
    <h5 class="text-xl font-bold mb-2">{{ title }}</h5>
    <div class="flex space-x-0.5">
      <div
        class="card-indicator"
        :id="'card-indicatior-' + item.id"
        v-for="item in list"
        :key="item.id"
      ></div>
    </div>
  </div>
  <div class="w-full relative">
    <div
      ref="scrollArea"
      class="is-scrollbar-hidden col-span-12 flex space-x-4 overflow-x-auto px-[var(--margin-x)] transition-all duration-[.25s] lg:col-span-9 lg:pl-0 scroll-smooth"
      @mouseover="areaFocused = true"
      @mouseout="areaFocused = false"
    >
      <div
        class="movie-card"
        :id="'card-item-' + item.id"
        v-for="item in list"
        :key="item.id"
      >
        <img
          v-show="item.poster_path"
          class="w-full h-full rounded-xl"
          :src="'http://image.tmdb.org/t/p/w300/' + item.poster_path"
        />
      </div>
    </div>
    <div
      class="absolute z-10 left-0 top-1/2 -translate-y-1/2 h-full flex flex-col justify-center items-center bg-gradient-to-l from-transparent to-slate-200 dark:to-slate-800"
      @click="moveLeft"
      v-show="scrollLeft > 0"
    >
      <button class="btn-hover btn-theme btn-sm ml-2">
        <ChevronLeft />
      </button>
    </div>
    <div
      class="absolute z-10 right-0 top-1/2 -translate-y-1/2 h-full flex flex-col justify-center items-center bg-gradient-to-r from-transparent to-slate-200 dark:to-slate-800"
      @click="moveRight"
      v-show="scrollLeft < scrollWidth - areaWidth - 50"
    >
      <button class="btn-hover btn-theme btn-sm mr-2">
        <ChevronRight />
      </button>
    </div>
  </div>
</template>