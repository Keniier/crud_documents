<template>
    <div>
        <div class="modal fade" id="modalDocument" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFullTitle"> {{ type_form === 'insert' ? 'Añadir' : 'Editar' }} Documento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-0">
                        <div class="card-body">
                            <document-form @refreshData="refreshData" :data_form="data_form" :document_list="document_list"></document-form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DocumentForm from './Form.vue';
export default {
    props: ['document_list', 'event_edit_id'],
    components: {
        DocumentForm
    },

    data() {
        return {
            data_form: {},
            type_form: 'insert'
        }
    },

    watch: {
        event_edit_id(newVal, oldVal) {
            console.log('cambio');
            if (newVal === null) {
                this.type_form = 'insert';
                this.data_form = null;
            }else{
                this.type_form = 'edit';
                this.getDocumentById(newVal)
            }
        }
    },

    methods: {
        getDocumentById(id){
            axios.get(`document/get/${id}`)
                .then(res => {
                    console.log(res.data);
                    this.data_form = res.data.document
                }).catch(error => {
                    console.log(error.response);
                })
        },
        refreshData(){
            this.$emit('refreshData');
        }
    }
}
</script>

<style scoped></style>