<script setup lang="ts">
/**
 * data
 */
const dialog = useDialog();
const form = reactive<TUserAdmission>({
  email: "",
  password: "",
});
</script>

<template>
  <div id="dialog-user-admission-login">
    <div class="space-y-1 text-center px-10">
      <h3 class="text-xl font-semibold leading-none">
        Welcome back, fabulous!
      </h3>
      <div class="text-sm">
        We're absolutely thrilled to have you back in the groove with us once
        again! 🎉
      </div>
    </div>

    <form class="px-10 pt-8 pb-0">
      <div class="space-y-5">
        <div>
          <FormsInput
            v-model="form.email"
            label="Email address"
            placeholder="Enter your email address"
            :icon="Icons.Email"
          />
        </div>
        <div class="space-y-1">
          <div>
            <FormsInput
              v-model="form.password"
              type="password"
              label="Password"
              placeholder="Enter your password"
              :icon="Icons.Password"
            />
          </div>
          <div class="text-right text-sm text-accent">
            <span
              class="cursor-pointer"
              @click="
                dialog.fnSetActiveDialog('user-admission', { type: 'forgot' })
              "
              >Forgot Password?</span
            >
          </div>
        </div>
        <div>
          <UtilsButton label="Login" class="w-full" color="primary" />
        </div>
        <div class="text-center">
          Don't have an account?
          <span
            class="text-accent cursor-pointer"
            @click="
              dialog.fnSetActiveDialog('user-admission', { type: 'register' })
            "
            >Create one</span
          >
        </div>
      </div>
    </form>
  </div>
</template>
