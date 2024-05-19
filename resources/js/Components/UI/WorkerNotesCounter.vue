<script setup>

    const props = defineProps(['worker'])

    function showPill(){
        if(props.worker.notes != undefined){
            return props.worker.notes.length > 0
        } else {
            return false;
        }
    }

</script>

<template>
    
    <div
        v-if="showPill()"
        class="flex justify-center items-center ml-3 bg-gray-400 w-6 h-6 text-white text-sm rounded-full">
        {{ worker.notes.length }}
    </div>

</template>