<template>
    <div>
        <Button icon="pi pi-eye" label="View" class="p-button-warning" @click="visible = true" ></Button>
        <Dialog v-model:visible="visible" modal header="View Coursel Detail" :style="{ width: '25rem' }">
            <div>
                <div class="flex gap-2 mb-3">
                    <Chip v-if="topupPackage.best_seller">
                        {{ topupPackage.best_seller ? 'Best Seller' : '' }}
                    </Chip>
                    <Chip v-if="topupPackage.discount">
                        {{ topupPackage.discount }}
                    </Chip>
                </div>
                <div class="flex justify-content-center mb-2">
                    <Avatar :image="topupPackage.image" class="mr-2" size="xlarge" shape="circle" />
                </div>
                <p class="m-0 text-center font-bold">{{ topupPackage.name }}</p>
                <p class="m-0">Game: {{ topupPackage.game_name }}</p>
                 <p class="m-0" v-if="topupPackage.fullprice">Price: {{ topupPackage.fullprice }} {{ topupPackage.currency }}</p>
                <p class="m-0">Amount: {{ topupPackage.amount }} {{ topupPackage.Unit }}</p>
               
                <p class="m-0">Description: {{ topupPackage.description }}</p>
                <p class="m-0">Created: {{ dayjs(topupPackage.created_at).format('DD-MM-YYYY') }}</p>
                <p class="m-0">Updated: {{ dayjs(topupPackage.updated_at).format('DD-MM-YYYY') }}</p>
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
    topupPackage: Object
})


</script>