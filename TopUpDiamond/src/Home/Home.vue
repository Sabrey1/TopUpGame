<template>
    <Header/>
    <div class="fix-container" style="padding-top: 60px;">
        <div class="mt-5">
            <Coursel/>
        </div>
        <div class="mt-8">

            <h2 class="text-center">Popular Game</h2>
            <Card :games="popularGames"/> 

            <h2 class="text-center">New Game</h2>
            <Card :games="newGames"/> 

            <h2 class="text-center">Game</h2>
            <Card :games="data"/>

        </div>
    </div>
    <Footer/>
</template>

<script setup>
import {ref,onMounted,computed} from 'vue'
import Header from '@/layouts/Header.vue'
import Coursel from '@/Home/components/Coursel.vue'
import Promotions from '@/Promotions/Promotions.vue'
import Card from '@/Home/components/Card.vue'
import Footer from '@/layouts/Footer.vue'
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

const popularGames = computed(() =>
  data.value.filter(game => game.is_popular === 1)
)

const newGames = computed(() =>
  data.value.filter(game => game.is_new === 1)
)
</script>