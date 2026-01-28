<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <PaymentTypeCreate />
            </div>
            <div class="card">
                <DataTable :value="payment_type" :loading="loading" tableStyle="min-width: 50rem">
                    <Column  header="No" style="width: 80px">
                        <template #body="slotProps">
                            {{ slotProps.index + 1 }}
                        </template>
                    </Column>
                    <Column field="name" header="Name" style="width: 200px"></Column>
                    <Column  header="Image" style="width: 150px">
                        <template #body="slotProps">
                            <Avatar :image="slotProps.data.image" class="mr-2 circle" size="xlarge" shape="circle" />
                        </template>
                    </Column>
                    <Column field="description" header="Description" style="width: 300px">
                        <template #body="slotProps">
                            {{ slotProps.data.description || '-' }}
                        </template>
                    </Column>
                    <Column header="Action" style="width: 320px;">
                        <template #body="slotProps">
                            <div class="flex gap-2"> 
                                <PaymentTypeShow :payment_type="slotProps.data" />
                                <PaymentTypeEdit :payment_type="slotProps.data" />
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

import { ref, onMounted } from 'vue';
import axios from 'axios';
import PaymentTypeCreate from '@/Admin/PaymentType/PaymentTypeCreate.vue'
import PaymentTypeShow from '@/Admin/PaymentType/PaymentTypeShow.vue'
import PaymentTypeEdit from '@/Admin/PaymentType/PaymentTypeEdit.vue'

const loading = ref(true);

const payment_type = ref([]);

async function getData(){
     loading.value = true;
    const res = await axios.get('http://localhost:8000/api/payment_type');
    if(res.data){
        payment_type.value = res.data; 
    }
     loading.value = false;
}

function OnDelete(id) {
    const onComfirm =  window.confirm('Are you sure you want to delete this item?');
    if(!onComfirm)return

    const res = axios.delete(`http://localhost:8000/api/payment_type/${id}`).then(res=>{
        getData();
    })
    if(res.data){
        getData();
    }
    
}

onMounted(()=>{
getData();

})
</script>