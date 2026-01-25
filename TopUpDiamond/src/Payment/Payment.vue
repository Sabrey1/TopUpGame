<!-- <template>
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
  -->

  <template>
  <div>
    <Toast />

    <Card class="mt-5">
      <template #content>

        <!-- SELECTED INFO -->
        <div class="flex align-items-center" style="margin-bottom:-15px;">
          <p class="m-0">
            {{ selectedPackage?.amount }} {{ selectedPackage?.Unit }}
          </p>
          <ul>
            <li>{{ selectedPayment?.name }}</li>
          </ul>
        </div>

        <!-- PRICE -->
        <div class="flex justify-content-between">
          <div>
            <p class="m-0">US${{ price }}</p>
            <p class="title m-0">Tax to be added at checkout</p>
          </div>

          <Button
            label="Buy Now"
            class="w-20rem border-round"
            severity="success"
            :disabled="!selectedPackage || !selectedPayment"
            @click="visible = true"
          />
        </div>

        <!-- ORDER DETAILS -->
        <Dialog
          v-model:visible="visible"
          modal
          header="Order Details"
          :style="{ width: '25rem' }"
          :closable="false"
        >
          <div class="flex bg-gray-200 p-2 border-round-sm align-items-center gap-4 mb-4">
            <img class="w-3rem" :src="selectedPackage?.image" />
            <p class="m-0 title">
              {{ selectedPackage?.amount }} {{ selectedPackage?.Unit }}
            </p>
          </div>

          <div class="mb-4">
            <div class="flex justify-content-between">
              <span>Paying with:</span>
              <span class="font-semibold">{{ selectedPayment?.name }}</span>
            </div>
            <hr>

            <div class="flex justify-content-between">
              <span>Price:</span>
              <span class="font-semibold">US${{ price }}</span>
            </div>
            <hr>

            <div class="flex justify-content-between">
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
              label="Confirm & Pay"
              severity="success"
              @click="confirmOrder"
            />
          </div>
        </Dialog>
      </template>
    </Card>

    <!-- QR PAYMENT -->
    <Dialog
      v-model:visible="qrVisible"
      modal
      header="Scan QR to Pay"
      :style="{ width: '25rem' }"
      :closable="false"
    >
      <div class="text-center">
        <img
          v-if="qrCodeUrl"
          :src="qrCodeUrl"
          class="w-64 h-64 mx-auto mb-3"
        />

        <p class="text-sm break-all">
          <strong>MD5:</strong> {{ md5 }}
        </p>

        <Button
          label="I Have Paid"
          class="mt-3 w-full"
          severity="success"
          @click="confirmPayment"
        />
      </div>
    </Dialog>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import QRCode from 'qrcode'
import Toast from 'primevue/toast'
import Dialog from 'primevue/dialog'
import { useToast } from 'primevue/usetoast'

const toast = useToast()

/* STATE */
const visible = ref(false)
const qrVisible = ref(false)
const qrCodeUrl = ref('')
const md5 = ref('')

const props = defineProps({
  selectedPackage: Object,
  selectedPayment: Object
})

/* PRICE */
const taxRate = 0.1
const price = computed(() =>
  props.selectedPackage ? Number(props.selectedPackage.price) : 0
)
const tax = computed(() => (price.value * taxRate).toFixed(2))
const total = computed(() => (price.value + Number(tax.value)).toFixed(2))

/* GENERATE QR */
const confirmOrder = async () => {
  visible.value = false

  try {
    const res = await axios.get(
      `http://localhost:8000/api/checkout/${props.selectedPackage.id}`
    )

    md5.value = res.data.md5
    qrCodeUrl.value = await QRCode.toDataURL(res.data.qr)
    qrVisible.value = true

    // ⏱ auto close QR after 5 minutes
    setTimeout(() => {
      qrVisible.value = false
    }, 300000)

  } catch (err) {
    toast.add({
      severity: 'error',
      summary: 'Error',
      detail: 'Failed to generate QR payment',
      life: 3000
    })
  }
}

/* PAYMENT CONFIRM */
const confirmPayment = async () => {
  try {
    await axios.post('http://localhost:8000/api/payment', {
      topup_package_id: props.selectedPackage.id,
      md5: md5.value,
      amount: props.selectedPackage.price
    })

    toast.add({
      severity: 'success',
      summary: 'Payment Success',
      detail: 'Payment completed successfully 🎉',
      life: 3000
    })

    // ✅ AUTO CLOSE & RESET
    setTimeout(() => {
      qrVisible.value = false
      qrCodeUrl.value = ''
      md5.value = ''
    }, 2000)

  } catch (err) {
    toast.add({
      severity: 'error',
      summary: 'Payment Failed',
      detail: 'Please try again',
      life: 3000
    })
  }
}
</script>
