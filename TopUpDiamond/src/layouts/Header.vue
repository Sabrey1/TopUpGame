<template >
    <div>
        <div class="card">
        <Toolbar>
            <template #start>
                <Avatar image="https://www.gravatar.com/avatar/05dfd4b41340d09cae045235eb0893c3?d=mp" class="flex items-center justify-center mr-2" size="large" />
            </template>
            <template #end>
                <Avatar label="P" class="mr-2" size="large" shape="circle" />
            </template>
        </Toolbar>
        
    </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Toolbar from 'primevue/toolbar';
import Avatar from 'primevue/avatar';

const items = ref([
    {
        label: 'Update',
        icon: 'pi pi-refresh'
    },
    {
        label: 'Delete',
        icon: 'pi pi-times'
    }
])
</script>