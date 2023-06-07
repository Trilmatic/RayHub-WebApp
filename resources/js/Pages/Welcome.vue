<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import CardsSection from "@/Components/CardsSection.vue";
import axios from "axios";
import { ref } from "vue";

defineProps({
  movie_genres: Array,
});

const nowPlaying = ref([]);
/*
axios({
  method: "get",
  url: "https://api.themoviedb.org/3/movie/now_playing?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb",
}).then(function (response) {
  nowPlaying.value = response.data.results;
  console.log(nowPlaying.value);
});*/

axios({
  method: "get",
  url: "https://api.themoviedb.org/3/genre/movie/list?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb",
}).then(function (response) {
  console.log(response.data);
});
</script>

<template>
  <Layout>
    <Head title="Welcome" />
    {{ movie_genres }}
    <div class="py-6">
      <CardsSection title="Now in theatres" :list="nowPlaying" />
    </div>
  </Layout>
</template>