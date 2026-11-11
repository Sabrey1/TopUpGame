<template>
  <Loading v-if="loading" />
  <template v-else>
  <Header />
  <div class="fix-container" style="padding-top: 60px;">
    <div class="mt-5">
      <div class="mb-3">
        <Button @click="goback" label="Back" icon="pi pi-arrow-left"  class="border-round" severity="success"></Button>
      </div>
      <div v-if="error" class="text-center mt-5" role="alert">
        <p>Could not load the game. Please try again.</p>
        <Button label="Try again" @click="getGame" />
      </div>
      <p v-else-if="!game" class="text-center mt-5">Game not found.</p>
      <div v-else class="grid">
        <div class="col-12 lg:col-4">
          <div class="flex flex-row gap-2 sm:gap-3">
            <div class="game-image shrink-0">
              <img :src="game.image" class="object-cover block w-full h-full border-round" alt="" />
            </div>
            <div class="min-w-0">
              <p class="game-name m-0 mb-2">{{ game.name }}</p>
              <Chip label="ទូទាត់ដោយសុវត្ថិភាព" icon="pi pi-apple"></Chip>
            </div>
          </div>
          <div>
            <p class="mt-3">{{ game.descrption }}</p>
          </div>
        </div>
        <div class="col-12 lg:col-8">
          <div>
            <ComToUpInput/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Footer/>
  </template>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useRoute } from 'vue-router'
import ComToUpInput from '@/Home/components/ComToUpInput.vue'
import Loading from '@/Home/components/Loading.vue'

const route = useRoute()
const games = ref([])
const loading = ref(true)
const error = ref(false)
let requestId = 0

async function getGame() {
  const currentRequest = ++requestId
  loading.value = true
  error.value = false
  try {
    const response = await app.getApi('game')
    if (currentRequest === requestId) games.value = response.data || []
  } catch (err) {
    if (currentRequest === requestId) {
      console.error('Error fetching game:', err)
      error.value = true
    }
  } finally {
    if (currentRequest === requestId) loading.value = false
  }
}

watch(() => route.params.id, getGame, { immediate: true })
const game = computed(() => games.value.find(g => g.id === Number(route.params.id)))

function goback(){
  window.history.back();
}
</script>

<style scoped>
.game-image {
  width: 6rem;
  aspect-ratio: 1 / 1;
}

.game-name {
  overflow-wrap: anywhere;
}

@media (min-width: 576px) {
  .game-image {
    width: 7rem;
  }
}

@media (max-width: 767px) {
  .game-name {
    font-size: 1.05rem;
    font-weight: 600;
  }

  :deep(.p-chip) {
    max-width: 100%;
    height: auto;
    padding: 0.3rem 0.5rem;
    font-size: 0.72rem;
  }

  :deep(.p-chip-icon) {
    font-size: 0.8rem;
  }

  :deep(.p-chip-label) {
    white-space: normal;
  }
}
</style>
