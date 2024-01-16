<script setup lang="ts">
/**
 * imports
 */
import { useRoute } from "vue-router";

/**
 * data
 */
const route = useRoute();
</script>

<template>
  <div id="layout-main-banner">
    <div v-if="route.meta.innerPage" class="w-full h-[500px] relative">
      <img
        src="/images/inner-banner.jpg"
        alt="Infinity Pool"
        class="object-cover w-full h-full object-center"
      />

      <h1
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[50px] font-bold uppercase text-center text-white"
      >
        {{ route.meta.title }}
      </h1>
    </div>
    <div v-else class="w-full h-[600px]">
      <img
        src="/images/banner.jpg"
        alt="Infinity Pool"
        class="object-cover w-full h-full"
      />
    </div>
  </div>
</template>
