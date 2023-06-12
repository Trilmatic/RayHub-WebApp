<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import CardsSection from "@/Components/CardsSection.vue";
import axios from "axios";
import { onMounted, ref } from "vue";

defineProps({
  movie_genres: Array,
  movies: Array,
});
</script>

<template>
  <Layout>
    <Head title="Welcome" />
    <div class="py-6">
      <div class="grid"></div>
    </div>
  </Layout>
</template>