<script setup lang="ts">
/**
 * data
 */
const dialog = useDialog();
const role = ref<string>("user");
const form = reactive<TUserAdmission>({
  first_name: "",
  last_name: "",
});
</script>

<template>
  <div id="dialog-user-admission-register">
    <div class="space-y-1 text-center px-10">
      <h3 class="text-xl font-semibold leading-none">
        Welcome aboard, adventure seeker!
      </h3>
      <div class="text-sm">
        We're overjoyed to have you join us on this exciting journey of endless
        possibilities! 🚀
      </div>
    </div>

    <form class="px-10 pt-8 pb-0">
      <div class="space-y-5">
        <div class="grid grid-cols-2 gap-3">
          <div>
            <UtilsButton
              label="User"
              class="w-full"
              :color="role === 'user' ? 'primary' : ''"
              @click="role = 'user'"
            />
          </div>
          <div>
            <UtilsButton
              label="Host"
              class="w-full"
              :color="role === 'host' ? 'primary' : ''"
              @click="role = 'host'"
            />
          </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div>
            <FormsInput
              v-model="form.first_name"
              label="First name"
              placeholder="Enter your first name"
            />
          </div>
          <div>
            <FormsInput
              v-model="form.last_name"
              label="Last name"
              placeholder="Enter your last name"
            />
          </div>
        </div>
        <div>
          <FormsInput
            v-model="form.email"
            label="Email"
            placeholder="Enter your email"
          />
        </div>
        <div>
          <FormsInput
            v-model="form.password"
            label="Password"
            placeholder="Enter your password"
            is-password
          />
        </div>
        <div>
          <FormsInput
            v-model="form.password_confirmation"
            label="Confirm password"
            placeholder="Enter your password"
            is-password
          />
        </div>

        <div>
          <UtilsButton label="Register" class="w-full" color="primary" />
        </div>

        <div class="text-center">
          Already have an account?
          <span
            class="text-accent cursor-pointer"
            @click="
              dialog.fnSetActiveDialog('user-admission', { type: 'login' })
            "
            >Login here</span
          >
        </div>
      </div>
    </form>
  </div>
</template>
