<template>
  <select v-model="currentLang" @change="changeLang(currentLang)">
    <option value="en">English</option>
    <option value="kh">Khmer</option>
  </select>
</template>

<script setup>
import { ref } from 'vue';
import { getItem } from '@/services/storage-service';

const t = window.t;
const changeLang = window.changeLang;

// ✅ load saved language
const currentLang = ref(getItem('lang') || 'en');
</script>