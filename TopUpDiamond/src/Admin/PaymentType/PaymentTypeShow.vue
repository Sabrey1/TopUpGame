<template>
    <div>
        <Button icon="pi pi-eye" label="View" class="p-button-warning" @click="visible = true" ></Button>
        <Dialog v-model:visible="visible" modal header="View Payment Type Detail" :style="{ width: '25rem' }">
            <div>
                <div class="flex justify-content-center mb-2">
                    <Avatar :image="payment_type.image" class="mr-2" size="xlarge" shape="circle" />
                </div>
                <p class="m-0 text-center font-bold">{{ payment_type.title }}</p>
                <p class="m-0">Description: {{ payment_type.description }}</p>
                <p class="m-0">Created: {{ dayjs(payment_type.created_at).format('DD-MM-YYYY') }}</p>
                <p class="m-0">Updated: {{ dayjs(payment_type.updated_at).format('DD-MM-YYYY') }}</p>
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
    payment_type: Object
})


</script>