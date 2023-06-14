<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import { computed, onMounted, reactive, ref } from "vue";
import videojs from "video.js";
import { back } from "@/Functions/helpers";

const props = defineProps({
  video: Object,
});

const videoElement = ref(null);

const initVideoJs = () => {
  const options = {};
  const player = videojs("video", options);
};

onMounted(() => {
  initVideoJs();
});
</script>

<template>
  <div class="w-screen h-screen relative">
    <video
      controls
      class="video-js vjs-rayhub w-full h-full"
      preload="auto"
      id="video"
    >
      <source src="Z:/test/file_example_MP4_1920_18MG.mp4" :type="video.type" />
      <p class="vjs-no-js">
        To view this video please enable JavaScript, and consider upgrading to a
        web browser that
        <a href="https://videojs.com/html5-video-support/" target="_blank"
          >supports HTML5 video</a
        >
      </p>
    </video>
    <button @click="back" class="btn-hover btn-primary absolute left-5 top-5">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="icon icon-tabler icon-tabler-arrow-back-up"
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
        <path d="M9 14l-4 -4l4 -4"></path>
        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
      </svg>
    </button>
  </div>
</template>