<template>
  <div>
    <Button icon="pi pi-plus" label="Add" @click="visible = true" />

    <Dialog v-model:visible="visible" modal header="Add Game" style="width:25rem">
      
      <!-- TITLE -->
      <div class="flex items-center gap-4 mb-4">
        <label class="font-semibold w-24">Name</label>
        <InputText v-model="Game.name" class="flex-auto" />
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

      <!-- slug -->
      <div class="flex items-center gap-4 mb-8">
        <label class="font-semibold w-24">Slug</label>
        <InputText v-model="Game.slug" class="flex-auto" />
      </div>

      <div class="flex items-center gap-2">
        <Checkbox v-model="Game.is_popular" inputId="ingredient1" name="is_popular" value="is_popular"  />
        <label for="ingredient1"> Is Popular </label>
      </div>

      <div class="flex items-center gap-2">
        <Checkbox v-model="Game.is_new" inputId="ingredient2" name="is_new" value="is_new"/>
        <label for="ingredient2"> Is New </label>
      </div>

      <div class="flex items-center gap-2">
        <Checkbox v-model="Game.is_active" inputId="ingredient3" name="is_active" value="is_active"   />
        <label for="ingredient3"> Is Active </label>
      </div>

      <!-- ACTIONS -->
      <div class="flex justify-end gap-2">
        <Button label="Cancel" severity="secondary" @click="visible=false" />
        <Button label="Save" @click="AddGame" />
      </div>

    </Dialog>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const visible = ref(false)

const Game = ref({
  name: '',
  slug:'',
  is_popular:'',
  is_new:'',
  is_active:'',
  // description: '',
  image: null
})

function onSelect(e) {
  Game.value.image = e.files[0]
}

async function AddGame() {
  const formData = new FormData()
  formData.append('name', Game.value.name)
  formData.append('slug', Game.value.slug)
  formData.append('is_popular', Game.value.is_popular)
  formData.append('is_new', Game.value.is_new)
  formData.append('is_active', Game.value.is_active)
  formData.append('image', Game.value.image)

  await axios.post(
    'http://localhost:8000/api/game',
    formData,
    { headers: { 'Content-Type': 'multipart/form-data' } }
  )
  window.location.reload()

  visible.value = false
}
</script>
