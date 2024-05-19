<script setup>
    import { ref } from 'vue'
    import { useCompanyWorkersStore } from '@/Store/companyWorkers'
    import { storeToRefs } from 'pinia'
    import PrimaryButton from '@/Components/UI/PrimaryButton.vue';

    const store = useCompanyWorkersStore()
    let { selectedWorker } = storeToRefs(store)
    let currentNote = ref('')

    function addNote(){
        store.addNote(currentNote.value)
        currentNote.value = ''
    }

</script>

<template>
    <div v-for="note in selectedWorker.notes">
        <div class="m-1 p-2 bg-emerald-200 rounded-r-lg rounded-b-lg">
            <div class="font-bold mb-2">{{ JSON.parse(note.content).author }} says:</div>
            <div>{{  JSON.parse(note.content).content }}</div>
        </div>
    </div>
    <div class="grid grid-cols-5 gap-4 p-2">
        <input class="col-span-5" v-model="currentNote">
        <PrimaryButton class="col-span-3 col-start-2" @click="addNote()" title="Add"></PrimaryButton>
    </div>
</template>