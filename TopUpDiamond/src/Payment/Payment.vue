
<template>
  <div>
    <Card class="mt-5">
      <template #content>
      
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
