<template>
  <div>
    <Button icon="pi pi-plus" label="Add" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Add Coursel" style="width:25rem">
      
      <!-- TITLE -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Title</label>
        <InputText v-model="Coursel.title" class="flex-auto" />
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

      <!-- DESCRIPTION -->
      <div class="flex items-center gap-4 mb-8">
        <label class="font-semibold w-24">Description</label>
        <InputText v-model="Coursel.description" class="flex-auto" />
      </div>

      <!-- ACTIONS -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="AddCoursel" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const visible = ref(false)

const Coursel = ref({
  title: '',
  description: '',
  image: null
})

function onSelect(e) {
  Coursel.value.image = e.files[0]
}

async function AddCoursel() {
  const formData = new FormData()
  formData.append('title', Coursel.value.title)
  formData.append('description', Coursel.value.description)
  formData.append('image', Coursel.value.image)

  await axios.post(
    'http://localhost:8000/api/panel_coursel',
    formData,
    { headers: { 'Content-Type': 'multipart/form-data' } }
  )

  visible.value = false
}
</script>
