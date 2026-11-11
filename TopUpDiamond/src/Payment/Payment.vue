<template>
  <div>
    <Toast />

    <Card class="checkout-card mt-5">
      <template #content>

        <div class="checkout-content">
          <div class="checkout-summary">
            <span class="section-label">YOUR ORDER</span>
            <h2>{{ selectedPackage?.name || 'Ready to top up?' }}</h2>
            <p v-if="selectedPackage">{{ selectedPackage.amount }} {{ selectedPackage.unit_name || selectedPackage.Unit || '' }} <span v-if="selectedPayment"> · {{ selectedPayment.name }}</span></p>
            <p v-else>Select a package and payment method to continue.</p>
          </div>
          <div class="checkout-action">
            <div class="checkout-price"><span>Total</span><strong>{{ currencySymbol }}{{ price }}</strong></div>
          <Button
            label="Continue to payment"
            icon="pi pi-arrow-right"
            iconPos="right"
            class="checkout-button"
            severity="success"
            :disabled="!selectedPackage || !selectedPayment"
            @click="visible = true"
          />
          </div>
        </div>

        <!-- ORDER DETAILS -->
        <Dialog
          v-model:visible="visible"
          modal
          header="Review your order"
          :style="{ width: '25rem', maxWidth: '90vw' }"
          :closable="true"
          class="payment-dialog"
        >
          <p class="dialog-intro">Everything look right? Confirm the details below to continue.</p>
          <div class="order-product">
            <img v-if="selectedPackage?.image" :src="selectedPackage.image" alt="" />
            <div v-else class="product-placeholder"><i class="pi pi-box"></i></div>
            <div><span class="section-label">TOP-UP PACKAGE</span><strong>{{ selectedPackage?.name || 'Top-up package' }}</strong><small>{{ selectedPackage?.amount }} {{ selectedPackage?.unit_name || selectedPackage?.Unit || '' }}</small></div>
          </div>

          <div class="order-details">
            <div><span>Payment method</span><strong>{{ selectedPayment?.name }}</strong></div>
            <div class="order-total"><span>Total to pay</span><strong>{{ currencySymbol }}{{ price }}</strong></div>
          </div>
          <Button label="Continue to QR payment" icon="pi pi-arrow-right" iconPos="right" severity="success" class="w-full" @click="confirmOrder" />
          <button class="text-action" type="button" @click="visible = false">Back to order</button>
        </Dialog>
      </template>
    </Card>

    <!-- QR PAYMENT -->
    <Dialog
      v-model:visible="qrVisible"
      modal
      header="Scan QR to Pay"
      :style="{ width: '25rem', maxWidth: '90vw' }"
      :closable="true"
      class="payment-dialog"
      @hide="clearQr"
    >
      <div class="qr-dialog">
        <p class="dialog-intro">Open your banking app and scan this code to pay.</p>
        <div class="qr-frame">
        <img
          v-if="qrCodeUrl"
          :src="qrCodeUrl"
          class="qr-image"
          alt="Scan this KHQR code with your banking app"
        />
        <div v-else class="qr-placeholder"><i :class="generatingQr ? 'pi pi-spin pi-spinner' : 'pi pi-qrcode'"></i><span>{{ generatingQr ? 'Generating QR code...' : 'QR code expired' }}</span></div>
        </div>
        <div class="qr-amount"><span>AMOUNT TO PAY</span><strong>{{ currencySymbol }}{{ price }}</strong></div>
        <div v-if="paymentStatus" class="payment-status" role="status"><span class="status-dot"></span>{{ paymentStatus }}</div>

        <a v-if="qrCodeUrl" :href="qrCodeUrl" download="payment-qr.png" class="qr-download">
          <i class="pi pi-download" aria-hidden="true"></i> Download QR code
        </a>
        <Button
          label="Generate new QR code"
          icon="pi pi-refresh"
          class="w-full"
          severity="secondary"
          :loading="generatingQr"
          :disabled="checkingPayment"
          @click="confirmOrder"
        />
        <p class="qr-note">The QR code expires after five minutes. Keep this page open for payment confirmation.</p>
        <p class="qr-note">Already paid? Please wait for confirmation before generating a new code.</p>
      </div>
    </Dialog>

    <Dialog
      v-model:visible="successVisible"
      modal
      :showHeader="false"
      :style="{ width: '26rem', maxWidth: '90vw' }"
      aria-labelledby="payment-success-title"
    >
      <div class="success-dialog">
        <div class="success-icon" aria-hidden="true"><i class="pi pi-check"></i></div>
        <p class="success-eyebrow">PAYMENT CONFIRMED</p>
        <h2 id="payment-success-title">Payment successful!</h2>
        <p class="success-description">Thank you! Your payment has been confirmed.</p>
        <div class="success-details">
          <div><span>Package</span><strong>{{ paymentReceipt.packageName }}</strong></div>
          <div><span>Payment method</span><strong>{{ paymentReceipt.paymentMethod }}</strong></div>
          <div class="success-total"><span>Amount paid</span><strong>{{ paymentReceipt.amount }}</strong></div>
        </div>
        <Button label="Done" severity="success" class="w-full" @click="successVisible = false" />
      </div>
    </Dialog>
  </div>
</template>

<script setup>
import { ref, computed, onUnmounted } from 'vue'
import QRCode from 'qrcode'
import Toast from 'primevue/toast'
import Dialog from 'primevue/dialog'
import { useToast } from 'primevue/usetoast'

const toast = useToast()

/* STATE */
const visible = ref(false)
const qrVisible = ref(false)
const successVisible = ref(false)
const paymentReceipt = ref({ packageName: '', paymentMethod: '', amount: '' })
const qrCodeUrl = ref('')
const md5 = ref('')
const generatingQr = ref(false)
const checkingPayment = ref(false)
const paymentStatus = ref('')
let qrExpiryTimer
let pollTimer
let qrGeneration = 0

function clearQr() {
  qrGeneration++
  clearTimeout(qrExpiryTimer)
  clearTimeout(pollTimer)
  qrCodeUrl.value = ''
  md5.value = ''
  paymentStatus.value = ''
}

onUnmounted(clearQr)

const props = defineProps({
  selectedPackage: Object,
  selectedPayment: Object
})

/* PRICE */
const price = computed(() =>
  props.selectedPackage ? Number(props.selectedPackage.price) : 0
)
const currencySymbol = computed(() => props.selectedPackage?.currency_symbol || '')

/* GENERATE QR */
const confirmOrder = async () => {
  visible.value = false
  clearQr()
  const generation = qrGeneration
  qrVisible.value = true
  generatingQr.value = true

  try {
    const res = await app.getApi(
      `checkout/${props.selectedPackage.id}`
    )

    if (!res.data.qr || !res.data.md5) throw new Error('Missing QR data')
    const image = await QRCode.toDataURL(res.data.qr, { errorCorrectionLevel: 'M', margin: 4, width: 512 })
    if (generation !== qrGeneration) return
    md5.value = res.data.md5
    qrCodeUrl.value = image
    paymentStatus.value = 'Waiting for payment confirmation...'

    // Hide the QR after five minutes, but retain its MD5 for payment confirmation.
    const expiresIn = Math.max(0, res.data.expires_at - Date.now())
    qrExpiryTimer = setTimeout(() => {
      qrCodeUrl.value = ''
      clearTimeout(pollTimer)
      paymentStatus.value = 'QR code expired. If you have paid, contact support before creating a new QR code.'
    }, expiresIn)
    pollTimer = setTimeout(() => confirmPayment(generation, res.data.expires_at), 5000)

  } catch (err) {
    toast.add({
      severity: 'error',
      summary: 'Error',
      detail: err.response?.data?.message || 'Failed to generate QR payment',
      life: 3000
    })
  } finally {
    generatingQr.value = false
  }
}

/* PAYMENT CONFIRM */
const confirmPayment = async (generation, expiresAt) => {
  if (generation !== qrGeneration || !md5.value) return
  checkingPayment.value = true
  try {
    const response = await app.postApi('payment', {
      topup_package_id: props.selectedPackage.id,
      md5: md5.value,
      amount: props.selectedPackage.price
    })

    if (generation !== qrGeneration) return
    paymentReceipt.value = {
      packageName: props.selectedPackage?.name || 'Top-up package',
      paymentMethod: props.selectedPayment?.name || 'KHQR',
      amount: `${currencySymbol.value}${response.data.payment.amount}`
    }
    qrVisible.value = false
    successVisible.value = true

  } catch (err) {
    if (generation !== qrGeneration) return
    if (Date.now() >= expiresAt) {
      paymentStatus.value = 'QR code expired. If you have paid, contact support before creating a new QR code.'
      return
    }
    const message = err.response?.data?.message
    if (err.response?.status === 422 && message === 'Payment has not been confirmed by Bakong.') {
      paymentStatus.value = 'Waiting for payment confirmation...'
    } else if (!err.response || err.response.status >= 500) {
      paymentStatus.value = 'Payment verification is temporarily unavailable. Retrying...'
    } else {
      paymentStatus.value = message || 'Unable to check the payment. Please contact support.'
      return
    }
    pollTimer = setTimeout(() => confirmPayment(generation, expiresAt), 5000)
  } finally {
    checkingPayment.value = false
  }
}
</script>

<style scoped>
.checkout-card {
  border: 1px solid var(--p-content-border-color, #e4e8e4);
  border-radius: 1rem;
  overflow: hidden;
}

.checkout-content, .checkout-action { display: flex; align-items: center; gap: 1.5rem; }
.checkout-content { justify-content: space-between; }
.checkout-summary { min-width: 0; }
.section-label { color: #15803d; font-size: 0.68rem; font-weight: 800; letter-spacing: 0.12em; }
.checkout-summary h2 { margin: 0.45rem 0 0.25rem; font-size: 1.12rem; }
.checkout-summary p { margin: 0; opacity: 0.7; font-size: 0.875rem; }
.checkout-price { display: flex; flex-direction: column; gap: 0.1rem; text-align: right; white-space: nowrap; }
.checkout-price span { opacity: 0.65; font-size: 0.75rem; }
.checkout-price strong { font-size: 1.35rem; }
.checkout-button { min-width: 12.5rem; }

.dialog-intro { margin: 0 0 1.4rem; opacity: 0.7; line-height: 1.5; font-size: 0.9rem; }
.order-product { display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 0.85rem; background: var(--p-surface-100, #f4f7f4); }
.order-product img, .product-placeholder { width: 3.75rem; height: 3.75rem; border-radius: 0.65rem; object-fit: cover; flex-shrink: 0; }
.product-placeholder { display: grid; place-items: center; background: #dcfce7; color: #15803d; font-size: 1.25rem; }
.order-product div:last-child { display: flex; flex-direction: column; gap: 0.25rem; min-width: 0; }
.order-product strong { overflow-wrap: anywhere; }
.order-product small { opacity: 0.65; }
.order-details { margin: 1.25rem 0 1.5rem; }
.order-details div { display: flex; justify-content: space-between; gap: 1rem; padding: 0.75rem 0; font-size: 0.9rem; }
.order-details span { opacity: 0.65; }
.order-details strong { text-align: right; }
.order-total { border-top: 1px solid var(--p-content-border-color, #e5e7eb); margin-top: 0.25rem; align-items: center; }
.order-total strong { font-size: 1.3rem; }
.text-action { display: block; margin: 1rem auto 0; border: 0; background: none; color: inherit; opacity: 0.7; font: inherit; cursor: pointer; }
.text-action:hover { opacity: 1; }
.text-action:focus-visible { outline: 2px solid #22c55e; outline-offset: 4px; }

.qr-dialog { text-align: center; }
.qr-frame { display: grid; place-items: center; width: min(100%, 18rem); min-height: 18rem; margin: 0 auto; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 1rem; background: #fff; }
.qr-image {
  display: block;
  width: 100%;
  max-width: 100%;
  aspect-ratio: 1 / 1;
}
.qr-placeholder { display: flex; flex-direction: column; align-items: center; gap: 0.75rem; color: #64748b; font-size: 0.875rem; }
.qr-placeholder i { font-size: 2rem; }
.qr-amount { display: flex; flex-direction: column; gap: 0.25rem; margin: 1.25rem 0; }
.qr-amount span { opacity: 0.65; font-size: 0.68rem; letter-spacing: 0.1em; font-weight: 700; }
.qr-amount strong { font-size: 1.75rem; line-height: 1.2; }
.payment-status { display: flex; align-items: flex-start; justify-content: center; gap: 0.5rem; margin-bottom: 1.25rem; font-size: 0.8rem; line-height: 1.5; }
.status-dot { flex: 0 0 0.5rem; height: 0.5rem; margin-top: 0.35rem; border-radius: 50%; background: #22c55e; }
.qr-download { display: flex; align-items: center; justify-content: center; gap: 0.5rem; width: 100%; padding: 0.75rem 1rem; margin-bottom: 0.75rem; border-radius: 0.4rem; background: #16a34a; color: #fff; font-weight: 600; }
.qr-download:hover { background: #15803d; color: #fff; }
.qr-download:focus-visible { outline: 2px solid #22c55e; outline-offset: 3px; }
.qr-note { margin: 1rem 0 0; opacity: 0.6; font-size: 0.75rem; line-height: 1.5; }

.success-dialog {
  padding: 1rem 0.25rem 0.25rem;
  text-align: center;
}

.success-icon {
  display: grid;
  place-items: center;
  width: 5rem;
  height: 5rem;
  margin: 0 auto 1.25rem;
  border-radius: 50%;
  background: #dcfce7;
  color: #16a34a;
}

.success-icon i { font-size: 2rem; }
.success-eyebrow { color: #16a34a; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em; }
.success-dialog h2 { margin: 0.5rem 0; }
.success-description { opacity: 0.7; margin: 0 0 1.5rem; }
.success-details { padding: 1rem; margin-bottom: 1.5rem; border: 1px solid var(--p-content-border-color, #ddd); border-radius: 0.75rem; text-align: left; }
.success-details div { display: flex; justify-content: space-between; gap: 1rem; padding: 0.4rem 0; }
.success-details span { opacity: 0.7; }
.success-details strong { text-align: right; overflow-wrap: anywhere; }
.success-total { margin-top: 0.5rem; padding-top: 0.9rem !important; border-top: 1px solid var(--p-content-border-color, #ddd); }
.success-total strong { color: #16a34a; font-size: 1.25rem; }

@media (max-width: 600px) {
  .checkout-content { align-items: stretch; flex-direction: column; gap: 1.25rem; }
  .checkout-action { justify-content: space-between; }
  .checkout-price { text-align: left; }
  .checkout-button { min-width: 0; }
  .qr-frame { min-height: 15rem; }
}
</style>
