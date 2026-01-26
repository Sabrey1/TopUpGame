<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <CourselCreate />
            </div>
            
            <div class="card">
            <DataTable :value="coursels" :loading="loading" tableStyle="min-width: 50rem">
                <Column  header="No" style="width: 80px">
                    <template #body="slotProps">
                        {{ slotProps.index + 1 }}
                    </template>
                </Column>
                <Column field="title" header="Title" style="width: 200px"></Column>
                <Column  header="Image" style="width: 120px">
                    <template #body="slotProps">
                        <Avatar :image="slotProps.data.image" class="mr-2" size="xlarge" shape="circle" />
                    </template>
                </Column>
                <Column field="description" header="Description"></Column>
                <Column header="Action" style="width: 320px;">
                    <template #body="slotProps">
                        <div class="flex gap-2"> 
                            <CourselShow :coursel="slotProps.data" />
                            <CourselEdit :coursel="slotProps.data" />
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

function onDelete(id){
    const onComfirm =  window.confirm('Are you sure you want to delete this item?');
    if(!onComfirm)return

    const res = axios.delete(`http://localhost:8000/api/panel_coursel/${id}`).then(res=>{
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

<style scoped>
:deep(.p-datatable) {
    table-layout: fixed;
}

:deep(.p-datatable-thead > tr > th) {
    position: sticky;
    top: 0;
    background: white;
    z-index: 1;
}
</style>