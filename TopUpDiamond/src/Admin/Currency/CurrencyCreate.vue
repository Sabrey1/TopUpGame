<template>
  <div>
    <Button icon="pi pi-plus" label="Add" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Add Currency" style="width:25rem">
      
      <!-- NAME -->
      <div class=" mb-3">
        <div class="mb-2">
          <label class="font-semibold w-24">Name</label>
        </div>
        <InputText v-model="Currency.name" class="flex-auto" fluid/>
      </div>

      <!-- IMAGE -->
      <div class="mb-3">
        <FileUpload
          mode="basic"
          accept="image/*"
          :maxFileSize="1000000"
          @select="onSelect"
        />
      </div>

      <div class=" mb-3">
        <div class="mb-2">
          <label class="font-semibold w-24 ">Symbol</label>
        </div>
        
        <Select
          v-model="Currency.symbol"
          :options="symbols"
          optionLabel="name"
          optionValue="name"
          placeholder="Select a City"
          class="w-full md:w-56"
        />
      </div>

        <!-- PRESITION -->
      <div class=" mb-3">
        <div class="mb-2">
          <label class="font-semibold w-24">Presition</label>
        </div>
        
        <InputText v-model="Currency.presition" class="flex-auto" fluid />
      </div>

      <!-- Note -->
      <div class="mb-4">
        <div class="mb-2">
            <label class="font-semibold w-24">Note</label>
        </div>
        
        <InputText v-model="Currency.note" class="flex-auto" fluid />
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
const visible = ref(false)
const symbols = ref([
    { name: '$' },
    { name: '៛'},
    { name: '฿' },
    { name: '¥' },
    { name: '€', }
]);

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

  await app.postApi(
    'currency',
    formData,
    { headers: { 'Content-Type': 'multipart/form-data' } }
  )
  window.location.reload()
  visible.value = false
}
</script>
