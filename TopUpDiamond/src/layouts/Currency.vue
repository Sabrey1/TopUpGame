<template>
  <span>{{ formatted }}</span>
</template>

<script setup>
import { computed, defineProps } from 'vue'

const props = defineProps({
  value: { type: [Number, String], required: true },
  locale: { type: String, default: 'en-US' },
  decimal: { type: Number, default: 2 }
})

const formatted = computed(() => {
  const number = Number(props.value) || 0
  return `$ ${number.toLocaleString(props.locale, {
    minimumFractionDigits: props.decimal,
    maximumFractionDigits: props.decimal
  })}`
})
</script>

<style scoped>
span {
  font-weight: 500;
  color: #111;
}
</style>
