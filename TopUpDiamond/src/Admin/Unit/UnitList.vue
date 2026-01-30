<template>
    <sidebar>
        <div>
            <div class="flex justify-content-end">
                <UnitCreate />
            </div>
            <div class="card">
            <DataTable :value="unit" :loading="loading" tableStyle="min-width: 50rem">
                <Column  header="No" style="width: 80px">
                    <template #body="slotProps">
                        {{ slotProps.index + 1 }}
                    </template>
                </Column>
                <Column field="name" header="Name" style="width: 200px"></Column>
                <Column field="note" header="Note"></Column>
                <Column  header="Date">
                    <template #body="slotProps">
                        {{ dayjs(slotProps.data.created_at).format('MM/DD/YYYY') }}
                    </template>
                </Column>
                
                <Column header="Action" style="width: 320px;">
                    <template #body="slotProps">
                        <div class="flex gap-2"> 
                            <UnitShow :unit="slotProps.data" />
                            <UnitEdit :unit="slotProps.data" />
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
import UnitCreate from '@/Admin/Unit/UnitCreate.vue'
import UnitShow from '@/Admin/Unit/UnitShow.vue'
import UnitEdit from '@/Admin/Unit/UnitEdit.vue'



const loading = ref(true);

const unit = ref([]);
async function getData(){
     loading.value = true;
    
    const res = await app.getApi('unit')
    if(res.data){
        unit.value = res.data;
        
    }
     loading.value = false;
}

function onDelete(id){
    const onComfirm =  window.confirm('Are you sure you want to delete this item?');
    if(!onComfirm)return

    const res = app.deleteApi(`unit/${id}`).then(res=>{
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
