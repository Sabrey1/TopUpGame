<template>
    <div>
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
    </div>
</template>

<script setup>
    import {ref} from 'vue'
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
</script>