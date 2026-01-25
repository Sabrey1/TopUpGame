<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <Button icon="pi pi-plus" label="Add "></Button>
            </div>
            <div class="card">
            <DataTable :value="order" :loading="loading" tableStyle="min-width: 50rem">
                
                <Column field="order_code" header="Order Code"></Column>
                <Column field="player_id" header="Player ID">
                    {{ slotProps.data.player_id }}   
                </Column>
                <Column field="server_id" header="Server ID">
                    {{ slotProps.data.server_id }}   
                </Column>
                <Column field="price" header="Price">
                    {{ slotProps.data.price }}   
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

const loading = ref(true);

const order = ref([]);
async function getData(){
     loading.value = true;
    
    const res = await axios.get('http://localhost:8000/api/order')
    if(res.data){
        order.value = res.data;
       
    }
     loading.value = false;
}

onMounted(()=>{
getData();

})
</script>