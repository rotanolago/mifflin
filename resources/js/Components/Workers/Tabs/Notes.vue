<script setup>
    import { ref } from 'vue'
    import { useCompanyWorkersStore } from '@/Store/companyWorkers'
    import { storeToRefs } from 'pinia'
    import PrimaryButton from '@/Components/UI/PrimaryButton.vue';

    const store = useCompanyWorkersStore()
    let { selectedWorker } = storeToRefs(store)
    let currentNote = ref('')
    let currentEdit = ref('')
    let editNote = ref('')

    function addNote(){
        store.addNote(currentNote.value)
        currentNote.value = ''
    }

    function editNoteMode(note){
        currentEdit.value = JSON.parse(note.content).content
        editNote.value = note.id
    }

    function cancelEditMode(){
        currentEdit.value = ''
        editNote.value = ''
    }

    function storeEditedNote(){
        store.editNote(editNote.value, currentEdit.value)
        currentEdit.value = ''
        editNote.value = ''
    }

    function destroyNote(id){
        if(confirm('Are you sure?')){
            store.destroyNote(id)
        }
    }

</script>

<template>
    <div v-for="note in selectedWorker.notes"  class="grid grid-cols-12 gap-4 m-1 p-2 bg-emerald-200 rounded-r-lg rounded-b-lg">
        <div class="col-span-10">
            <div class="font-bold mb-2">{{ JSON.parse(note.content).author }} says:</div>
            <div v-if="note.id !== editNote">{{  JSON.parse(note.content).content }}</div>
            <div v-else="note.id !== editNote">
                <textarea v-model="currentEdit" class="bg-emerald-400 border-0 p-1 focus:border-emerald-100 focus:ring-0 rounded"></textarea>
            </div>
        </div>
        <div class="col-span-2 flex flex-col justify-center items-center">

            <button @click="editNoteMode(note)" v-if="note.id !== editNote" class="rounded p-2 text-emerald-900 hover:text-emerald-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                </svg>
            </button>          

            <button @click="cancelEditMode()" v-if="note.id === editNote" class="rounded p-2 text-emerald-900 hover:text-emerald-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </button>

            <button @click="storeEditedNote()" v-if="note.id === editNote" class="rounded p-2 text-emerald-900 hover:text-emerald-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                </svg>
            </button>

            <button @click="destroyNote(note.id)" v-else="note.id === editNote" class="rounded p-2 text-emerald-900 hover:text-red-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    <div class="grid grid-cols-5 gap-4 p-2">
        <textarea class="col-span-5 border-0 bg-emerald-100 focus:border-emerald-100 focus:ring-0 rounded" autofocus v-model="currentNote"></textarea>
        <PrimaryButton class="col-span-3 col-start-2" @click="addNote()" title="Add"></PrimaryButton>
    </div>
</template>