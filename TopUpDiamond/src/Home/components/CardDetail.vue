<template>
  <Header />
  <div class="fix-container" style="padding-top: 60px;">
    <div class="mt-5">
      <div class="mb-3">
        <Button @click="goback" label="Back" icon="pi pi-arrow-left"  class="border-round" severity="success"></Button>
      </div>
      <div class="grid">
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

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import ComToUpInput from '@/Home/components/ComToUpInput.vue'

const route = useRoute()
const games = ref([])

onMounted(()=>{
  app.getApi('game')
  .then(response => {
    games.value = response.data;
  })
  .catch(error => {
    console.error(error);
  });
})

const gameId = Number(route.params.id)
const game = computed(() => games.value.find(g => g.id === gameId) || {})

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
