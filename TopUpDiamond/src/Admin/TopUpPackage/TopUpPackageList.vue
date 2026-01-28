<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <TopUpPackageCreate />
            </div>
            <div class="card">
                {{ topupPackage }}
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
                            <TopUpPackageShow :topupPackage="slotProps.data" />
                             
                            <Button icon="pi pi-pencil" label="Edit" class="p-button-warning"></Button>
                            <Button icon="pi pi-times" label="Delete" class="p-button-danger" @click="onDelete(slotProps.data.id)"></Button>
                           
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
import TopUpPackageCreate from '@/Admin/TopUpPackage/TopUpPackageCreate.vue'
import TopUpPackageShow from '@/Admin/TopUpPackage/TopUpPackageShow.vue'

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

function onDelete(id){
    const onConform =  window.confirm('Are you sure you want to delete this item?');
    if(!onConform)return

   const res = axios.delete(`http://localhost:8000/api/topupPackage/${id}`).then(res=>{
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