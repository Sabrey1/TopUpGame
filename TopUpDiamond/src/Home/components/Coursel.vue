<template>
  <swiper
    :spaceBetween="30"
    :centeredSlides="true"
    :autoplay="{ delay: 3000, disableOnInteraction: false }"
    :pagination="{ clickable: true }"
    :navigation="true"
    :modules="modules"
    class="mySwiper"
  >
  
    <swiper-slide v-for="item in slides" :key="item.id">
      <img :src="item.image" :alt="item.title || 'slide'" />
    </swiper-slide>
  </swiper>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Pagination, Navigation } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import '@/style.css';

const slides = ref([]);
const modules = [Autoplay, Pagination, Navigation];

async function getSlides() {
  try {
    const res = await app.getApi('panel_coursel');
    if (res.data) slides.value = res.data;
  } catch (error) {
    console.error('Error fetching slides:', error);
  }
}

onMounted(() => {
  getSlides();
});
</script>

<style scoped>
.swiper {
  width: 100%;
  height: 500px;
  border-radius: 5px;
  overflow: hidden;
}

.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: #444;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

.swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 5px;
}

/* Mobile */
@media (max-width: 767px) {
  .swiper {
    height: auto;
    aspect-ratio: 16 / 9;
    max-height: 220px;
    border-radius: 12px;
  }

  .swiper-slide,
  .swiper-slide img {
    border-radius: 12px;
  }

  /* Swipe + dots are enough on a phone */
  .swiper :deep(.swiper-button-prev),
  .swiper :deep(.swiper-button-next) {
    display: none;
  }

  .swiper :deep(.swiper-pagination) {
    bottom: 6px;
  }

  .swiper :deep(.swiper-pagination-bullet) {
    width: 6px;
    height: 6px;
    margin: 0 3px !important;
  }
}
</style>
