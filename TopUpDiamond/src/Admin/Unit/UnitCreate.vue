<template>
  <div>
    <Button icon="pi pi-plus" label="Add" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Add Unit" style="width:25rem">
      
      <!-- NAME -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="Unit.name" class="flex-auto" />
      </div>

     

        <!-- SYMBOL -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Note</label>
        <InputText v-model="Unit.note" class="flex-auto" />
      </div>

    
   
      <!-- ACTIONS -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="AddUnit" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const visible = ref(false)

const Unit = ref({
  name: '',
  note: '',
  
})
 
async function AddUnit() {
  const formData = new FormData()
  formData.append('name', Unit.value.name)
  formData.append('note', Unit.value.note)
  

  await axios.post(
    'http://localhost:8000/api/unit',
    formData,
    { headers: { 'Content-Type': 'multipart/form-data' } }
  )
  window.location.reload()

  visible.value = false
}
</script>
