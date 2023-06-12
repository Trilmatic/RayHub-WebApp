<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import { computed, onMounted, reactive, ref } from "vue";
import videojs from "video.js";

const props = defineProps({
  video: String,
});

const videoElement = ref(null);

const initVideoJs = () => {
  const options = {};
  const player = videojs("video");
};

onMounted(() => {
  initVideoJs();
});
</script>

<template>
  <Layout>
    <Head title="Stream" />
    <div class="py-6">
      <video
        controls
        class="video-js vjs-theme-city w-full mt-4"
        preload="auto"
        id="video"
      >
        <source src="/play" type="video/x-matroska" />
        <p class="vjs-no-js">
          To view this video please enable JavaScript, and consider upgrading to
          a web browser that
          <a href="https://videojs.com/html5-video-support/" target="_blank"
            >supports HTML5 video</a
          >
        </p>
      </video>
    </div>
  </Layout>
</template>