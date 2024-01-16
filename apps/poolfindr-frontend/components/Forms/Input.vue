<script setup lang="ts">
/**
 * props
 */
interface Props {
  modelValue?: string | number;
  type?: string;
  icon?: string;
  iconClass?: string;
  iconPosition?: string;
  placeholder?: string;
  label?: string;
}

const props = withDefaults(defineProps<Props>(), {
  type: "text",
  iconClass: "w-5 h-5 text-gray-400",
  iconPosition: "left",
});

/**
 * data
 */
const showPassword = ref<boolean>(false);
</script>

<template>
  <div id="forms-input">
    <label v-if="props.label" class="mb-[2px] block">{{ props.label }}</label>
    <div class="relative">
      <template v-if="type === 'password'">
        <input
          :value="props.modelValue"
          :type="showPassword ? 'text' : 'password'"
          class="border border-gray-200 rounded-md focus:border-primary focus:ring-0 outline-none py-2 px-3 font-normal w-full transition-all"
          :class="
            props.icon && props.iconPosition === 'left' ? 'pl-10' : 'pr-10'
          "
          :placeholder="props.placeholder"
          autocomplete="off"
          @input="$emit('update:modelValue', ($event.target as any)?.value)"
        />
      </template>
      <template v-else>
        <input
          :value="props.modelValue"
          :type="props.type"
          class="border border-gray-200 rounded-md focus:border-primary focus:ring-0 outline-none py-2 px-3 font-normal w-full transition-all"
          :class="
            props.icon && props.iconPosition === 'left' ? 'pl-10' : 'pr-10'
          "
          :placeholder="props.placeholder"
          autocomplete="off"
          @input="$emit('update:modelValue', ($event.target as any)?.value)"
        />
      </template>
      <span
        class="absolute top-1/2 -translate-y-1/2"
        :class="[props.iconPosition === 'left' ? 'left-3' : 'right-3']"
      >
        <UtilsIcon :icon="props.icon" :class="props.iconClass" />
      </span>

      <span
        v-if="type === 'password'"
        class="absolute top-1/2 -translate-y-1/2 right-3 cursor-pointer"
        @click="showPassword = !showPassword"
      >
        <UtilsIcon
          v-if="showPassword"
          :icon="Icons.Eye"
          class="w-5 h-5 text-gray-400"
        />
        <UtilsIcon v-else :icon="Icons.EyeOff" class="w-5 h-5 text-gray-400" />
      </span>
    </div>
  </div>
</template>
