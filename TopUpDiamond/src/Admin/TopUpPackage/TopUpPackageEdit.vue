<template>
  <div>
    <Button icon="pi pi-pencil" label="Edit" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Edit Top Up Package" style="width:35rem">

      <!-- Name -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="TopUpPackage.name" class="flex-auto" />
      </div>

      <!-- Game -->
      <div class="flex gap-4 mb-4">
        <label class="font-semibold w-24 block mb-1">Game</label>
        <Select
          v-model="TopUpPackage.game_id"
          :options="gameOptions"
          optionLabel="label"
          optionValue="value"
          placeholder="Select a Game"
          class="w-full md:w-56"
        />
      </div>

      <!-- Full Price -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Full Price</label>
        <InputText v-model="TopUpPackage.fullprice" class="flex-auto" />
      </div>

      <!-- Currency -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Currency</label>
        <Select
          v-model="TopUpPackage.currency_id"
          :options="currencyOptions"
          optionLabel="label"
          optionValue="value"
          placeholder="Select a Currency"
          class="w-full md:w-56"
        />
      </div>

      <!-- Image Upload -->
      <div class="mb-4">
        <FileUpload
          mode="basic"
          accept="image/*"
          :maxFileSize="1000000"
          @select="onSelect"
        />
        <div v-if="TopUpPackage.imagePreview" class="mt-2">
          <img :src="TopUpPackage.imagePreview" class="w-32 h-32 object-cover rounded" />
        </div>
      </div>

      <!-- Amount -->
      <div class="flex items-center gap-4 mb-2">
        <label class="font-semibold w-24">Amount</label>
        <InputText v-model="TopUpPackage.amount" class="flex-auto" />
      </div>

      <!-- Unit -->
      <div class="flex items-center gap-4 mb-2">
        <label class="font-semibold w-24">Unit</label>
        <Select
          v-model="TopUpPackage.unit_id"
          :options="unitOptions"
          optionLabel="label"
          optionValue="value"
          placeholder="Select a Unit"
          class="w-full md:w-56"
        />
      </div>

      <!-- Best Seller -->
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

      <!-- Description -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Description</label>
        <InputText v-model="TopUpPackage.description" class="flex-auto" />
      </div>

      <!-- Actions -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="updateTopUpPackage" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref, watch, onMounted, computed } from 'vue'
import axios from 'axios'

const visible = ref(false)

const props = defineProps({
  topupPackage: Object
})

const TopUpPackage = ref({
  id: null,
  game_id: null,
  name: '',
  amount: '',
  currency_id: null,
  unit_id: null,
  fullprice: '',
  best_seller: false,
  description: '',
  discount: '',
  image: null,
  imagePreview: null
})

// Options
const games = ref([])
const currency = ref([])
const unit = ref([])

const loadGames = async () => {
  const res = await axios.get('http://localhost:8000/api/game')
  games.value = res.data
}
const loadCurrency = async () => {
  const res = await axios.get('http://127.0.0.1:8000/api/currency')
  currency.value = res.data
}
const loadUnit = async () => {
  const res = await axios.get('http://127.0.0.1:8000/api/unit')
  unit.value = res.data
}

onMounted(() => {
  loadGames()
  loadCurrency()
  loadUnit()
})

const gameOptions = computed(() =>
  games.value.map(game => ({ label: game.name, value: game.id }))
)
const currencyOptions = computed(() =>
  currency.value.map(c => ({ label: c.symbol, value: c.id }))
)
const unitOptions = computed(() =>
  unit.value.map(u => ({ label: u.name, value: u.id }))
)

// Sync props to local state
watch(
  () => props.topupPackage,
  (newVal) => {
    if (newVal) {
      TopUpPackage.value.id = newVal.id
      TopUpPackage.value.name = newVal.name
      TopUpPackage.value.game_id = newVal.game_id
      TopUpPackage.value.amount = newVal.amount
      TopUpPackage.value.currency_id = newVal.currency_id || newVal.currency
      TopUpPackage.value.unit_id = newVal.unit_id || newVal.Unit
      TopUpPackage.value.fullprice = newVal.fullprice
      TopUpPackage.value.best_seller = Boolean(newVal.best_seller)
      TopUpPackage.value.discount = newVal.discount
      TopUpPackage.value.description = newVal.description
      TopUpPackage.value.image = null
      TopUpPackage.value.imagePreview = newVal.image || null
    }
  },
  { immediate: true }
)

// Handle image selection
function onSelect(e) {
  const file = e.files[0]
  if (file) {
    TopUpPackage.value.image = file
    TopUpPackage.value.imagePreview = URL.createObjectURL(file)
  }
}

// Update Top Up Package
async function updateTopUpPackage() {
  if (!TopUpPackage.value.id) return

  const formData = new FormData()
  formData.append('_method', 'PUT')
  formData.append('game_id', TopUpPackage.value.game_id)
  formData.append('name', TopUpPackage.value.name)
  formData.append('fullprice', TopUpPackage.value.fullprice)
  formData.append('currency_id', TopUpPackage.value.currency_id)
  formData.append('amount', TopUpPackage.value.amount)
  formData.append('unit_id', TopUpPackage.value.unit_id)
  formData.append('best_seller', TopUpPackage.value.best_seller ? 1 : 0)
  formData.append('discount', TopUpPackage.value.discount)
  formData.append('description', TopUpPackage.value.description)
  if (TopUpPackage.value.image) formData.append('image', TopUpPackage.value.image)

  try {
    await axios.post(
      `http://localhost:8000/api/topupPackage/${TopUpPackage.value.id}`,
      formData,
      { headers: { 'Content-Type': 'multipart/form-data' } }
    )
    visible.value = false
    window.location.reload()
  } catch (error) {
    console.error('Update failed', error)
  }
}
</script>
