<template>
    <Card>
        <template #title>Enter User ID</template>
        <template #content>
            <div class="flex gap-3">
                <InputText type="text" fluid placeholder="Enter User ID" v-model="value" />
                <InputText type="text" fluid placeholder="Zone ID" v-model="value" />
            </div>
             <p class="text-gray-400 text-sm m-0">To find your User ID, click on your avatar in the top left corner of the main game screen. Then go to the "Basic Info" tab. Your user ID is shown below your nickname. Please input the complete user ID here, e.g. 12345678(1234).</p>
        </template>
    </Card>
    <!--  -->
    <topUp />
    <!--  -->
    <SelectPaymentType/>
    <!--  -->
    <Card class="mt-5">
        <template #title></template>
        <template #content>
            <div class="flex align-items-center" style="margin-bottom: -15px;">
                <p class="m-0">27 Diamonds (26 + 1 Bonus)</p>
                <ul><li>Pi Pay</li></ul>
            </div>
            <div class="flex justify-content-between">
                <div>
                    <p class="m-0" >US$0.49</p>
                    <p class="title m-0">Tax to be added at checkout</p>
                </div>
                <div class="">
                    <Button label="Buy Now" @click="visible = true" class="w-20rem border-round" severity="success"></Button>
                    <Dialog v-model:visible="visible" modal header="Order Details" :style="{ width: '25rem' }">
                        <span class="text-surface-500 dark:text-surface-400 block title mb-2 ">Please confirm your information is correct.</span>
                        <div class="flex bg-gray-200 p-2 border-round-sm align-items-center gap-4 mb-4">
                            <div>
                                <img class="w-3rem" src="https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203562_e4990cee-4020-4a74-8fc2-ae7f68fdabcd.png" alt="">
                            </div>
                            <div>
                                <p class="m-0 title">27 Diamonds</p>
                                <p class="m-0 title">(26 + 1 Bonus)</p>
                            </div> 
                        </div>
                        <div class="flex items-center gap-4 mb-4 w-full">
                            <div class="mb-4 w-full">
                                <div class="flex justify-content-between align-items-center  border-b">
                                <span class="text-gray-600">Nickname:</span>
                                <span class="font-semibold">{{ orderDetails.nickname }}</span>
                                </div>
                                <hr class="mt-0">

                                <div class="flex justify-content-between align-items-center border-b">
                                <span class="text-gray-600">ID:</span>
                                <span class="font-semibold">{{ orderDetails.id }}</span>
                                </div>
                                <hr class="mt-0">

                                <div class="flex justify-content-between align-items-center border-b">
                                <span class="text-gray-600">Paying with:</span>
                                <span class="font-semibold">{{ orderDetails.paymentMethod }}</span>
                                </div>
                                <hr class="mt-0"></hr>

                                <div class="flex justify-content-between align-items-center border-b">
                                <span class="text-gray-600">Price:</span>
                                <span class="font-semibold">{{ orderDetails.price }}</span>
                                </div>
                                <hr class="mt-0">

                                <div class="flex justify-content-between align-items-center">
                                <span class="text-gray-600">Tax:</span>
                                <span class="font-semibold">{{ orderDetails.tax }}</span>
                                </div>
                                <hr class="mt-0">
                            </div>
                        </div>
                        <div class="flex justify-content-between align-items-center ">
                             <div>
                                <p class="m-0">Total Payment</p>
                                <p class="m-0">US$0.49</p>
                             </div>
                             <div>
                                <Button type="button" label="Confirm and go to payment" @click="visible = false"></Button>
                             </div>
                            
                        </div>
                    </Dialog>
                </div>
            </div>
             
        </template>
    </Card>

</template>

<script setup>
import { ref } from 'vue';
import Dialog from 'primevue/dialog';

import topUp from '@/TopUp/topUp.vue'
import SelectPaymentType from '@/PaymentMethod/SelectPaymentType.vue'

const visible = ref(false);
const value = ref(null);





const orderDetails = ref(
    {id:1,nickname:"Cobra",paymentMethod:"Paypal",price:"US$0.97",tax:"US$0.97"},
)
</script>

<style scoped>
.title{
    font-size: 13px;
}
</style>