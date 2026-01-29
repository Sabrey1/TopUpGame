<template>
  <div>
    <Button icon="pi pi-pencil" label="Edit" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Edit Top Up Package" style="width:25rem">
      
      <!-- Name -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="TopUpPackage.name" class="flex-auto" />
      </div>
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Game</label>
        <InputText v-model="TopUpPackage.game_id" class="flex-auto" />
      </div>
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Full Price</label>
        <InputText v-model="TopUpPackage.fullprice" class="flex-auto" />
      </div>
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Currency</label>
        <InputText v-model="TopUpPackage.currency" class="flex-auto" />
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

      <!-- Amount -->
      <div class="flex items-center gap-4 mb-2">
        <label class="font-semibold w-24">Amount</label>
        <InputText v-model="TopUpPackage.amount" class="flex-auto" />
      </div>
      <!-- Unit -->
      <div class="flex items-center gap-4 mb-2">
        <label class="font-semibold w-24">Unit</label>
        <InputText v-model="TopUpPackage.Unit" class="flex-auto" />
      </div>
       
      <!-- <div class="flex items-center gap-2">
        <Checkbox v-model="TopUpPackage.best_seller" inputId="ingredient2" />
        <label for="ingredient2">Is Best Seller</label>
      </div> -->
      <div class="flex items-center gap-2 mb-3">
        <Checkbox
          v-model="TopUpPackage.best_seller"
          :binary="true"
          inputId="bestSeller"
        />
        <label for="bestSeller">Is Best Seller</label>
      </div>

      <!-- Discount -->
      <div class="flex items-center gap-4 mb-2">
        <label class="font-semibold w-24">Discount</label>
        <InputText v-model="TopUpPackage.discount" class="flex-auto" />
      </div>
      <!-- DESCRIPTION -->
      <div class="flex items-center gap-4 mb-8">
        <label class="font-semibold w-24">Description</label>
        <InputText v-model="TopUpPackage.description" class="flex-auto" />
      </div>

      <!-- ACTIONS -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="updateTopUpPackage" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const visible = ref(false)

const props = defineProps({
  topupPackage: Object
})

const TopUpPackage = ref({

  game_id: '',
  name: '',
  amount: '',
  currency: '',
  Unit: '',
  fullprice: '',
  best_seller: false,
  description: '',
  discount: '',
  image: null
})

// Sync with prop
watch(
  () => props.topupPackage,
  (newVal) => {
    if (newVal) {
      TopUpPackage.value.id = newVal.id
      TopUpPackage.value.name = newVal.name
      TopUpPackage.value.game_id = newVal.game_id
      TopUpPackage.value.amount = newVal.amount
      TopUpPackage.value.currency = newVal.currency
      TopUpPackage.value.fullprice = newVal.fullprice
      TopUpPackage.value.best_seller = Boolean(newVal.best_seller) 
      TopUpPackage.value.Unit = newVal.Unit
      TopUpPackage.value.discount = newVal.discount
      TopUpPackage.value.description = newVal.description
      TopUpPackage.value.image = null
      TopUpPackage.value.imagePreview = newVal.image || null
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
    TopUpPackage.value.image = file
    TopUpPackage.value.imagePreview = URL.createObjectURL(file)
  }
}

// Update topupPackage
function updateTopUpPackage() {
  if (!TopUpPackage.value.id) return

  const formData = new FormData()
  formData.append('_method', 'PUT')  // Spoof PUT for Laravel
  formData.append('name', TopUpPackage.value.name)
  formData.append('game_id', TopUpPackage.value.game_id)
  formData.append('amount', TopUpPackage.value.amount)
  formData.append('currency', TopUpPackage.value.currency)
  formData.append('fullprice', TopUpPackage.value.fullprice)
  formData.append('Unit', TopUpPackage.value.Unit)
  formData.append('best_seller', TopUpPackage.value.best_seller ? '1' : '0')
  formData.append('discount', TopUpPackage.value.discount)
  formData.append('description', TopUpPackage.value.description || '')
  if (TopUpPackage.value.image) formData.append('image', TopUpPackage.value.image)

  axios.post(`http://127.0.0.1:8000/api/topupPackage/${TopUpPackage.value.id}`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  }).then((response) => {
    const updated = response.data
    TopUpPackage.value.name = updated.name
    TopUpPackage.value.game_id = updated.game_id
    TopUpPackage.value.amount = updated.amount
    TopUpPackage.value.currency = updated.currency
    TopUpPackage.value.fullprice = updated.fullprice
    TopUpPackage.value.best_seller = updated.best_seller
    TopUpPackage.value.Unit = updated.Unit
    TopUpPackage.value.discount = updated.discount
    TopUpPackage.value.description = updated.description || ''
    TopUpPackage.value.imagePreview = updated.image || null
    TopUpPackage.value.image = null
    window.location.reload()
    visible.value = false
    
  })
}
</script>
