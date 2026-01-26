<template>
    <div>
        <Button icon="pi pi-eye" label="View" class="p-button-warning" @click="visible = true" ></Button>
        <Dialog v-model:visible="visible" modal header="View Coursel Detail" :style="{ width: '25rem' }">
            <div>
                <div class="flex justify-content-center mb-2">
                    <Avatar :image="coursel.image" class="mr-2" size="xlarge" shape="circle" />
                </div>
                <p class="m-0 text-center font-bold">{{ coursel.title }}</p>
                <p class="m-0">Description: {{ coursel.description }}</p>
                <p class="m-0">Created: {{ dayjs(coursel.created_at).format('DD-MM-YYYY') }}</p>
                <p class="m-0">Updated: {{ dayjs(coursel.updated_at).format('DD-MM-YYYY') }}</p>
            </div>
            <div class="flex gap-2 mt-3 justify-content-end">
                <Button type="button" label="Cancel" severity="danger" @click="visible = false"></Button>
            </div>
        </Dialog>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Dialog from 'primevue/dialog';
import dayjs from 'dayjs';
 

const visible = ref(false);


const prop = defineProps({
    coursel: Object
})


</script>