<template>
  <div>
    <Button icon="pi pi-plus" label="Add" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Add Payment Type" style="width:25rem">
      
      <!-- Name -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="PaymentType.name" class="flex-auto" />
      </div>

      <!-- IMAGE -->
      <div class="mb-4">
        <FileUpload
          mode="basic"
          accept="image/*"
          :maxFileSize="1000000"
          @select="onSelect"
        />
      </div>

      <!-- DESCRIPTION -->
      <div class="flex items-center gap-4 mb-8">
        <label class="font-semibold w-24">Description</label>
        <InputText v-model="PaymentType.description" class="flex-auto" />
      </div>

      <!-- ACTIONS -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="AddPaymentType" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const visible = ref(false)

const PaymentType = ref({
  name: '',
  description: '',
  image: null
})

function onSelect(e) {
  PaymentType.value.image = e.files[0]
}

async function AddPaymentType() {
  const formData = new FormData()
  formData.append('name', PaymentType.value.name)
  formData.append('description', PaymentType.value.description)
  formData.append('image', PaymentType.value.image)

  await axios.post(
    'http://localhost:8000/api/payment_type',
    formData,
    { headers: { 'Content-Type': 'multipart/form-data' } }
  )
  window.location.reload()

  visible.value = false
}
</script>
