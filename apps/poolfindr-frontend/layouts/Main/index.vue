<script setup lang="ts">
/**
 * composables
 */
const dialog = useDialog();

/**
 * data
 */
const activeDialog = computed(() => {
  return dialog.activeDialog.value;
});
</script>

<template>
  <div id="layout-main">
    <LayoutsMainHeader />
    <!-- <LayoutsMainBanner /> -->
    <div class="pb-14">
      <NuxtPage />
    </div>
    <LayoutsMainFooter />
    <DialogsUserAdmission v-if="activeDialog === 'user-admission'" />
  </div>
</template>
