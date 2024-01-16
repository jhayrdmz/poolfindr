<script setup lang="ts">
/**
 * composables
 */
const dialog = useDialog();
</script>

<template>
  <div id="layout-main-header" class="bg-white border-b sticky top-0 z-50">
    <div class="bg-primary text-white text-sm uppercase">
      <div class="max-w-7xl mx-auto py-1"></div>
    </div>
    <div class="max-w-7xl mx-auto">
      <div class="flex items-center justify-between">
        <NuxtLink :to="Routes.Home" class="max-w-[200px] cursor-pointer">
          <img src="/images/logo.png" alt="Poolfindr" />
        </NuxtLink>

        <div class="flex-1 px-16">
          <FormsInput
            :icon="Icons.Search"
            placeholder="Search destinations"
            icon-position="right"
          />
        </div>

        <div class="flex items-center divide divide-x space-x-3">
          <div>
            <UtilsButton
              label="Login"
              color="primary"
              class="min-w-[90px]"
              @click="
                dialog.fnSetActiveDialog('user-admission', { type: 'login' })
              "
            />
          </div>
          <div class="pl-3">
            <UtilsButton
              label="Register"
              class="min-w-[90px]"
              @click="
                dialog.fnSetActiveDialog('user-admission', { type: 'register' })
              "
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
