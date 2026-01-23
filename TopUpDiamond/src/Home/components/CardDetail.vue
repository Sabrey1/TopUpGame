<template>
  <Header />
  <div class="fix-container" style="padding-top: 60px;">
    <div class="mt-5">
      <div class="grid">
        <div class="col-4">
          <div class="flex gap-4">
            <div class="w-7rem">
              <img :src="game.image" class="object-cover block w-full h-full border-round" alt="" />
            </div>
            <div>
              <p>{{ game.name }}</p>
              <Chip label="ទូទាត់ដោយសុវត្ថិភាព" icon="pi pi-apple"></Chip>
            </div>
          </div>
          <div>
            <p>{{ game.descrption }}</p>
          </div>
        </div>
        <div class="col-8">
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
import axios from 'axios'

const route = useRoute()

const games = ref([])

onMounted(()=>{
    axios.get('http://127.0.0.1:8000/api/game')
      .then(response => {
        games.value = response.data;
      })
      .catch(error => {
        console.error(error);
      });
})

const gameId = Number(route.params.id)

const game = computed(() => games.value.find(g => g.id === gameId) || {})

</script>

<style scoped>
.w-7rem {
  width: 7rem;
}
</style>
