<template>
    <div class="mt-2 table-responsive">
        <table class="table table-striped text-nowrap">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Proceso</th>
                    <th>Tipo</th>
                    <th>Codigo</th>
                    <th>Documento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in document_list">
                    <td>{{ item.doc_id }}</td>
                    <td>{{ item.doc_nombre }}</td>
                    <td>{{ `${item.document_process.pro_nombre} ( ${item.document_process.pro_prefijo} )` }}</td>
                    <td>{{ `${item.document_type.tip_nombre} ( ${item.document_type.tip_prefijo} )` }}</td>
                    <td>{{ item.doc_codigo }}</td>
                    <td>{{ item.doc_contenido }}</td>
                    <td class="d-flex text-center">
                        <button class="btn btn-primary btn-circle btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#modalDocument" @click="editDocument(item.doc_id)"> Editar </button>
                        <button class="btn btn-danger btn-circle btn-sm"  @click="deleteDocument(item.doc_id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['document_list'],
    data() {
        return {
            data_modal: {},
        }
    },
    methods:{
        editDocument(id){
            this.$emit('event-edit', id)
        },
        deleteDocument(id){
            this.$emit('event-delete', id)
        }
    }
}
</script>

<style scoped>
</style>