<template>
    <CheckUser/>
   
    <topUp @package-selected="onPackageSelected"/>
    
    <SelectPaymentType @payment-selected="onPaymentSelected"/>
 
    <Payment :selectedPackage="selectedPackage" :selectedPayment="selectedPayment"/>
</template>

<script setup>
import {ref} from 'vue'
import CheckUser from '@/CheckUser/CheckUser.vue'
import topUp from '@/TopUp/topUp.vue'
import SelectPaymentType from '@/PaymentMethod/SelectPaymentType.vue'
import Payment from '@/Payment/Payment.vue'

const t = window.t

 
const selectedPackage = ref(null)
const selectedPayment = ref(null)

const onPackageSelected = (pkg) => {
  selectedPackage.value = pkg
}

const onPaymentSelected = (payment) => {
  selectedPayment.value = payment
}
</script>

<style scoped>
.title{
    font-size: 13px;
}
</style>