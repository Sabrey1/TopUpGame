<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <GameCreate />
            </div>
            <div class="card">
                <DataTable :value="game" :loading="loading" tableStyle="min-width: 50rem">
                    <Column  header="No">
                        <template #body="slotProps">
                            {{ slotProps.index + 1 }}
                        </template>
                    </Column>
                    <Column field="name" header="Name"></Column>
                    <Column  header="Image">
                        <template #body="slotProps">
                            <Avatar :image="slotProps.data.image" class="mr-2" size="xlarge" shape="circle" />
                        </template>
                    </Column>
                    <Column field="description" header="Description">
                        <template #body="slotProps">
                            {{ slotProps.data.description }}ssssssssssss
                        </template>
                    </Column>
                    <Column header="Action">
                        <template #body="slotProps">
                            <div class="flex gap-2">
                                <GameShow :game="slotProps.data" />
                                <Button icon="pi pi-pencil" label="Edit" class="p-button-warning"></Button>
                                <Button icon="pi pi-times" label="Delete" class="p-button-danger"></Button>
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </div>
        </div>
    </sidebar>
</template>

<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Avatar from 'primevue/avatar';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Button from 'primevue/button';
import GameCreate from '@/Admin/Game/GameCreate.vue'
import GameShow from '@/Admin/Game/GameShow.vue'

const loading = ref(true);

const game = ref([]);
async function getData(){
     loading.value = true;
    
    const res = await axios.get('http://localhost:8000/api/game')
    if(res.data){
        game.value = res.data;
       
    }
     loading.value = false;
}

onMounted(()=>{
getData();

})
</script>