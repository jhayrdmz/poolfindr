<script setup lang="ts">
/**
 * props
 */
const props = defineProps<{
  label: string;
  color?: string;
}>();

/**
 * emits
 */
const emit = defineEmits<{
  (e: "click"): void;
}>();

/**
 * computed
 */
const buttonColor = computed<string>(() => {
  if (!props.color) {
    return "btn-common";
  }

  return `btn-${props.color}`;
});
</script>

<template>
  <div id="utils-button">
    <button
      type="button"
      :class="buttonColor"
      class="rounded-md py-2 px-3 border font-medium transition-all"
      v-bind="$attrs"
      @click="emit('click')"
    >
      {{ props.label }}
    </button>
  </div>
</template>
