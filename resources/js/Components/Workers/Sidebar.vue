<script setup>

    import { useCompanyWorkersStore } from '@/Store/companyWorkers';
    import { storeToRefs } from 'pinia';
    import SidebarHeader from '@/Components/Workers/SidebarHeader.vue'
    import ActionArea from '@/Components/Workers/ActionArea.vue'
    import Tabs from './Tabs.vue';

    const store = useCompanyWorkersStore()

    const { selectedWorker, printNavigation } = storeToRefs(store)

</script>

<template>

<div 
    :class="{ 'translate-x-full' : !printNavigation}" 
    class="fixed top-0 right-0 z-40 h-screen overflow-y-auto transition-transform bg-white w-80 shadow-2xl"
    tabindex="-1" >

    <SidebarHeader class="mb-5"></SidebarHeader>
  
    <div class="p-4 overflow-y-auto">
        <div class="p-2">Age: {{selectedWorker.age}}</div>
        <div class="p-2">Position: {{selectedWorker.position}}</div>
        <div class="p-2">Office: {{selectedWorker.office}}</div>
    </div>

    <ActionArea :itemid="selectedWorker.id"></ActionArea>

    <Tabs></Tabs>
</div>

</template>