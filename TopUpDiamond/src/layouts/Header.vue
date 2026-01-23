<template >
    <div class="fixed top-0 left-0 right-0" style="z-index: 9999;">
        <div class="card ">
        <Toolbar>
            <template #start>
                <Avatar image="https://www.gravatar.com/avatar/05dfd4b41340d09cae045235eb0893c3?d=mp" class="flex items-center justify-center mr-2" size="large" />
            </template>
            <template #end>
                <div class="mr-3">
                    <Translation/>
                </div>
                <Avatar label="P" class="mr-2" size="large" shape="circle" />
            </template>
        </Toolbar>
    </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Translation from '@/layouts/Translation.vue'

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