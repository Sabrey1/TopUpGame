<!-- <template>
 
  <swiper
    :spaceBetween="30"
    :centeredSlides="true"
    :autoplay="{
      delay: 3000,
      disableOnInteraction: false,
    }"
    :pagination="{
      clickable: true,
    }"
    :navigation="true"
    :modules="modules"
    class="mySwiper"
  >
    <swiper-slide>
        <img src="https://static.vecteezy.com/system/resources/thumbnails/057/068/323/small/single-fresh-red-strawberry-on-table-green-background-food-fruit-sweet-macro-juicy-plant-image-photo.jpg" alt="">
    </swiper-slide>
    <swiper-slide>
        <img src="https://cdn1.codashop.com/S/content/common/images/promos/Dec25/KH_MLBB_X_Wing_Bank_Lucky_Draw_730x280.png"  alt="">
    </swiper-slide>
    <swiper-slide>
        <img src="https://cdn1.codashop.com/S/content/common/images/promos/Jan26/WingPayxCodashop-Lucky%20Draw-730x280.jpg" alt="">
    </swiper-slide>
    <swiper-slide>
        <img src="https://cdn1.codashop.com/S/content/common/images/promos/Jan26/EAFCM_TOTY_KH_730x280.jpg" alt="">
    </swiper-slide>
  </swiper>
</template>
<script>
  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';

  import {ref,onMounted} from 'vue'

  // Import Swiper styles
  import 'swiper/css';

  import 'swiper/css/pagination';
  import 'swiper/css/navigation';

  import '@/style.css';

  // import required modules
  import { Autoplay, Pagination, Navigation } from 'swiper/modules';

  const data = ref([])

  async function getData(){
    const res = await axios.get('http://127.0.0.1:8000/api/panel_coursel')
    if(res.data){
        data.value = res.data
    }
  }
  onMounted(()=>{
    getData()
  })

  export default {
    components: {
      Swiper,
      SwiperSlide,
    },
    setup() {
      return {
        modules: [Autoplay, Pagination, Navigation],
      };
    },
  };
</script>

<style scoped>
  
.swiper {
  width: 100%;
  height: 400px;
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

</style> -->
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
    <!-- Dynamic slides from API -->
    <swiper-slide v-for="item in slides" :key="item.id">
      <img :src="item.image" :alt="item.title || 'slide'" />
    </swiper-slide>
  </swiper>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios'; // ⚠️ Import Axios
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Pagination, Navigation } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import '@/style.css';

const slides = ref([]);
const modules = [Autoplay, Pagination, Navigation];

async function getSlides() {
  try {
    const res = await axios.get('http://127.0.0.1:8000/api/panel_coursel');
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
</style>
