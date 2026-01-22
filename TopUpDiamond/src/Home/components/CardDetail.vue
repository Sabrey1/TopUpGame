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
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import ComToUpInput from '@/Home/components/ComToUpInput.vue'

const route = useRoute()

const games = ref([
  { id: 1, image: "https://i.pinimg.com/474x/d9/a1/69/d9a169b14075e076a38698a0fd1e0b7e.jpg", name: "Mobile Legends: Bang Bang", descrption:"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse, cupiditate nequequas" },
  { id: 2, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles-plain/Honor-of-Kings-Tile.png", name: "Honor of Kings" , descrption:"Lorem ipsum dolor sit amet..." },
  { id: 3, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles/pubgm_tile_aug2024.jpg" , name: "PubG Mobile", descrption:"Lorem ipsum dolor sit amet..." },
  { id: 4, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles/garena_shells_tile.jpg", name: "Garena Shells" , descrption:"Lorem ipsum dolor sit amet..." },
  { id: 5, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles/zepeto_tile.png", name: "Zepeto", descrption:"Lorem ipsum dolor sit amet..." },
  { id: 6, image:"https://cdn1.codashop.com/S/content/mobile/images/product-tiles/EA_FC_Oct_2025.png", name: "EA FC" , descrption:"Lorem ipsum dolor sit amet..."}
]);

const gameId = Number(route.params.id)

const game = computed(() => games.value.find(g => g.id === gameId) || {})

</script>

<style scoped>
.w-7rem {
  width: 7rem;
}
</style>
