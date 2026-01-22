<template>
    <Header/>
    <div class="fix-container" style="padding-top: 60px;">
        <div class="mt-5">
            <Coursel/>
        </div>
        <div class="mt-3">
            <h2>Promotion</h2>
            <Promotions/>

            <h2 class="text-center">Top Game</h2>
            <Card/> 

            <h2 class="text-center">New Game</h2>
            <Card/> 

            <h2 class="text-center">Game</h2>
            <Card/> 
        </div>

    </div>
    <Footer/>
</template>

<script setup>
import Header from '@/layouts/Header.vue'
import Coursel from '@/Home/components/Coursel.vue'
import Promotions from '@/Promotions/Promotions.vue'
import Card from '@/Home/components/Card.vue'
import Footer from '@/layouts/Footer.vue'
</script>