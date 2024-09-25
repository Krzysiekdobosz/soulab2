<template>
  <div class="mb-4">
    <label :for="name" class="block text-gray-700 text-sm font-bold mb-2">{{ label }}</label>
    <input
      v-if="type !== 'textarea'"
      :id="name"
      :name="name"
      :type="type"
      v-model="inputValue"
      :class="inputClasses"
    />
    <textarea
      v-else
      :id="name"
      :name="name"
      v-model="inputValue"
      :class="textareaClasses"
    ></textarea>
    <p v-if="error" class="text-red-500 text-xs italic mt-2">{{ error }}</p>
  </div>
</template>

<script>
export default {
  name: 'FormInput',
  props: {
    label: String,
    name: String,
    type: {
      type: String,
      default: 'text',
    },
    modelValue: [String, Number],
    error: String,
  },
  computed: {
    inputValue: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value);
      },
    },
    inputClasses() {
      return [
        'shadow',
        'appearance-none',
        'border',
        this.error ? 'border-red-500' : 'border-gray-300',
        'rounded',
        'w-full',
        'py-2',
        'px-3',
        'text-gray-700',
        'leading-tight',
        'focus:outline-none',
        'focus:shadow-outline',
      ];
    },
    textareaClasses() {
      return [
        'shadow',
        'appearance-none',
        'border',
        this.error ? 'border-red-500' : 'border-gray-300',
        'rounded',
        'w-full',
        'py-2',
        'px-3',
        'text-gray-700',
        'leading-tight',
        'focus:outline-none',
        'focus:shadow-outline',
        'h-32',
        'resize-none',
      ];
    },
  },
};
</script>

<style scoped>
</style>
