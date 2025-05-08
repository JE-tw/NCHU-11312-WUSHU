<template>
  <div class="relative w-full min-w-[0]">
    <input
      :type="type"
      :id="id"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder || ' '"
      :class="[
        inputClass,
        'mt-4 block w-full appearance-none rounded-md border border-gray-300 px-3 pb-2 pt-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-0',
        disabled ? ' bg-slate-300 text-gray-500 cursor-not-allowed' : 'bg-white text-gray-900'
      ]"
      :disabled="disabled"
      :readonly="readonly"
    />
    <label
      :for="id"
      class="absolute left-3 top-[-8px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 placeholder-shown:text-gray-400 focus:text-sm focus:text-blue-600"
    >
      {{ label }}
    </label>
  </div>
</template>

<script setup>
defineProps({
  id: String,
  label: String,
  type: {
    type: String,
    default: 'text',
  },
  modelValue: String,
  placeholder: String,
  inputClass: {
    type: String,
    default: '',
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  readonly: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(['update:modelValue']);
</script>
