import axios from 'axios'
import { defineStore } from 'pinia'
import {ref} from 'vue';

export const useCompanyWorkersStore = defineStore('companyWorkers',{
  state: () => ({

    selectedWorker: ref({}),
    printNavigation: ref(false),
    characters : ref([]),
    notes : ref([])
  }),

  getters: {
    getCompanyWorkers: (state) => {
      return state.characters
    },
    getSelectedWorker: (state) => {
      return state.selectedWorker
    },
    fetchWorkers: (state) => {
      axios.get('/workers')
        .then((response) => {
          if(response.data.success){
            console.log(response);
            state.characters = response.data.data
          }
        })
    }
  },

  actions: {
    selectWorker(index) {
      this.selectedWorker = this.characters[index];
      this.printNavigation = true;
    },
    showNavigation(){
      this.printNavigation = true;
    },
    hideNavigation(){
      this.printNavigation = false;
      this.selectedWorker = {}
    },
    async addNote(note){
      let workerid = this.selectedWorker.id;
      
      try{
        const response = await axios.post('/workers/'+workerid+'/notes', {
          'content': note
        })

        const updateCurrentWorker = response.data.data.find(item => {
          return item.id == this.selectedWorker.id
        })

        this.$patch({characters: response.data.data, selectedWorker: updateCurrentWorker })
      } catch (error) {
        console.log(error)
      }
    },
    async editNote(id, content){
      try{
        const response = await axios.put('/notes/'+id, {
          'content': content
        })

        const updateCurrentWorker = response.data.data.find(item => {
          return item.id == this.selectedWorker.id
        })

        this.$patch({characters: response.data.data, selectedWorker: updateCurrentWorker })
      } catch (error) {
        console.log(error)
      }

    },
    async destroyNote(id){
      try{
        const response = await axios.delete('/notes/'+id)

        const updateCurrentWorker = response.data.data.find(item => {
          return item.id == this.selectedWorker.id
        })

        this.$patch({characters: response.data.data, selectedWorker: updateCurrentWorker })
      } catch (error) {
        console.log(error)
      }

    },
    fetchNotes: (userId) => axios.get('/notes/'+userId)
        .then((response) => {
          if(response.data.success){
            this.$patch({notes: response.data.data})
          }
        })
  }
})