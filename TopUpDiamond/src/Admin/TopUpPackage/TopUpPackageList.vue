<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <Button icon="pi pi-plus" label="Add "></Button>
            </div>
            <div class="card">
            <DataTable :value="topupPackage" :loading="loading" tableStyle="min-width: 50rem">

                <Column  header="No">
                    <template #body="slotProps">
                        {{ slotProps.index + 1 }}
                    </template>
                </Column>
                
                <Column field="name" header="Name"></Column>
                <Column  header="Image">
                    <template #body="slotProps">
                        <Avatar :image="slotProps.data.image" class="mr-2 circle" size="xlarge" shape="circle" />
                    </template>
                </Column>
                <Column field="amount" header="Total">
                <template #body="slotProps">
                    {{ slotProps.data.amount }} {{ slotProps.data.Unit }}
                </template></Column>
                <Column field="description" header="Description"></Column>
                <Column header="Action">
                    <template #body="slotProps">
                        <div class="flex gap-2"> 
                            <Button icon="pi pi-eye" label="View" class="p-button-warning"></Button>
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
import Chip from 'primevue/chip';

import dayjs from 'dayjs';


const loading = ref(true);

const topupPackage = ref([]);
async function getData(){
     loading.value = true;
    
    const res = await axios.get('http://localhost:8000/api/topupPackage');
    if(res.data){
        topupPackage.value = res.data;
       
    }
     loading.value = false;
}

onMounted(()=>{
getData();

})
</script>