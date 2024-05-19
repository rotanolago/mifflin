<script setup>
    import { useCompanyWorkersStore } from '@/Store/companyWorkers';
    import { storeToRefs } from 'pinia';
    import PrimaryButton from '@/Components/UI/PrimaryButton.vue';
    import axios from 'axios'

    const store = useCompanyWorkersStore()
    const { characters, selectedWorker } = storeToRefs(store)

    store.fetchWorkers

    function logout(){
        axios.post('/logout')
            .then(e => window.location.reload())
    }
</script>

<template>
    <div class="flex justify-between py-3 mx-5 border-b-2 border-b-black-700">
        <span class="text-2xl">{{characters.length}} Trusted Contacts</span>
        <button @click="logout">Log Out</button>
    </div>
    <div class="grid grid-cols-12 gap-4 py-3 mx-4 border-b-2">
        <div class="row-span-1"></div>
        <div class="col-span-1 font-bold ml-3 flex items-center">Name</div>
        <div class="col-span-1 flex items-center">Age</div>
        <div class="col-span-3 flex items-center">Position</div>
        <div class="col-span-3 flex items-center">Company</div>
        <div class="col-span-3"></div>
    </div>
    <div v-for="character, index in characters" 
        :class="{'bg-gray-200': character.id == selectedWorker.id}"
        class="grid grid-cols-12 gap-4 hover:bg-gray-100 transition py-3 mx-4">
        <div class="col-span-1">
            <img class="ml-5 w-20 h-20 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500" :src="character.picture" :alt="character.name+' avatar'">
        </div>
        <div class="row-span-1 font-bold ml-3 flex items-center">{{character.name}}</div>
        <div class="col-span-1 flex items-center">{{character.age}}</div>
        <div class="col-span-3 flex items-center">{{character.position}}</div>
        <div class="col-span-3 flex items-center">{{character.office}}</div>
        <div class="col-span-3 flex items-center justify-end">
            <PrimaryButton @click="store.selectWorker(index)" title="View"></PrimaryButton>
        </div>
    </div>
</template>
