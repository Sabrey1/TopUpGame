<!-- <template>
    <div>
        <Card class="mt-5">
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
    </div>
</template>

<script setup>
import {ref} from 'vue'
import Dialog from 'primevue/dialog';
const visible = ref(false);
const orderDetails = ref(
    {id:1,nickname:"Cobra",paymentMethod:"Paypal",price:"US$0.97",tax:"US$0.97"},
)
</script> -->

<template>
  <div>
    <Card class="mt-5">
      <template #content>
        <!-- Summary -->
        <div class="flex align-items-center" style="margin-bottom:-15px;">
          <p class="m-0">
            {{ selectedPackage?.amount }} {{ selectedPackage?.Unit }}
          </p>
          <ul>
            <li>{{ selectedPayment?.name }}</li>
          </ul>
        </div>

        <div class="flex justify-content-between">
          <div>
            <p class="m-0">US${{ price }}</p>
            <p class="title m-0">Tax to be added at checkout</p>
          </div>

          <div>
            <Button
              label="Buy Now"
              class="w-20rem border-round"
              severity="success"
              :disabled="!selectedPackage || !selectedPayment"
              @click="visible = true"
            />

            <!-- Dialog -->
            <Dialog v-model:visible="visible" modal header="Order Details" :style="{ width: '25rem' }">

              <div class="flex bg-gray-200 p-2 border-round-sm align-items-center gap-4 mb-4">
                <img
                  class="w-3rem"
                  :src="selectedPackage?.image"
                  alt=""
                />
                <div>
                  <p class="m-0 title">
                    {{ selectedPackage?.amount }} {{ selectedPackage?.Unit }}
                  </p>
                </div>
              </div>

              <div class="mb-4">
                <div class="flex justify-content-between border-b">
                  <span>Paying with:</span>
                  <span class="font-semibold">{{ selectedPayment?.name }}</span>
                </div>
                <hr>

                <div class="flex justify-content-between border-b">
                  <span>Price:</span>
                  <span class="font-semibold">US${{ price }}</span>
                </div>
                <hr>

                <div class="flex justify-content-between border-b">
                  <span>Tax:</span>
                  <span class="font-semibold">US${{ tax }}</span>
                </div>
                <hr>
              </div>

              <div class="flex justify-content-between align-items-center">
                <div>
                  <p class="m-0">Total Payment</p>
                  <p class="m-0">US${{ total }}</p>
                </div>

                <Button
                  label="Confirm and go to payment"
                  @click="visible = false"
                />
              </div>

            </Dialog>
          </div>
        </div>

      </template>
    </Card>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import Dialog from 'primevue/dialog'

const visible = ref(false)

/* ✅ PROPS FROM PARENT (RENAMED!) */
const props = defineProps({
  selectedPackage: Object,
  selectedPayment: Object
})

const taxRate = 0.1

const price = computed(() => props.selectedPackage ? Number(props.selectedPackage.price) : 0)
const tax = computed(() => (price.value * taxRate).toFixed(2))
const total = computed(() => (price.value + Number(tax.value)).toFixed(2))
</script>

<style scoped>
.title {
  font-size: 13px;
}
</style>
