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

      <!-- Image Upload -->
      <div class="mb-4">
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

// Reactive local copy for editing
const Coursel = ref({
  id: null,
  title: '',
  description: '',
  image: null
})

// Keep local copy in sync with prop
watch(
  () => props.coursel,
  (newVal) => {
    if (newVal) {
      Coursel.value.id = newVal.id
      Coursel.value.title = newVal.title
      Coursel.value.description = newVal.description
      Coursel.value.image = null
    }
  },
  { immediate: true }
)

function openDialog() {
  visible.value = true
}

// Handle image selection
function onSelect(e) {
  Coursel.value.image = e.files[0]
}

// Update coursel
async function updateCoursel() {
  if (!Coursel.value.id) return

  const formData = new FormData()
  formData.append('title', Coursel.value.title)
  formData.append('description', Coursel.value.description)
  if (Coursel.value.image) formData.append('image', Coursel.value.image)

  try {
    await axios.put(
      `http://localhost:8000/api/panel_coursel/${Coursel.value.id}`,
      formData,
      { headers: { 'Content-Type': 'multipart/form-data' } }
    )
    visible.value = false
  } catch (error) {
    console.error('Update failed:', error)
  }
}
</script>
