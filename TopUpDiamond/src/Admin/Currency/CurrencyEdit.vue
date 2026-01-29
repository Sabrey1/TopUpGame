<template>
  <div>
    <Button icon="pi pi-pencil" label="Edit" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Edit Currency" style="width:25rem">
      
      <!-- NAME -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="Currency.name" class="flex-auto" />
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

        <!-- SYMBOL -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Symbol</label>
        <InputText v-model="Currency.symbol" class="flex-auto" />
      </div>

        <!-- PRESITION -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Presition</label>
        <InputText v-model="Currency.presition" class="flex-auto" />
      </div>

      <!-- DESCRIPTION -->
      <div class="flex items-center gap-4 mb-8">
        <label class="font-semibold w-24">Note</label>
        <InputText v-model="Currency.note" class="flex-auto" />
      </div>

      <!-- ACTIONS -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="updateCurrency" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const visible = ref(false)

const props = defineProps({
  currency: Object
})

const Currency = ref({
  name: '',
  note: '',
  symbol: '',
  presition: '',
  image: null
})
// Sync with prop
watch(
  () => props.currency,
  (newVal) => {
    if (newVal) {
      Currency.value.id = newVal.id
      Currency.value.name = newVal.name
      Currency.value.note = newVal.note
      Currency.value.symbol = newVal.symbol
      Currency.value.presition = newVal.presition
      Currency.value.image = null
      Currency.value.imagePreview = newVal.image || null
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
    Coursel.value.image = file
    Coursel.value.imagePreview = URL.createObjectURL(file)
  }
}

// Update currency
function updateCurrency() {
  if (!Currency.value.id) return

  const formData = new FormData()
  formData.append('_method', 'PUT')  // Spoof PUT for Laravel
  formData.append('name', Currency.value.name || '')
  formData.append('note', Currency.value.note || '')
  formData.append('symbol', Currency.value.symbol || '')
  formData.append('presition', Currency.value.presition || '')
  if (Currency.value.image) formData.append('image', Currency.value.image)

  axios.post(`http://localhost:8000/api/currency/${Currency.value.id}`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  }).then((response) => {
    const updated = response.data
    Currency.value.name = updated.name
    Currency.value.note = updated.note
    Currency.value.symbol = updated.symbol
    Currency.value.presition = updated.presition
    Currency.value.imagePreview = updated.image || null
    Currency.value.image = null
    window.location.reload()
    visible.value = false
    
  })
}
</script>
