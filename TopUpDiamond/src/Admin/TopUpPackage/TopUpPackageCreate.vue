<template>
  <div>
    <Button icon="pi pi-plus" label="Add" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Add Top Up Package" style="width:25rem">
      
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
       
      <div class="flex items-center gap-2">
        <Checkbox v-model="TopUpPackage.best_seller" inputId="ingredient2" name="best_seller" value="best_seller"/>
        <label for="ingredient2">Is Best Seller</label>
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
        <Button label="Save" @click="AddTopUpPackage" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const visible = ref(false)

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

function onSelect(e) {
  TopUpPackage.value.image = e.files[0]
}

async function AddTopUpPackage() {
  const formData = new FormData()
  formData.append('game_id', TopUpPackage.value.game_id)
  formData.append('name', TopUpPackage.value.name)
  formData.append('fullprice', TopUpPackage.value.fullprice)
  formData.append('currency', TopUpPackage.value.currency)
  formData.append('amount', TopUpPackage.value.amount)
  formData.append('Unit', TopUpPackage.value.Unit)
  formData.append('best_seller', TopUpPackage.value.best_seller ? 1 : 0)
  formData.append('discount', TopUpPackage.value.discount)
  formData.append('description', TopUpPackage.value.description)
  formData.append('image', TopUpPackage.value.image)

  await axios.post(
    'http://localhost:8000/api/topupPackage',
    formData,
    { headers: { 'Content-Type': 'multipart/form-data' } }
  )
  window.location.reload()

  visible.value = false
}

</script>
