<template>
  <div>
    <Button icon="pi pi-pencil" label="Edit" @click="openDialog" />

    <Dialog v-model:visible="visible" modal header="Edit Coursel" style="width:25rem">

      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Title</label>
        <InputText v-model="Coursel.title" class="flex-auto" />
      </div>

      <div class="mb-4">
        <label class="font-semibold w-24 block mb-1">Image</label>

        <img
          v-if="Coursel.imagePreview"
          :src="Coursel.imagePreview"
          alt="Preview"
          class="mb-2 rounded border"
          style="max-width: 100%; height: auto;"
        />

        <FileUpload
          mode="basic"
          accept="image/*"
          :maxFileSize="1000000"
          @select="onSelect"
        />
      </div>

      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Description</label>
        <InputText v-model="Coursel.description" class="flex-auto" />
      </div>

      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="updateCoursel" />
      </div>
    </Dialog>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const visible = ref(false)
const props = defineProps({
  coursel: Object
})


const Coursel = ref({
  id: null,
  title: '',
  description: '',
  image: null,
  imagePreview: null,
})

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

function onSelect(event) {
  const file = event.files[0]
  if (file) {
    Coursel.value.image = file
    Coursel.value.imagePreview = URL.createObjectURL(file)
  }
}

function updateCoursel() {
  if (!Coursel.value.id) return

  const formData = new FormData()
  formData.append('_method', 'PUT')
  formData.append('title', Coursel.value.title)
  formData.append('description', Coursel.value.description || '')
  if (Coursel.value.image) formData.append('image', Coursel.value.image)

  app.postApi(`panel_coursel/${Coursel.value.id}`, formData, {
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
