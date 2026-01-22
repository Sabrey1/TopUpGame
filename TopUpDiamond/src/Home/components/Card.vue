<template>
  <div class="grid">
    <div class="col-12 md:col-6 lg:col-2  m-0" v-for="datas in data" :key="datas.id">
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
    </div>
  </div>
</template>


<script setup>
import { ref } from 'vue';
import Card from 'primevue/card';

const data = ref([
  { id: 1, image: "https://i.pinimg.com/474x/d9/a1/69/d9a169b14075e076a38698a0fd1e0b7e.jpg", name: "Mobile Legends: Bang Bang" },
  { id: 2, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles-plain/Honor-of-Kings-Tile.png", name: "Honor of Kings" },
  { id: 3, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles/pubgm_tile_aug2024.jpg" , name: "PubG Mobile" },
  { id: 4, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles/garena_shells_tile.jpg", name: "Garena Shells" },
  { id: 5, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles/zepeto_tile.png", name: "Zepeto" },
  { id: 6, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles/EA_FC_Oct_2025.png", name: "EA FC" },
]);
</script>
<style scoped>
    .p-card-body{
        padding: 0;
        margin: 0;
    }
</style>
