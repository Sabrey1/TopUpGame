<template>
  <div class="qr-container">
    <h2>Generate QR Code in Vue</h2>
    
    <input v-model="text" placeholder="Enter text or URL" class="input"/>
    <button @click="generateQRCode" class="btn">Generate QR</button>

    <div v-if="qrCodeData" class="qr-output">
      <img :src="qrCodeData" alt="QR Code" />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import QRCode from 'qrcode'

const text = ref('https://example.com')
const qrCodeData = ref('')

const generateQRCode = async () => {
  try {
    // Generate QR code as Base64
    qrCodeData.value = await QRCode.toDataURL(text.value, { width: 300 })
  } catch (err) {
    console.error(err)
  }
}
</script>

<style scoped>
.qr-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

.input {
  padding: 5px;
  width: 300px;
}

.btn {
  padding: 5px 10px;
  cursor: pointer;
}

.qr-output img {
  margin-top: 10px;
  width: 300px;
  height: 300px;
}
</style>
