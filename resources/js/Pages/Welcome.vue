<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import CardsSection from "@/Components/CardsSection.vue";
import axios from "axios";
import { ref } from "vue";

defineProps({
  movie_genres: Array,
  movies: Array,
});

const nowPlaying = ref([]);
</script>

<template>
  <Layout>
    <Head title="Welcome" />
    <div class="py-6">
      <CardsSection title="Now in theatres" :list="movies" />
    </div>
  </Layout>
</template>