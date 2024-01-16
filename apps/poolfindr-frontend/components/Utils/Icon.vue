<script setup lang="ts">
/**
 * props
 */
interface Props {
  icon: string;
  class?: string;
}

const props = withDefaults(defineProps<Props>(), {
  icon: "",
  class: "h-4 w-4 text-inherit",
});
</script>

<template>
  <div id="utils-icon">
    <svg :class="props.class">
      <use :href="`/icons.svg#${props.icon.toLowerCase()}`" />
    </svg>
  </div>
</template>
