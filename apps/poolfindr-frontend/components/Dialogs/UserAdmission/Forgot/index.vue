<script setup lang="ts">
/**
 * data
 */
const dialog = useDialog();
const form = reactive<TUserAdmission>({
  email: "",
});
</script>

<template>
  <div id="dialog-user-admission-forgot">
    <div class="space-y-1 text-center px-10">
      <h3 class="text-xl font-semibold leading-none">
        Oops! Forgot your password?
      </h3>
      <div class="text-sm">
        No worries! We're here with a big smile to help you bounce back and
        regain access in no time! 🌟
      </div>
    </div>

    <form class="px-10 pt-8 pb-0">
      <div class="space-y-5">
        <div>
          <FormsInput
            v-model="form.email"
            label="Email"
            placeholder="Enter your email"
          />
        </div>

        <div>
          <UtilsButton label="Reset Password" class="w-full" color="primary" />
        </div>

        <div class="text-center">
          Go to
          <span
            class="text-secondary cursor-pointer"
            @click="
              dialog.fnSetActiveDialog('user-admission', { type: 'login' })
            "
            >Login</span
          >
        </div>
      </div>
    </form>
  </div>
</template>
