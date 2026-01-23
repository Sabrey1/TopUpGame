<template>
    <div>
         <Card class="mt-5">
        <template #title>Select Payment</template>
        <template #content>
            <div class="grid">
                    <div v-for="Payment in Payments" :key="Payment.id"  class="col-6 md:col-6 lg:col-2 w-12rem" >
                        <Card class="mt-3 border-1  border-gray-400 w-full ">
                            <template #title>
                                <div class="flex justify-content-center align-items-center">
                                    <img
                                        :src="Payment.image"
                                        class="object-cover block w-4rem h-2rem"
                                        alt=""
                                    />
                                </div>
                            </template>
                            <template #content>
                                <div class=""> 
                                     <p class=" text-sm m-0">{{ Payment.name }}</p>
                                    <p class="m-0 text-sm">{{ Payment.price }}</p>
                                </div>
                            </template>
                        </Card>
                    </div>
                </div>
        </template>
    </Card>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const Payments = ref([
    {id:1, name:"Pi Pal", price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/PI_PAY_KH_CHNL_LOGO.webp'},
    {id:1, name:"Bakong",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/BAKONG_KH_CHNL_LOGO.webp'},
    {id:1, name:"Wing",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/WING_KH_CHNL_LOGO.webp'},
    {id:1, name:"Smart",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/Smart_Axiata_KH_CHNL_LOGO.webp'},
    {id:1, name:"Cellcard",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/CELLCARD_KH_CHNL_LOGO.webp'},
    {id:1, name:"Metfone",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/METFONE_KH_CHNL_LOGO.webp'},
    {id:1, name:"Paygo",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/PAYGO_KH_CHNL_LOGO.webp'},
])
</script>