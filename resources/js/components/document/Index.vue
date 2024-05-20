<template>
    <div>
        <div class="d-flex justify-content-end">
            <div class="col-3 mx-3">
                <input v-model="search_record" class="form-control col" type="text" placeholder="Buscar Registro (Codigo, Nombre)">
            </div>
            <button class="btn prop_color border-0 d-flex justify-content-end" data-bs-toggle="modal" data-bs-target="#modalDocument" @click="eventEdit(null)"> Añadir Documento</button>
        </div>
        <document-table @event-edit="eventEdit" @event-delete="eventDelete" :document_list="filteresRecords" v-if="table"</document-table>
        <document-modal @refreshData="refreshData" :event_edit_id="event_edit_id" :document_list="document_list"></document-modal>
    </div>
</template>

<script>
import DocumentTable from './Table.vue';
import DocumentModal from './Modal.vue'
export default {
    components: {
        DocumentTable,
        DocumentModal
    },
    data() {
        return {
            search_record: null,
            table: false,
            event_edit_id: '',
            document_list: [],
        }
    },
    computed: {
        filteresRecords(){
            if (this.search_record) {          
                return this.document_list.filter(record => {
                    let search = this.search_record.toLowerCase();
                    return record.doc_nombre.toLowerCase().includes(search) || record.doc_codigo.toLowerCase().includes(search);
                })
            }else{
                return this.document_list;
            }
        }
    },
    created() {
        this.getDocumentList();
    },
    methods: {
        getDocumentList(){
            this.table = false;
            axios.get(`/document/get`)
                .then(res => {
                    this.document_list = res.data.documents;
                })
                .catch(error => {
                    console.log(error);
                }).finally(f => {
                    this.table = true;
                });
        },
        eventEdit(id){
            this.event_edit_id = id;
        },
        eventDelete(id){
            axios.delete(`/document/delete/${id}`)
                .then(res => {
                    console.log(res);
                }).catch(error => {
                    console.log(error.response);
                }).finally(f => {
                    this.refreshData()
                })
        },
        refreshData(){
            this.event_edit_id = null
            this.getDocumentList()
        }
    }
}
</script>

<style scoped>
    
</style>