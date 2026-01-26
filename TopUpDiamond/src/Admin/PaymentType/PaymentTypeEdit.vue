<template>
  <div>
    <!-- Edit Button -->
    <Button icon="pi pi-pencil" label="Edit" @click="openDialog" />

    <!-- Edit Dialog -->
    <Dialog v-model:visible="visible" modal header="Edit Payment Type" style="width:25rem">

      <!-- Name -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="PaymentType.name" class="flex-auto" />
      </div>

      <!-- Image Upload / Preview -->
      <div class="mb-4">
        <label class="font-semibold w-24 block mb-1">Image</label>

        <!-- Preview current image -->
        <img
          v-if="PaymentType.imagePreview"
          :src="PaymentType.imagePreview"
          alt="Preview"
          class="mb-2 rounded border"
          style="max-width: 100%; height: auto;"
        />

        <!-- File upload -->
        <FileUpload
          mode="basic"
          accept="image/*"
          :maxFileSize="1000000"
          @select="onSelect"
        />
      </div>

      <!-- Description -->
      <div class="flex items-center gap-4 mb-8">
        <label class="font-semibold w-24">Description</label>
        <InputText v-model="PaymentType.description" class="flex-auto" />
      </div>

      <!-- Actions -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="updatePaymentType" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const visible = ref(false)

const props = defineProps({
  payment_type: Object
})

// Local reactive copy for editing
const PaymentType = ref({
  id: null,
  name: '',
  description: '',
  image: null,          // File object
  imagePreview: null,   // URL for display
})

// Sync with prop
watch(
  () => props.payment_type,
  (newVal) => {
    if (newVal) {
      PaymentType.value.id = newVal.id
      PaymentType.value.name = newVal.name
      PaymentType.value.description = newVal.description
      PaymentType.value.image = null
      PaymentType.value.imagePreview = newVal.image || null
    }
  },
  { immediate: true }
)

function openDialog() {
  visible.value = true
}

// Handle image selection
function onSelect(event) {
  const file = event.files[0]
  if (file) {
    PaymentType.value.image = file
    PaymentType.value.imagePreview = URL.createObjectURL(file)
  }
}

// Update PaymentType
function updatePaymentType() {
  if (!PaymentType.value.id) return

  const formData = new FormData()
  formData.append('_method', 'PUT')  // Spoof PUT for Laravel
  formData.append('name', PaymentType.value.name)
  formData.append('description', PaymentType.value.description || '')
  if (PaymentType.value.image) formData.append('image', PaymentType.value.image)

  axios.post(`http://localhost:8000/api/payment_type/${PaymentType.value.id}`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  }).then((response) => {
    const updated = response.data
    
    PaymentType.value.name = updated.name ?? ''
    PaymentType.value.description = updated.description
    PaymentType.value.imagePreview = updated.image || null
    PaymentType.value.image = null
    
    visible.value = false
    window.location.reload()
    
  })
}
</script>
