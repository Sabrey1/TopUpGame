<template>
    <div>
        <Button icon="pi pi-eye" label="View" class="p-button-warning" @click="visible = true" ></Button>
        <Dialog v-model:visible="visible" modal header="View User Detail" :style="{ width: '25rem' }">
            <div>
                <p class="m-0 text-center font-bold">{{ user.name }}</p>
                <p class="m-0">Email: {{ user.email }}</p>
                <p class="m-0">Created: {{ dayjs(user.created_at).format('DD-MM-YYYY') }}</p>
                <p class="m-0">Updated: {{ dayjs(user.updated_at).format('DD-MM-YYYY') }}</p>
            </div>
            <div class="flex gap-2 mt-3 justify-content-end">
                <Button type="button" label="Cancel" severity="danger" @click="visible = false"></Button>
            </div>
        </Dialog>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import dayjs from 'dayjs';

const visible = ref(false);

const prop = defineProps({
    user: Object
})


</script>