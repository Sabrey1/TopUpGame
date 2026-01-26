<template>
  <div>
    <!-- Edit Button -->
    <Button icon="pi pi-pencil" label="Edit" @click="openDialog" />

    <!-- Edit Dialog -->
    <Dialog v-model:visible="visible" modal header="Edit Coursel" style="width:25rem">

      <!-- Title -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Title</label>
        <InputText v-model="Coursel.title" class="flex-auto" />
      </div>

      <!-- Image Upload / Preview -->
      <div class="mb-4">
        <label class="font-semibold w-24 block mb-1">Image</label>

        <!-- Preview current image -->
        <img
          v-if="Coursel.imagePreview"
          :src="Coursel.imagePreview"
          alt="Preview"
          class="mb-2 rounded border"
          style="max-width: 100%; height: auto;"
        />

        <!-- File upload -->
        <FileUpload
          mode="basic"
          accept="image/*"
          :maxFileSize="1000000"
          @select="onSelect"
        />
      </div>

      <!-- Description -->
      <div class="flex items-center gap-4 mb-8">
        <label class="font-semibold w-24">Description</label>
        <InputText v-model="Coursel.description" class="flex-auto" />
      </div>

      <!-- Actions -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="updateCoursel" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const visible = ref(false)

const props = defineProps({
  coursel: Object
})

// Local reactive copy for editing
const Coursel = ref({
  id: null,
  title: '',
  description: '',
  image: null,          // File object
  imagePreview: null,   // URL for display
})

// Sync with prop
watch(
  () => props.coursel,
  (newVal) => {
    if (newVal) {
      Coursel.value.id = newVal.id
      Coursel.value.title = newVal.title
      Coursel.value.description = newVal.description
      Coursel.value.image = null
      Coursel.value.imagePreview = newVal.image || null
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
    Coursel.value.image = file
    Coursel.value.imagePreview = URL.createObjectURL(file)
  }
}

// Update coursel
function updateCoursel() {
  if (!Coursel.value.id) return

  const formData = new FormData()
  formData.append('_method', 'PUT')  // Spoof PUT for Laravel
  formData.append('title', Coursel.value.title)
  formData.append('description', Coursel.value.description || '')
  if (Coursel.value.image) formData.append('image', Coursel.value.image)

  axios.post(`http://localhost:8000/api/panel_coursel/${Coursel.value.id}`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  }).then((response) => {
    const updated = response.data.coursel
    Coursel.value.title = updated.title
    Coursel.value.description = updated.description
    Coursel.value.imagePreview = updated.image || null
    Coursel.value.image = null
    window.location.reload()
    visible.value = false
    
  })
}
</script>
