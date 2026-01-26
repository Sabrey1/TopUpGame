<template>
  <div>
    <!-- Edit Button -->
    <Button icon="pi pi-pencil" label="Edit" @click="openDialog" />

    <!-- Edit Dialog -->
    <Dialog v-model:visible="visible" modal header="Edit Game" style="width:25rem">
      <!-- Name -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="Game.name" class="flex-auto" />
      </div>

      <!-- Image Upload / Preview -->
      <div class="mb-4">
        <label class="font-semibold w-24 block mb-1">Image</label>

        <!-- Preview current image -->
        <img
          v-if="Game.imagePreview"
          :src="Game.imagePreview"
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

      <!-- Slug -->
      <div class="flex items-center gap-4 mb-8">
        <label class="font-semibold w-24">Slug</label>
        <InputText v-model="Game.slug" class="flex-auto" />
      </div>

      <div class="flex items-center gap-2 mb-2">
        <Checkbox v-model="Game.is_popular" binary inputId="ingredient1" name="is_popular" />
        <label for="ingredient1"> Is Popular </label>
      </div>

      <div class="flex items-center gap-2 mb-2">
        <Checkbox v-model="Game.is_new" binary inputId="ingredient2" name="is_new" />
        <label for="ingredient2"> Is New </label>
      </div>

      <div class="flex items-center gap-2 mb-4">
        <Checkbox v-model="Game.is_active" binary inputId="ingredient3" name="is_active" />
        <label for="ingredient3"> Is Active </label>
      </div>

      <!-- Actions -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="updateGame" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const visible = ref(false)

const props = defineProps({
  game: Object
})

// Local reactive copy for editing
const Game = ref({
  id: null,
  name: '',
  slug: '',
  is_popular: false,
  is_new: false,
  is_active: false,
  image: null,          // File object
  imagePreview: null,   // URL for display
})

// Sync with prop - convert numeric values to booleans
watch(
  () => props.game,
  (newVal) => {
    if (newVal) {
      Game.value.id = newVal.id
      Game.value.name = newVal.name
      Game.value.slug = newVal.slug
      Game.value.is_popular = Boolean(newVal.is_popular)
      Game.value.is_new = Boolean(newVal.is_new)
      Game.value.is_active = Boolean(newVal.is_active)
      Game.value.image = null
      Game.value.imagePreview = newVal.image || null
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
    Game.value.image = file
    Game.value.imagePreview = URL.createObjectURL(file)
  }
}

// Update game
function updateGame() {
  if (!Game.value.id) return

  const formData = new FormData()
  formData.append('_method', 'PUT')  // Spoof PUT for Laravel
  formData.append('name', Game.value.name)
  formData.append('slug', Game.value.slug)
  formData.append('is_popular', Game.value.is_popular ? 1 : 0)
  formData.append('is_new', Game.value.is_new ? 1 : 0)
  formData.append('is_active', Game.value.is_active ? 1 : 0)

  if (Game.value.image) formData.append('image', Game.value.image)

  axios.post(`http://localhost:8000/api/game/${Game.value.id}`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  }).then((response) => {
    const updated = response.data.game
    Game.value.name = updated.name
    Game.value.slug = updated.slug
    Game.value.is_popular = Boolean(updated.is_popular)
    Game.value.is_new = Boolean(updated.is_new)
    Game.value.is_active = Boolean(updated.is_active)
    Game.value.imagePreview = updated.image || null
    Game.value.image = null
    window.location.reload()
    visible.value = false
  }).catch((error) => {
    console.error('Error updating game:', error)
  })
}
</script>