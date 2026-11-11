<template>
    <Loading v-if="loading" />
    <template v-else>
    <Header/>
    <div class="fix-container" style="padding-top: 60px;">
        <div class="mt-5">
            <Coursel :slides="slides"/>
        </div>
        <div v-if="error" class="mt-7 text-center" role="alert">
            <p>Could not load games. Please try again.</p>
            <Button label="Try again" @click="getData" />
        </div>
        <div v-else class="mt-7">
            <h2 class="text-center">{{ t("Popular Game") }}</h2>
            <Card :games="popularGames"/> 

            <h2 class="text-center">{{ t("New Game") }}</h2>
            <Card :games="newGames"/> 

            <h2 class="text-center">{{t("Game")}}</h2>
            <Card :games="data"/>
        </div>
    </div>
    <Footer/>
    </template>
</template>

<script setup>
import {ref,onMounted,computed} from 'vue'
import Header from '@/layouts/Header.vue'
import Coursel from '@/Home/components/Coursel.vue'
import Card from '@/Home/components/Card.vue'
import Loading from '@/Home/components/Loading.vue'
import Footer from '@/layouts/Footer.vue'

const t = window.t
const data = ref([])
const slides = ref([])
const loading = ref(true)
const error = ref(false)

async function getData(){
    loading.value = true
    error.value = false
    try {
        const [gamesResult, slidesResult] = await Promise.allSettled([
            app.getApi('game'),
            app.getApi('panel_coursel')
        ])
        if (slidesResult.status === 'fulfilled') {
            slides.value = slidesResult.value.data || []
        } else {
            console.error('Error fetching slides:', slidesResult.reason)
        }
        if (gamesResult.status === 'rejected') throw gamesResult.reason
        data.value = gamesResult.value.data || []
    } catch (err) {
        console.error('Error fetching games:', err)
        error.value = true
    } finally {
        loading.value = false
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
