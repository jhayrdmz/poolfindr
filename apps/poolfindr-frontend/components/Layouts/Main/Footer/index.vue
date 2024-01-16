<script setup lang="ts">
/**
 * imports
 */
import { useDateFormat, useNow } from "@vueuse/core";

/**
 * data
 */
const dialog = useDialog();
const date = useDateFormat(useNow(), "YYYY");
</script>

<template>
  <div
    id="layout-main-footer"
    class="bg-accent py-2 text-white fixed bottom-0 left-0 w-full"
  >
    <div class="max-w-7xl mx-auto py-2">
      <div class="flex items-center justify-between">
        <div class="text-sm">Poolfindr &copy; {{ date }}</div>
        <div class="flex items-center space-x-5 text-sm">
          <div
            class="cursor-pointer transition-all"
            @click="
              dialog.fnSetActiveDialog('user-admission', { type: 'forgot' })
            "
          >
            Forgot Password
          </div>
          <NuxtLink
            v-for="(link, index) in FOOTER_NAVIGATION"
            :key="index"
            :to="link.path"
            class="hover:border-b-secondary transition-all"
            >{{ link.name }}</NuxtLink
          >
        </div>
      </div>
    </div>
  </div>
</template>
