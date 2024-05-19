<script setup>
    defineProps(['title'])
</script>
<template>
    <button 
    class="mr-3 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
    {{ title }}
    </button>
</template>