<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import CardsSection from "@/Components/CardsSection.vue";
import axios from "axios";
import { computed, onMounted, reactive, ref } from "vue";

const props = defineProps({
  folders: Array,
});

const form = reactive({
  folder: "",
  folderType: "movies",
});

const submit = () => {
  router.post("/my-collection/scan", form);
};

onMounted(() => {
  console.log(props.folders);
});
</script>

<template>
  <Layout>
    <Head title="Welcome" />
    <div class="py-6">
      <div class="flex justify-center">
        <div class="w-full h-full max-w-xl">
          <h2 class="text-2xl font-bold text-center">
            Setup collection sources
          </h2>
          <div class="flex justify-center space-x-4 py-4">
            <div class="card">
              <h3 class="font-bold">Local network</h3>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-affiliate"
                width="50"
                height="50"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path
                  d="M5.931 6.936l1.275 4.249m5.607 5.609l4.251 1.275"
                ></path>
                <path d="M11.683 12.317l5.759 -5.759"></path>
                <path
                  d="M5.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0"
                ></path>
                <path
                  d="M18.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0"
                ></path>
                <path
                  d="M18.5 18.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0"
                ></path>
                <path
                  d="M8.5 15.5m-4.5 0a4.5 4.5 0 1 0 9 0a4.5 4.5 0 1 0 -9 0"
                ></path>
              </svg>
            </div>
            <div class="card">
              <h3 class="font-bold">Online</h3>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-access-point"
                width="50"
                height="50"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12l0 .01"></path>
                <path d="M14.828 9.172a4 4 0 0 1 0 5.656"></path>
                <path d="M17.657 6.343a8 8 0 0 1 0 11.314"></path>
                <path d="M9.168 14.828a4 4 0 0 1 0 -5.656"></path>
                <path d="M6.337 17.657a8 8 0 0 1 0 -11.314"></path>
              </svg>
            </div>
          </div>
          <form class="card" @submit.prevent="submit">
            <h3 class="mb-2 font-semibold text-gray-900 dark:text-white">
              Folder URL
            </h3>
            <input
              class="form-input mb-4"
              type="text"
              placeholder="Folder URL"
              v-model="form.folder"
            />
            <h3 class="mb-2 font-semibold text-gray-900 dark:text-white">
              Folder content
            </h3>
            <div class="flex flex-wrap">
              <div class="flex items-center mr-4">
                <input
                  id="folder-type-movies"
                  type="radio"
                  checked
                  value="movies"
                  name="folder-type"
                  v-model="form.folderType"
                  class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                />
                <label
                  for="folder-type-movies"
                  class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                  >Movies</label
                >
              </div>
              <div class="flex items-center mr-4">
                <input
                  id="folder-type-tv"
                  type="radio"
                  value="tv"
                  name="folder-type"
                  v-model="form.folderType"
                  class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                />
                <label
                  for="folder-type-tv"
                  class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                  >TV Shows</label
                >
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-scan-eye"
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
                <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                <path d="M7 12c3.333 -4.667 6.667 -4.667 10 0"></path>
                <path d="M7 12c3.333 4.667 6.667 4.667 10 0"></path>
                <path d="M12 12h-.01"></path></svg
              ><span class="ml-1">Scan</span>
            </button>
          </form>
        </div>
      </div>

      <video width="320" height="240" controls>
        <source src="/play" />
      </video>

    </div>
  </Layout>
</template>