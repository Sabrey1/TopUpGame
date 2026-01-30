<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <UserCreate />
            </div>
            
            <div class="card">
                    <DataTable :value="user" :loading="loading" tableStyle="min-width: 50rem">
                        <Column  header="No" style="width: 80px">
                            <template #body="slotProps">
                                {{ slotProps.index + 1 }}
                            </template>
                        </Column>
                        <Column field="name" header="Name" style="width: 200px"></Column>
                        <Column field="email" header="Email"></Column>
                        <Column   header="Date">
                            <template #body="slotProps">
                                {{ dayjs(slotProps.data.created_at).format('MM/DD/YYYY') }}
                            </template>
                        </Column>
                        
                        <Column header="Action" style="width: 320px;">
                            <template #body="slotProps">
                                <div class="flex gap-2"> 
                                    <UserShow :user="slotProps.data" />
                                    <UserEdit :user="slotProps.data" />
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
import dayjs from 'dayjs';

import UserCreate from '@/Admin/User/UserCreate.vue'
import UserShow from '@/Admin/User/UserShow.vue'
import UserEdit from '@/Admin/User/UserEdit.vue'

const loading = ref(true);

const user = ref([]);
async function getData(){
     loading.value = true;
    
    const res = await app.getApi('user')
    if(res.data){
        user.value = res.data; 
    }
     loading.value = false;
}

function onDelete(id){
    const onComfirm =  window.confirm('Are you sure you want to delete this item?');
    if(!onComfirm)return

    const res = app.deleteApi(`user/${id}`).then(res=>{
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
