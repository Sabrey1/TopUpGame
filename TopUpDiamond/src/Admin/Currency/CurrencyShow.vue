<template>
    <div>
        <Button icon="pi pi-eye" label="View" class="p-button-warning" @click="visible = true" ></Button>
        <Dialog v-model:visible="visible" modal header="View Currency Detail" :style="{ width: '25rem' }">
            <div>
                <div class="flex justify-content-center mb-2">
                    <Avatar :image="currency.image" class="mr-2" size="xlarge" shape="circle" />
                </div>
                <p class="m-0 text-center font-bold">{{ currency.name }}</p>
                <p class="m-0">Description: {{ currency.note }}</p>
                <p class="m-0">Symbol: {{ currency.symbol }}</p>    
                <p class="m-0">Presition: {{ currency.presition }}</p>
                <p class="m-0">Created: {{ dayjs(currency.created_at).format('DD-MM-YYYY') }}</p>
                <p class="m-0">Updated: {{ dayjs(currency.updated_at).format('DD-MM-YYYY') }}</p>
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
    currency: Object
})


</script>