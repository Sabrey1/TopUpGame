<template>
    <Card>
        <template #title>{{t("Enter User ID")}}</template>
        <template #content>
            <div class="flex gap-3">
                <InputText type="text" fluid placeholder="Enter User ID" v-model="value" />
                <InputText type="text" fluid placeholder="Zone ID" v-model="value" />
            </div>
            <div>
                <Button label="Check ID" class="mt-3"></Button>
            </div>
             <p class="text-gray-400 text-sm mt-1">To find your User ID, click on your avatar in the top left corner of the main game screen. Then go to the "Basic Info" tab. Your user ID is shown below your nickname. Please input the complete user ID here, e.g. 12345678(1234).</p>
        </template>
    </Card>
    <!--  -->
    <topUp />
    <!--  -->
    <SelectPaymentType/>
    <!--  -->
    <Payment/>
</template>

<script setup>
import { ref } from 'vue';


import topUp from '@/TopUp/topUp.vue'
import SelectPaymentType from '@/PaymentMethod/SelectPaymentType.vue'
import Payment from '@/Payment/Payment.vue'

const value = ref(null);

const t = window.t
</script>

<style scoped>
.title{
    font-size: 13px;
}
</style>