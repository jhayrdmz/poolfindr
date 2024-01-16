<script setup lang="ts">
/**
 * composables
 */
const dialog = useDialog();

/**
 * computed
 */
const dialogData = computed(() => dialog.dialogData.value);
</script>

<template>
  <Teleport to="body">
    <div
      id="dialog-user-admission"
      class="fixed top-0 left-0 z-[9999] w-full h-full flex items-center justify-center"
    >
      <div
        class="bg-black/70 absolute top-0 left-0 w-full h-full z-0"
        @click="dialog.fnSetActiveDialog('')"
      ></div>

      <div
        class="bg-white px-5 pb-8 pt-2 relative z-10 w-full max-w-[650px] rounded-md shadow-md"
      >
        <div class="relative pt-1">
          <div class="w-[200px] mx-auto">
            <img src="/images/logo.png" alt="Poolfindr" />
          </div>

          <div class="absolute top-2 right-0">
            <UtilsIcon
              :icon="Icons.Close"
              class="h-6 w-6 cursor-pointer text-primary"
              @click="dialog.fnSetActiveDialog('')"
            />
          </div>
        </div>
        <DialogsUserAdmissionLogin v-if="dialogData.type === 'login'" />
        <DialogsUserAdmissionRegister v-if="dialogData.type === 'register'" />
        <DialogsUserAdmissionForgot v-if="dialogData.type === 'forgot'" />
      </div>
    </div>
  </Teleport>
</template>
