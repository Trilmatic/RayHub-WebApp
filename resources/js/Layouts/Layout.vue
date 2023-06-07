<script setup>
import Sidebar from "@/Layouts/Sidebar.vue";
import Header from "@/Layouts/Header.vue";
</script>
<template>
  <div class="w-full h-full min-h-screen bg-slate-100 dark:bg-slate-900">
    <div class="flex max-w-[100vw]">
      <Sidebar />
      <div class="w-full my-4 mr-4 max-w-[calc(100vw-94px-1rem)]">
        <Header />
        <main>
          <slot></slot>
        </main>
      </div>
    </div>
  </div>
</template>