<!-- <template>
  <div class="grid">
    <div class="col-12 md:col-6 lg:col-2  m-0" v-for="datas in data" :key="datas.id">
        <RouterLink :to="`/game/${datas.id}`">
            <Card class="m-0 p-0 overflow-hidden h-full">
                <template #header>
                    <div class="w-full h-12rem overflow-hidden">
                        <img :src="datas.image" class="object-cover block w-full h-full " alt="">
                    </div>
                    
                </template>
                <template #content>
                    <div class="n-0 p-0">
                        <p class="text-center m-0 p-0 font-bold">{{ datas.name }}</p>
                    </div>
                </template>
            </Card>
        </RouterLink>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted  } from 'vue';
import axios from 'axios'

const data = ref([])

async function getData(){
    const res = await axios.get('http://127.0.0.1:8000/api/game')
    if(res.data){
        data.value = res.data
    }
}

onMounted(()=>{
getData()
})

const props = defineProps({
    games: {
        type: Array,
        required: true
    }
})

</script>
<style scoped>
    .p-card-body{
        padding: 0;
        margin: 0;
    }
</style> -->

<template>
  <div class="grid">
    <div
      class="col-12 md:col-6 lg:col-2 m-0"
      v-for="game in games"
      :key="game.id"
    >
      <RouterLink :to="`/game/${game.id}`">
        <Card class="m-0 p-0 overflow-hidden h-full">
          <template #header>
            <div class="w-full h-12rem overflow-hidden relative">
              <img
                :src="game.image"
                class="object-cover w-full h-full"
                alt="game image"
              />
              <!-- Optional badges -->
              <span
                v-if="game.is_new"
                class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded"
              >
                NEW
              </span>
              <span
                v-if="game.is_popular"
                class="absolute top-2 right-2 bg-yellow-400 text-black text-xs px-2 py-1 rounded"
              >
                POPULAR
              </span>
            </div>
          </template>

          <template #content>
            <p class="text-center font-bold m-0 p-2">{{ game.name }}</p>
          </template>
        </Card>
      </RouterLink>
    </div>
  </div>
</template>

<script setup>
defineProps({
  games: {
    type: Array,
    required: true
  }
})
</script>

<style scoped>
.p-card-body {
  padding: 0;
  margin: 0;
}
</style>
