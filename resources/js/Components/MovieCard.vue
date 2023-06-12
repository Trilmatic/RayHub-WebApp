<script setup>
import { ref } from "vue";

const props = defineProps({
  item: Object,
});
</script>
<template>
  <div
    class="movie-card"
    :id="'card-item-' + item.id"
    @mouseover="areaFocused = true"
    @mouseout="areaFocused = false"
  >
    <img
      v-show="item.poster_path"
      class="w-full h-full rounded-xl"
      :src="'http://image.tmdb.org/t/p/w300/' + item.poster_path"
    />
    <div
      v-show="!item.poster_path"
      class="rounded-b-xl w-full absolute bottom-0 left-0 p-2 h-auto"
    >
      <h4 class="text-lg text-center mb-2 font-bold">{{ item.title }}</h4>
    </div>
  </div>
</template>