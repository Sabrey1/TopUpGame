<template>
  <div >{{ currentTime }}</div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const currentTime = ref('')

function updateClock() {
  const now = new Date()

  let hours = now.getHours()
  const minutes = now.getMinutes().toString().padStart(2, '0')
  const seconds = now.getSeconds().toString().padStart(2, '0')
  const ampm = hours >= 12 ? 'PM' : 'AM'
  hours = hours % 12 || 12
  const formattedHours = hours.toString().padStart(2, '0')

  // currentTime.value = `${weekday}, ${day} ${month} ${year} ${formattedHours}:${minutes}:${seconds} ${ampm}`
  currentTime.value = `${formattedHours}:${minutes}:${seconds} ${ampm}`
}

let intervalId

onMounted(() => {
  updateClock()
  intervalId = setInterval(updateClock, 1000)
})

onUnmounted(() => {
  clearInterval(intervalId)
})
</script>

<style scoped>
div {
  font-family: monospace;
  font-size: 1.25rem;
}
</style>
