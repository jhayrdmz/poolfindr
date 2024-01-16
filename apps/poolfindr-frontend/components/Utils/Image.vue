<script setup lang="ts">
/**
 * imports
 */
import { UseImage } from "@vueuse/components";
import type { TImage } from "~/types";

/**
 * props
 */
const props = withDefaults(defineProps<TImage>(), {
  src: "",
  alt: "",
  errorImageSize: "w-5 h-5",
  errorTextStyle: "text-sm text-gray-400",
  spinnerSize: "w-5 h-5",
});
</script>

<template>
  <UseImage :src="props.src" class="object-cover w-full h-full">
    <template #loading>
      <div class="w-full h-full flex items-center justify-center bg-gray-100">
        <UtilsIcon
          :icon="Icons.Spin"
          class="text-gray-400 animate-spin"
          :class="props.spinnerSize"
        />
      </div>
    </template>
    <template #error>
      <div class="w-full h-full flex items-center justify-center bg-gray-100">
        <div>
          <UtilsIcon
            :icon="Icons.Image"
            class="text-gray-400 mx-auto"
            :class="props.errorImageSize"
          />
          <div class="text-center" :class="props.errorTextStyle">
            Image not found
          </div>
        </div>
      </div>
    </template>
  </UseImage>
</template>
