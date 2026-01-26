<template>
    <div>
        <Button icon="pi pi-plus" label="Add" @click="visible = true"/>
        <Dialog v-model:visible="visible" modal header="Add Coursel" :style="{ width: '25rem' }">
          
            <div class="flex items-center gap-4 mb-4">
                <label for="title" class="font-semibold w-24">Title</label>
                <InputText id="title" class="flex-auto" autocomplete="off" />
            </div>
            <div class="card flex flex-wrap gap-6 items-center justify-between">
                <FileUpload ref="fileupload" mode="basic" name="demo[]" url="/api/upload" accept="image/*" :maxFileSize="1000000" @upload="onUpload" />
                
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="description" class="font-semibold w-24">Description</label>
                <InputText id="description" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="button" label="Save"  @click="AddCoursel"></Button>
            </div>
        </Dialog>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Dialog from 'primevue/dialog';
const visible = ref(false);

function AddCoursel() {
    const res = axios.post('http://localhost:8000/api/panel_coursel', {})
}

</script>