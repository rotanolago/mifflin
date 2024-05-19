<script setup>
    import { ref } from 'vue';
    import { storeToRefs } from 'pinia';
    import { useCompanyWorkersStore } from '@/Store/companyWorkers';
    import ProfileTab from '@/Components/Workers/Tabs/Profile.vue'
    import ActivityTab from '@/Components/Workers/Tabs/Activity.vue'
    import NotesTab from '@/Components/Workers/Tabs/Notes.vue'
    import WorkersNotesCounter from '@/Components/UI/WorkerNotesCounter.vue'

    const store = useCompanyWorkersStore()

    const { selectedWorker } = storeToRefs(store)

    const tabs = [
        {
            header: "Profile",
            slug: "profile",
            counter: false
        },
        {
            header: "Activity",
            slug: "activity",
            counter: false
        },
        {
            header: "Notes",
            slug: "notes",
            counter: true
        },
    ]


    let selectedTab = ref('notes')

</script>

<template>
    <div class="flex justify-center flex-nowrap">
        <div v-for="tab in tabs" @click="selectedTab = tab.slug" 
            class="hover:cursor-pointer py-2 hover:bg-black-700  flex items-center justify-center flex-grow text-center transition-all border-b-2"
            :class="{'font-bold': selectedTab == tab.slug, 'border-black-200': selectedTab == tab.slug, 'border-black': selectedTab == tab.slug }">
            {{ tab.header }}
            <WorkersNotesCounter v-if="tab.counter" :worker="selectedWorker"></WorkersNotesCounter>
        </div>
    </div>

    <ProfileTab v-if="selectedTab == 'profile'"></ProfileTab>
    <ActivityTab v-if="selectedTab == 'activity'"></ActivityTab>
    <NotesTab v-if="selectedTab == 'notes'"></NotesTab>
</template>