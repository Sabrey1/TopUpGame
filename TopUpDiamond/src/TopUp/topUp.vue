<template>
    <div>
        <Card  class="mt-3 ">
        <template #title>Select Recharge</template>
        <template #content>
            <p class="m-0">Our best sellers for you</p>
                <div class="grid">
                    <div v-for="pkg in BestSellers" :key="pkg.id"  class="col-6 md:col-6 lg:col-2 w-12rem" >
                        <Card class="mt-3 border-1 border-gray-400 w-full selectable no-padding-card"
                            :class="{ selected: selectedPackageId === pkg.id }" @click="selectPackage(pkg)">
                            <template #title>
                                <div class="p-2">
                                    <p class="text-center m-0 title">{{ pkg.amount }} {{ pkg.Unit }}</p>
                                    <div class="flex justify-content-center align-items-center">
                                        <img
                                            :src="pkg.image"
                                            class="object-cover block w-4rem"
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </template>
                            <template #content>
                                <div class="bg-gray-100 p-2 border-round-bottom-xl">
                                    <p class="m-0 title text-right">From</p>
                                    <p class="m-0 text-sm text-right">${{ pkg.price }}</p>
                                    <div class="flex gap-2 align-items-center justify-content-end">
                                        <Chip class="bg-green-200 text-right title m-0" v-if="pkg.discount">{{pkg.discount}}</Chip>
                                        <p class="m-0"><s>${{ pkg.fullprice }}</s></p>
                                    </div>
                                </div>
                            </template>
                        </Card>
                    </div>
                </div>
            <p>Browse all items</p>
            <div class="flex gap-4">
                <Card>
                    <template #content>
                        <div class="flex gap-2 align-items-center">
                            <img src="https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_Mobile Legends_category/1735899441907_5000orMore_MLBB_Diamonds.png" class="w-2rem" alt="">
                            <p>Diamonds</p>
                        </div>
                    </template>
                </Card>
                <Card>
                    <template #content>
                        <div class="flex gap-2 align-items-center">
                            <img src="https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_f66aebb8ede7c159b2dfc46c2cd00201_category/1741854799644_dcbce7aa-7d85-4e79-ad45-6aed78fcda56.png" class="w-2rem" alt="">
                            <p>Weekly Diamond Pass</p>
                        </div>
                    </template>
                </Card>
            </div>

            <div>
                <p>Diamonds</p>
                <div class="grid">
                    <div v-for="pkg in gamePackages" :key="pkg.id"  class="col-6 md:col-6 lg:col-2 w-12rem" >
                        <Card class="mt-3 border-1 border-gray-400 w-full selectable no-padding-card"
                            :class="{ selected: selectedPackageId === pkg.id }" @click="selectPackage(pkg)">
                            <template #title>
                                <div class="p-2">
                                    <p class="text-center m-0 title">{{ pkg.amount }} {{ pkg.Unit }}</p>
                                    <div class="flex justify-content-center align-items-center">
                                        <img
                                            :src="pkg.image"
                                            class="object-cover block w-4rem"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                
                            </template>
                            <template #content>
                                <div class="bg-gray-100 p-2 border-round-bottom-xl">
                                    <p class="m-0 title text-right">From</p>
                                    <p class="m-0 text-sm text-right">${{ pkg.price }}</p>
                                    <div class="flex gap-2 align-items-center justify-content-end">
                                        <Chip class="bg-green-200 text-right title m-0" v-if="pkg.discount">{{pkg.discount}}</Chip>
                                        <p class="m-0"><s>${{ pkg.fullprice }}</s></p>
                                    </div>
                                </div>
                            </template>
                        </Card>
                    </div>
                </div>
            </div>
            <!-- <div>
                <p>Weekly Diamond Pass</p>
                <Card>
                    <template #content>
                        <div class="flex gap-3 align-items-center">
                            <div>
                                <img class="w-2rem" src="https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_f66aebb8ede7c159b2dfc46c2cd00201_category/1741854799644_dcbce7aa-7d85-4e79-ad45-6aed78fcda56.png" alt="">
                            </div>
                            <div>
                                <p class="m-0 title">Weekly Diamond Pass</p>
                                <ol class="pl-3 title" style="margin-top: 0px;">
                                    <li>Please make sure to purchase the Pass once LV 5 is reached.</li>
                                    <li>You cannot purchase an additional Weekly Diamond Pass if your remaining duration is 70 days or more.</li>
                                </ol>
                            </div>
                        </div>
                    </template>
                </Card>
                <div class="grid">
                    <div v-for="Weeklypasses in Weeklypass" :key="Weeklypasses.id"  class="col-6 md:col-6 lg:col-2 w-12rem" >
                        <Card class="mt-3 border-1  border-gray-400 w-full">
                            <template #title>
                                <p class="text-center text-sm m-0">{{ Weeklypasses.name }}</p>
                                <p class="text-center m-0 title">{{ Weeklypasses.daimond }}</p>
                                <div class="flex justify-content-center align-items-center">
                                    <img
                                        :src="Weeklypasses.image"
                                        class="object-cover block w-4rem"
                                        alt=""
                                    />
                                </div>
                            </template>
                            <template #content>
                                <div class="">
                                    <p class="m-0 title text-right">From</p>
                                    <p class="m-0 text-sm text-right">{{ Weeklypasses.price }}</p>
                                    <div class="flex gap-2 align-items-center justify-content-end">
                                        <Chip class="bg-green-200 text-right  title m-0" >{{Weeklypasses.discount}}</Chip>
                                        <p class="m-0"><s>{{ Weeklypasses.fullprice }}</s></p>
                                    </div>
                                </div>
                            </template>
                        </Card>
                    </div>
                </div>
            </div> -->
            
        </template>
    </Card>
    </div>
</template>

<script setup>
import {ref, onMounted,watch } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router';

const route = useRoute();
const gameId = ref(route.params.id); 

const gamePackages = ref([]);
const BestSellers = ref([]);
const gameName = ref('');

const emit = defineEmits(['package-selected'])

const selectedPackageId = ref(null)



const selectPackage = (pkg) => {
  selectedPackageId.value = pkg.id
   emit('package-selected', pkg) 
}

async function getPackagesByGame(id) {
  try {
    const res = await axios.get('http://127.0.0.1:8000/api/topupPackage');
    if (res.data) {
      
      const packages = res.data.filter(pkg => pkg.game_id == id);
      BestSellers.value = packages.filter(pkg => pkg.best_seller == 1);
      gamePackages.value = packages.filter(pkg => pkg.best_seller == 0);

      if (packages.length > 0) {
        gameName.value = packages[0].name.includes("ML") ? "Mobile Legends" : `Game ${id}`;
      } else {
        gameName.value = `Game ${id}`;
      }
    }
  } catch (error) {
    console.error("Error fetching packages:", error);
  }
}

onMounted(() => getPackagesByGame(gameId.value));

watch(() => route.params.id, (newId) => {
  gameId.value = newId;
  selectedPackageId.value = null;
  getPackagesByGame(newId);
});

const Weeklypass = ref([
    {id:1, name:"Weekly Diamond Pass",  discount:"-23%", price:"US$1.93", fullprice:"US$2.49", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_f66aebb8ede7c159b2dfc46c2cd00201_category/1741854799644_dcbce7aa-7d85-4e79-ad45-6aed78fcda56.png'},
])

</script>

<style scoped>
.title{
    font-size: 13px;
}

.selectable {
  cursor: pointer;
}

.selectable:hover {
  border-color: #22c55e;
}

.selected {
  border: 2px solid #22c55e !important;
  background-color: #f0fdf4;
}
</style>