<!-- 




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
</style> -->

<template>
  <div>
    <!-- Order Details Modal -->
    <Dialog v-model:visible="orderVisible" modal header="Order Details" :style="{ width: '25rem' }">
      <div v-if="selectedPackage && selectedPayment">
        <div class="flex bg-gray-200 p-2 border-round-sm align-items-center gap-4 mb-4">
          <img class="w-3rem" :src="selectedPackage.image" alt="" />
          <div>
            <p class="m-0 title">
              {{ selectedPackage.amount }} {{ selectedPackage.Unit }}
            </p>
          </div>
        </div>

        <div class="mb-4">
          <div class="flex justify-content-between border-b">
            <span>Paying with:</span>
            <span class="font-semibold">{{ selectedPayment.name }}</span>
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
            @click="confirmOrder"
          />
        </div>
      </div>
      <div v-else class="text-center p-4">Please select a package and payment method first.</div>
    </Dialog>

    <!-- QR Code Modal -->
    <Dialog v-model:visible="qrVisible" modal header="Scan QR Code to Pay" :style="{ width: '25rem' }">
      <div v-if="selectedPackage && selectedPayment" class="text-center">
        <img :src="qrCodeUrl" alt="QR Code" class="mx-auto mb-2 w-64 h-64" />
        <p><strong>Package:</strong> {{ selectedPackage.name }}</p>
        <p><strong>Payment Method:</strong> {{ selectedPayment.name }}</p>
        <p class="mt-2"><strong>MD5:</strong> {{ md5 }}</p>

        <button
          @click="confirmPayment"
          class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
        >
          Complete Payment
        </button>

        <button
          @click="closeQR"
          class="mt-2 ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
        >
          Close
        </button>
      </div>
    </Dialog>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import axios from 'axios'
import QRCode from 'qrcode'
import Dialog from 'primevue/dialog'
import Button from 'primevue/button'

const props = defineProps({
  selectedPackage: Object,
  selectedPayment: Object
})

const orderVisible = ref(false)
const qrVisible = ref(false)
const qrCodeUrl = ref('')
const md5 = ref('')

const taxRate = 0.1
const price = computed(() => props.selectedPackage ? Number(props.selectedPackage.price) : 0)
const tax = computed(() => (price.value * taxRate).toFixed(2))
const total = computed(() => (price.value + Number(tax.value)).toFixed(2))

// Watch props changes and show order modal when both selected
watch([() => props.selectedPackage, () => props.selectedPayment], ([pkg, pay]) => {
  if (pkg && pay) {
    orderVisible.value = true
  }
})

const confirmOrder = async () => {
  orderVisible.value = false // close order modal
  try {
    const res = await axios.get(`http://localhost:8000/api/payments/checkout/${props.selectedPackage.id}`)
    md5.value = res.data.md5
    qrCodeUrl.value = await QRCode.toDataURL(res.data.qr)
    qrVisible.value = true // open QR modal
  } catch (err) {
    console.error(err)
    alert(err.response?.data?.error || 'Failed to generate QR code')
  }
}

const confirmPayment = async () => {
  try {
    await axios.post("http://localhost:8000/api/payments", {
      topup_package_id: props.selectedPackage.id,
      md5: md5.value,
      amount: props.selectedPackage.price,
    })
    alert('Payment recorded successfully!')
    qrVisible.value = false
  } catch (err) {
    console.error(err)
    alert(err.response?.data?.error || 'Payment failed')
  }
}

const closeQR = () => {
  qrVisible.value = false
}
</script>

<style scoped>
.title {
  font-size: 13px;
}
</style>
