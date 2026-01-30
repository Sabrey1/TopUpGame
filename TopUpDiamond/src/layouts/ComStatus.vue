<template>
  <Chip 
    v-if="displayLabel"
    :label="displayLabel" 
    :class="chipClass"
  />
</template>

<script setup>
import { defineProps, computed } from 'vue'

const props = defineProps({
  value: {
    type: [Boolean, Number, String],
    required: true
  },
  label: {   // optional display text override
    type: String,
    default: ''
  },
  trueLabel: {  // optional label for boolean true/1
    type: String,
    default: 'Yes'
  },
  falseLabel: { // optional label for boolean false/0
    type: String,
    default: 'No'
  }
})

// --- Display text inside the chip ---
const displayLabel = computed(() => {
  if(props.label) return props.label          // custom label passed
  if(props.value === 1 || props.value === true) return props.trueLabel
  if(props.value === 0 || props.value === false) return props.falseLabel
  return String(props.value)                  // for string statuses or numbers
})

// --- Background color based on value ---
const chipClass = computed(() => {
  // Map string statuses to colors
  const statusColors = {
    Paid: 'bg-green-600 text-white font-bold',
    Completed: 'bg-green-600 text-white font-bold',
    success: 'bg-green-600 text-white font-bold',
    Draft: 'bg-yellow-400 text-black font-bold',
    Pending: 'bg-yellow-400 text-black font-bold',
    pending: 'bg-yellow-400 text-black font-bold',
    Cancel: 'bg-red-500 text-white font-bold',
    Failed: 'bg-red-700 text-white font-bold',
    failed: 'bg-red-700 text-white font-bold',
  }

  // Boolean fallback
  if(props.value === 1 || props.value === true) return 'bg-green-600 text-white font-bold'
  if(props.value === 0 || props.value === false) return 'bg-red-500 text-white font-bold'

  // Use string mapping or fallback gray
  return statusColors[props.value] || 'bg-gray-300 text-black font-bold'
})
</script>
