<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <Button icon="pi pi-plus" label="Add "></Button>
            </div>
            <div class="card">
            <DataTable :value="payments" :loading="loading" tableStyle="min-width: 50rem">
                
                <Column field="order_code" header="Order Code"></Column>
                <Column field="package_name" header="Game">
                    {{ slotProps.data.package_name }}   
                </Column>
                <Column field="amount" header="Amount">
                    <template #body="slotProps">
                        <Currency :value="slotProps.data.amount"></Currency>
                    </template>
                </Column>
                <Column field="paid_at" header="Date">
                    <template #body="slotProps">
                        {{ $dayjs(slotProps.data.paid_at).format('MM/DD/YYYY') }}
                    </template> 
                </Column>
                <Column field="status" header="Status">
                    <template #body="slotProps">
                        <ComStatus :label="slotProps.data.status"></ComStatus>
                    </template> 
                </Column>

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
import ComStatus from '../../layouts/ComStatus.vue';


const loading = ref(true);

const payments = ref([]);
async function getData(){
     loading.value = true;
    
    const res = await axios.get('http://localhost:8000/api/payments');
    if(res.data){
        payments.value = res.data;
       
    }
     loading.value = false;
}

onMounted(()=>{
getData();

})
</script>