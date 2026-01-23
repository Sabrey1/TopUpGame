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
                                    <!-- <p class="m-0 text-sm">{{ Payment.price }}</p> -->
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
import { ref,onMounted } from 'vue';
import axios from 'axios'

const Payments = ref([])

async function getData(){
    const res = await axios.get('http://127.0.0.1:8000/api/payment_type')
    if(res.data){
        Payments.value = res.data
    }
}

onMounted(()=>{
getData()
})

</script>