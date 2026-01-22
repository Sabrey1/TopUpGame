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
    <Card class="mt-3">
        <template #title>Select Recharge</template>
        <template #content>
            <p class="m-0">Our best sellers for you</p>
                <div class="grid">
                    <div v-for="BestSeller in BestSellers" :key="BestSeller.id"  class="col-6 md:col-6 lg:col-2 w-12rem" >
                        <Card class="mt-3 border-1  border-gray-400 w-full">
                            <template #title>
                                <p class="text-center text-sm m-0">{{ BestSeller.name }}</p>
                                <p class="text-center m-0 title">{{ BestSeller.daimond }}</p>
                                <div class="flex justify-content-center align-items-center">
                                    <img
                                        :src="BestSeller.image"
                                        class="object-cover block w-4rem"
                                        alt=""
                                    />
                                </div>
                            </template>
                            <template #content>
                                <div class="">
                                    <p class="m-0 title text-right">From</p>
                                    <p class="m-0 text-sm text-right">{{ BestSeller.price }}</p>
                                    <div class="flex gap-2 align-items-center justify-content-end">
                                        <Chip class="bg-green-200 text-right  title m-0" >{{BestSeller.discount}}</Chip>
                                        <p class="m-0"><s>{{ BestSeller.fullprice }}</s></p>
                                    </div>
                                </div>
                            </template>
                        </Card>
                    </div>
                </div>
            <p>Browse all items</p>
            <div class="flex gap-4">
                <Card>
                    <template #content>
                        <div class="flex gap-2 align-items-center">
                            <img src="https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_Mobile Legends_category/1735899441907_5000orMore_MLBB_Diamonds.png" class="w-2rem" alt="">
                            <p>Diamonds</p>
                        </div>
                    </template>
                </Card>
                <Card>
                    <template #content>
                        <div class="flex gap-2 align-items-center">
                            <img src="https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_f66aebb8ede7c159b2dfc46c2cd00201_category/1741854799644_dcbce7aa-7d85-4e79-ad45-6aed78fcda56.png" class="w-2rem" alt="">
                            <p>Weekly Diamond Pass</p>
                        </div>
                    </template>
                </Card>
            </div>

            <div>
                <p>Diamonds</p>
                <div class="grid">
                    <div v-for="Diamond in Diamonds" :key="Diamond.id"  class="col-6 md:col-6 lg:col-2 w-12rem" >
                        <Card class="mt-3 border-1  border-gray-400 w-full">
                            <template #title>
                                <p class="text-center text-sm m-0">{{ Diamond.name }}</p>
                                <p class="text-center m-0 title">{{ Diamond.daimond }}</p>
                                <div class="flex justify-content-center align-items-center">
                                    <img
                                        :src="Diamond.image"
                                        class="object-cover block w-4rem"
                                        alt=""
                                    />
                                </div>
                            </template>
                            <template #content>
                                <div class="">
                                    <p class="m-0 title text-right">From</p>
                                    <p class="m-0 text-sm text-right">{{ Diamond.price }}</p>
                                    <div class="flex gap-2 align-items-center justify-content-end">
                                        <Chip class="bg-green-200 text-right  title m-0" >{{Diamond.discount}}</Chip>
                                        <p class="m-0"><s>{{ Diamond.fullprice }}</s></p>
                                    </div>
                                </div>
                            </template>
                        </Card>
                    </div>
                </div>
            </div>
            <div>
                <p>Weekly Diamond Pass</p>
                <Card>
                    <template #content>
                        <div class="flex gap-3 align-items-center">
                            <div>
                                <img class="w-2rem" src="https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_f66aebb8ede7c159b2dfc46c2cd00201_category/1741854799644_dcbce7aa-7d85-4e79-ad45-6aed78fcda56.png" alt="">
                            </div>
                            <div>
                                <p class="m-0 title">Weekly Diamond Pass</p>
                                <ol class="pl-3 title" style="margin-top: 0px;">
                                    <li>Please make sure to purchase the Pass once LV 5 is reached.</li>
                                    <li>You cannot purchase an additional Weekly Diamond Pass if your remaining duration is 70 days or more.</li>
                                </ol>
                            </div>
                        </div>
                    </template>
                </Card>
                <div class="grid">
                    <div v-for="Weeklypasses in Weeklypass" :key="Weeklypasses.id"  class="col-6 md:col-6 lg:col-2 w-12rem" >
                        <Card class="mt-3 border-1  border-gray-400 w-full">
                            <template #title>
                                <p class="text-center text-sm m-0">{{ Weeklypasses.name }}</p>
                                <p class="text-center m-0 title">{{ Weeklypasses.daimond }}</p>
                                <div class="flex justify-content-center align-items-center">
                                    <img
                                        :src="Weeklypasses.image"
                                        class="object-cover block w-4rem"
                                        alt=""
                                    />
                                </div>
                            </template>
                            <template #content>
                                <div class="">
                                    <p class="m-0 title text-right">From</p>
                                    <p class="m-0 text-sm text-right">{{ Weeklypasses.price }}</p>
                                    <div class="flex gap-2 align-items-center justify-content-end">
                                        <Chip class="bg-green-200 text-right  title m-0" >{{Weeklypasses.discount}}</Chip>
                                        <p class="m-0"><s>{{ Weeklypasses.fullprice }}</s></p>
                                    </div>
                                </div>
                            </template>
                        </Card>
                    </div>
                </div>
            </div>
            
        </template>
    </Card>
    <!--  -->
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
    <!--  -->
    <Card class="mt-5">
        <template #title>Select Payment</template>
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

import Divider from 'primevue/divider';

const visible = ref(false);
const value = ref(null);

const BestSellers = ref([
    {id:1, name:"56 Diamonds", daimond:"51 + 5 Bonus", discount:"-22%", price:"US$0.97", fullprice:"US$1.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203562_e4990cee-4020-4a74-8fc2-ae7f68fdabcd.png'},
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
])

const Weeklypass = ref([
    {id:1, name:"Weekly Diamond Pass",  discount:"-23%", price:"US$1.93", fullprice:"US$2.49", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_f66aebb8ede7c159b2dfc46c2cd00201_category/1741854799644_dcbce7aa-7d85-4e79-ad45-6aed78fcda56.png'},
])


const Diamonds = ref([
    {id:1, name:"56 Diamonds", daimond:"51 + 5 Bonus", discount:"-22%", price:"US$0.97", fullprice:"US$1.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203562_e4990cee-4020-4a74-8fc2-ae7f68fdabcd.png'},
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
    {id:2, name:"456 Diamonds", daimond:"456 + 5 Bonus", price:"US$4.97", discount:"-22%", fullprice:"US$6.25", image:'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png'}, 
])

const Payments = ref([
    {id:1, name:"Pi Pal", price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/PI_PAY_KH_CHNL_LOGO.webp'},
    {id:1, name:"Bakong",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/BAKONG_KH_CHNL_LOGO.webp'},
    {id:1, name:"Wing",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/WING_KH_CHNL_LOGO.webp'},
    {id:1, name:"Smart",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/Smart_Axiata_KH_CHNL_LOGO.webp'},
    {id:1, name:"Cellcard",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/CELLCARD_KH_CHNL_LOGO.webp'},
    {id:1, name:"Metfone",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/METFONE_KH_CHNL_LOGO.webp'},
    {id:1, name:"Paygo",price:"US$0.97", image:'https://cdn1.codashop.com/S/content/common/images/mno/PAYGO_KH_CHNL_LOGO.webp'},
])

const orderDetails = ref(
    {id:1,nickname:"Cobra",paymentMethod:"Paypal",price:"US$0.97",tax:"US$0.97"},
)
</script>

<style scoped>
.title{
    font-size: 13px;
}
</style>