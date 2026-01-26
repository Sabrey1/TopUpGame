<template>
    <div>
       
        <Button icon="pi pi-eye" label="View" class="p-button-warning" @click="visible = true" ></Button>
        <Dialog v-model:visible="visible" modal header="View game Detail" :style="{ width: '25rem' }">
            
            <div>
                <div class="flex gap-2 mb-3">
                    <Chip>
                        {{ game.is_active ? 'Active' : 'Inactive' }}
                    </Chip>
                    <Chip v-if="game.is_popular > 0">
                        {{ game.is_popular ? 'Popular' : 'Not Popular' }}
                    </Chip>
                    <Chip v-if="game.is_new > 0">
                        {{ game.is_new ? 'New' : 'Not New' }}
                    </Chip>
                </div>
                
                <!-- {{ game }} -->
                <div class="flex justify-content-center mb-2">
                    <Avatar :image="game.image" class="mr-2" size="xlarge" shape="circle" />
                </div>
                <p class="m-0 text-center font-bold">{{ game.name }}</p>
                <p class="m-0">Slug: {{ game.slug }}</p>
                <p class="m-0">Description: {{ game.description }} sss</p>
                
                <p class="m-0">Created: {{ dayjs(game.created_at).format('DD-MM-YYYY') }}</p>
                <p class="m-0">Updated: {{ dayjs(game.updated_at).format('DD-MM-YYYY') }}</p>
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
    game: Object
})


</script>