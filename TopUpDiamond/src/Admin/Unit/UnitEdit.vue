<template>
  <div>
    <Button icon="pi pi-pencil" label="Edit" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Edit Unit" style="width:25rem">
      
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
        <Button label="Save" @click="updateUnit" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const visible = ref(false)

const props = defineProps({
  unit: Object
})

const Unit = ref({
  name: '',
  note: '',
 
})
// Sync with prop
watch(
  () => props.unit,
  (newVal) => {
    if (newVal) {
      Unit.value.id = newVal.id
      Unit.value.name = newVal.name
      Unit.value.note = newVal.note

    }
  },
  { immediate: true }
)

function openDialog() {
  visible.value = true
}
 

// Update unit
function updateUnit() {
  if (!Unit.value.id) return

  const formData = new FormData()
  formData.append('_method', 'PUT')  // Spoof PUT for Laravel
  formData.append('name', Unit.value.name || '')
  formData.append('note', Unit.value.note || '')

  axios.post(`http://localhost:8000/api/unit/${Unit.value.id}`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  }).then((response) => {
    const updated = response.data
    Unit.value.name = updated.name
    Unit.value.note = updated.note
    window.location.reload()
    visible.value = false
    
  })
}
</script>
