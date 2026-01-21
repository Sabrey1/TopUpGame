<script setup>
import { useI18n } from 'vue-i18n'
import { setItem } from '@/services/storage-service'

const { locale } = useI18n()

function changeLang(lang) {
  locale.value = lang
  setItem("lang", lang)
}
</script>

<template>
  <select @change="changeLang($event.target.value)">
    <option value="en">English</option>
    <option value="kh">Khmer</option>
  </select>
</template>