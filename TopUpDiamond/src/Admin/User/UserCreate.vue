<template>
  <div>
    <Button icon="pi pi-plus" label="Add" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Add User" style="width:25rem">
      
      <!-- NAME -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="user.name" class="flex-auto" />
      </div>

        <!-- SYMBOL -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Email</label>
        <InputText v-model="user.email" class="flex-auto" />
      </div>

      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Password</label>
        <InputText v-model="user.password" class="flex-auto" />
      </div>

      <!-- ACTIONS -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="AddUser" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const visible = ref(false)

const user = ref({
  name: '',
  email:'',
  password: '',
})
 
async function AddUser() {
  const formData = new FormData()
  formData.append('name', user.value.name)
  formData.append('email', user.value.email)
  formData.append('password', user.value.password)
  

  await axios.post(
    'http://localhost:8000/api/register',
    formData,
    { headers: { 'Content-Type': 'multipart/form-data' } }
  )
  window.location.reload()

  visible.value = false
}
</script>
