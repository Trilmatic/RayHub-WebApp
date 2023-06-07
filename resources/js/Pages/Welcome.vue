<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import CardsSection from "@/Components/CardsSection.vue";
import axios from "axios";
import { ref } from "vue";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});

const nowPlaying = ref([]);

axios({
  method: "get",
  url: "https://api.themoviedb.org/3/movie/now_playing?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb",
}).then(function (response) {
  nowPlaying.value = response.data.results;
  console.log(nowPlaying.value);
});
</script>

<template>
  <Layout>
    <Head title="Welcome" />
    <div class="py-6">
      <CardsSection title="Now in cinema" :list="nowPlaying " />
    </div>
  </Layout>
</template>