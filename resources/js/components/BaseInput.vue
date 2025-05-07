<template>
    <div class="relative w-full">
      <input
        :type="type"
        :id="id"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder || ' '"
        :class="inputClass"
        class="peer mt-4 block w-full appearance-none rounded-md border border-gray-300 bg-transparent px-3 pb-2 pt-4 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
      />
      <label
        :for="id"
        class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
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
  })
  
  const emit = defineEmits(['update:modelValue'])
  </script>
  