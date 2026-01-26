<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <CourselCreate />
            </div>
            
            <div class="card">
            <DataTable :value="coursels" :loading="loading" tableStyle="min-width: 50rem">
                <Column  header="No">
                    <template #body="slotProps">
                        {{ slotProps.index + 1 }}
                    </template>
                </Column>
                <Column field="title" header="Title"></Column>
                <Column  header="Image">
                    <template #body="slotProps">
                        <Avatar :image="slotProps.data.image" class="mr-2" size="xlarge" shape="circle" />
                    </template>
                </Column>
                <Column field="description" header="Description"></Column>
                <Column header="Action">
                    <template #body="slotProps">
                        <div class="flex gap-2"> 
                            <CourselShow :coursel="slotProps.data" />
                            <CourselEdit :coursel="slotProps.data" />
                            <Button icon="pi pi-times" label="Delete" class="p-button-danger" @click="onDelete"></Button>
                           
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
import CourselCreate from '@/Admin/CourselList/CourselCreate.vue'
import CourselShow from '@/Admin/CourselList/CourselShow.vue'
import CourselEdit from '@/Admin/CourselList/CourselEdit.vue'

const loading = ref(true);

const coursels = ref([]);
async function getData(){
     loading.value = true;
    
    const res = await axios.get('http://localhost:8000/api/panel_coursel')
    if(res.data){
        coursels.value = res.data;
       
    }
     loading.value = false;
}

function onDelete(){
    alert('Delete');
}


onMounted(()=>{
getData();

})
</script>