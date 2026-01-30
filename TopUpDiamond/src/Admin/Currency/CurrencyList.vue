<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <CurrencyCreate />
            </div>
            <div class="card">
            <DataTable :value="currency" :loading="loading" tableStyle="min-width: 50rem">
                <Column  header="No" style="width: 80px">
                    <template #body="slotProps">
                        {{ slotProps.index + 1 }}
                    </template>
                </Column>
                <Column field="name" header="Name" style="width: 200px"></Column>
                <Column  header="Image" style="width: 200px">
                    <template #body="slotProps">
                        <Avatar :image="slotProps.data.image" class="mr-2" size="xlarge" shape="circle" />
                    </template>
                </Column>
                <Column field="symbol" header="Symbol" style="width: 200px"></Column>
                <Column field="note" header="Note"></Column>
                <Column field="created_at" header="Date">
                    <template #body="slotProps">
                        {{ dayjs(slotProps.data.created_at).format('MM/DD/YYYY') }}
                    </template>
                </Column>
                
                <Column header="Action" style="width: 320px;">
                    <template #body="slotProps">
                        <div class="flex gap-2"> 
                            <CurrencyShow :currency="slotProps.data" />
                            <CurrencyEdit :currency="slotProps.data" />
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
import CurrencyCreate from '@/Admin/Currency/CurrencyCreate.vue'
import CurrencyShow from '@/Admin/Currency/CurrencyShow.vue'
import CurrencyEdit from '@/Admin/Currency/CurrencyEdit.vue'
import dayjs from 'dayjs';

const loading = ref(true);

const currency = ref([]);
async function getData(){
     loading.value = true;
    
    const res = await app.getApi('currency')
    if(res.data){
        currency.value = res.data;
        
    }
     loading.value = false;
}

function onDelete(id){
    const onComfirm =  window.confirm('Are you sure you want to delete this item?');
    if(!onComfirm)return

    const res = app.deleteApi(`currency/${id}`).then(res=>{
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