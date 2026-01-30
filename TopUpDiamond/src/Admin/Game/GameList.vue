<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <GameCreate />
            </div>
            <div class="card">
                <DataTable :value="game" :loading="loading" tableStyle="min-width: 50rem">
                    <Column  header="No" style="width: 80px">
                        <template #body="slotProps">
                            {{ slotProps.index + 1 }}
                        </template>
                    </Column>
                    <Column field="name" header="Name" style="width: 350px"></Column>
                    <Column  header="Image" style="width: 150px">
                        <template #body="slotProps">
                            <Avatar :image="slotProps.data.image" class="mr-2" size="xlarge" shape="circle" />
                        </template>
                    </Column>
                    <Column field="description" header="Description">
                        <template #body="slotProps">
                            {{ slotProps.data.description || '-' }}
                        </template>
                    </Column>
                    <Column field="is_active" header="Active" style="width: 300px">
                        <template #body="slotProps">
                            <ComStatus :value="slotProps.data.is_active" trueLabel="Active" falseLabel="Inactive" />
                        </template>
                    </Column>
                    <Column header="Action" style="width: 320px;">
                        <template #body="slotProps">
                            <div class="flex gap-2">
                                <GameShow :game="slotProps.data" />
                                <GameEdit :game="slotProps.data" />
                                <Button icon="pi pi-times" label="Delete" class="p-button-danger" @click="OnDelete(slotProps.data.id)"></Button>
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
import GameEdit from '@/Admin/Game/GameEdit.vue'

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



function OnDelete(id) {
    const onComfirm =  window.confirm('Are you sure you want to delete this item?');
    if(!onComfirm)return

    axios.delete(`http://localhost:8000/api/game/${id}`).then(() => {
        getData();
    });
}

onMounted(()=>{
getData();

})
</script>