<template>
  <div>
    <Button icon="pi pi-plus" label="Add" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Add Top Up Package" style="width:35rem">
      
      <!-- Name -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="TopUpPackage.name" class="flex-auto" />
      </div>

      <!-- <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Game</label>
        <InputText v-model="TopUpPackage.game_id" class="flex-auto" />
      </div> -->

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

      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Full Price</label>
        <InputText v-model="TopUpPackage.fullprice" class="flex-auto" />
      </div>
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Currency</label>
        <!-- <InputText v-model="TopUpPackage.currency" class="flex-auto" /> -->
         <Select
          v-model="TopUpPackage.currency_id"
          :options="currencyOptions"
          optionLabel="label"
          optionValue="value"
          placeholder="Select a Currency"
          class="w-full md:w-56"
        />
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
        <!-- <InputText v-model="TopUpPackage.Unit" class="flex-auto" /> -->
          <Select
          v-model="TopUpPackage.unit_id"
          :options="unitOptions"
          optionLabel="label"
          optionValue="value"
          placeholder="Select a Unit"
          class="w-full md:w-56"
        />
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
      <div class="flex items-center gap-4 mb-4">
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
import { ref,onMounted ,computed} from 'vue'
import axios from 'axios'

const visible = ref(false)

const TopUpPackage = ref({

  game_id: null,
  name: '',
  amount: '',
  currency_id: null,
  unit_id: '',
  fullprice: '',
  best_seller: false,
  description: '',
  discount: '',
  image: null
})


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


function onSelect(e) {
  TopUpPackage.value.image = e.files[0]
}

async function AddTopUpPackage() {
  const formData = new FormData()
  formData.append('game_id', TopUpPackage.value.game_id)
  formData.append('name', TopUpPackage.value.name)
  formData.append('fullprice', TopUpPackage.value.fullprice)
  formData.append('currency_id', TopUpPackage.value.currency_id)
  formData.append('amount', TopUpPackage.value.amount)
  formData.append('unit_id', TopUpPackage.value.unit_id)
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

onMounted(() => {
  loadGames();
  loadCurrency();
  loadUnit();
})

const gameOptions = computed(() =>
  games.value.map(game => ({
    label: game.name,
    value: game.id,
  }))
)
const currencyOptions = computed(() =>
  currency.value.map(currency => ({
    label: currency.symbol,
    value: currency.id,
  }))
)
const unitOptions = computed(() =>
  unit.value.map(unit => ({
    label: unit.name,
    value: unit.id,
  }))
)

</script>
