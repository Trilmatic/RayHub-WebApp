<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import CardsSection from "@/Components/CardsSection.vue";
import axios from "axios";
import { onMounted, ref } from "vue";

defineProps({
  videos: Array,
});
</script>

<template>
  <Layout>
    <Head title="Welcome" />
    <div class="py-6">
      <div class="grid gap-4">
        <Link
          :href="route('my-collection.play', video.hash)"
          class=""
          v-for="video in videos"
          :key="video.id"
        >
          {{ video.path }}</Link
        >
      </div>
    </div>
  </Layout>
</template>