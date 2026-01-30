<template>
  <div>
    <Button icon="pi pi-pencil" label="Edit" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Edit User" style="width:25rem">
      
      <!-- NAME -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="User.name" class="flex-auto" />
      </div>

        <!-- SYMBOL -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Email</label>
        <InputText v-model="User.email" class="flex-auto" />
      </div>

     

      <!-- ACTIONS -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="updateUser" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const visible = ref(false)

const props = defineProps({
  user: Object
})

const User = ref({
  name: '',
  email: '',
  
 
})
// Sync with prop
watch(
  () => props.user,
  (newVal) => {
    if (newVal) {
      User.value.id = newVal.id
      User.value.name = newVal.name
      User.value.email = newVal.email
       

    }
  },
  { immediate: true }
)

function openDialog() {
  visible.value = true
}
 

// Update unit
function updateUser() {
  if (!User.value.id) return

  const formData = new FormData()
  formData.append('_method', 'PUT')  // Spoof PUT for Laravel
  formData.append('name', User.value.name || '')
  formData.append('email', User.value.email || '')
  

  axios.post(`http://localhost:8000/api/user/${User.value.id}`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  }).then((response) => {
    const updated = response.data
    User.value.name = updated.name
    User.value.email = updated.email
     
    window.location.reload()
    visible.value = false
    
  })
}
</script>
