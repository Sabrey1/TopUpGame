<template>
  <div>
    <Button icon="pi pi-plus" label="Add" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Add Currency" style="width:25rem">
      
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
        <Button label="Save" @click="AddCurrency" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const visible = ref(false)

const Currency = ref({
  name: '',
  note: '',
  symbol: '',
  presition: '',
  image: null
})

function onSelect(e) {
  Currency.value.image = e.files[0]
}

async function AddCurrency() {
  const formData = new FormData()
  formData.append('name', Currency.value.name)
  formData.append('note', Currency.value.note)
  formData.append('symbol', Currency.value.symbol)
  formData.append('presition', Currency.value.presition)
  formData.append('image', Currency.value.image)

  await axios.post(
    'http://localhost:8000/api/currency',
    formData,
    { headers: { 'Content-Type': 'multipart/form-data' } }
  )
  window.location.reload()

  visible.value = false
}
</script>
