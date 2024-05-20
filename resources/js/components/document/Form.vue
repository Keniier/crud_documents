<template>
    <div>
        <form class="row" @submit.prevent="submitForm()" enctype="multipart/form-data" @change="generateDocumentCode()">
            <div class="my-2 col-12">
                <label class="form-label" for="input-name">Nombre</label>
                <input id="input-name" type="text" class="form-control" v-model="document_data.doc_nombre" required>
            </div>
            <div class="my-2 col-12">
                <label class="form-label" for="select-pro">Proceso</label>
                <select id="select-pro" class="form-select" v-model="document_data.document_process" required>
                    <option value="" selected disabled>--Selecciona--</option>
                    <option v-for="(process, index) in options_processes" :key="index" :value="process">{{ process.pro_nombre }}</option>
                </select>
            </div>
            <div class="my-2 col-12">
                <label class="form-label" for="select-tip">Tipo</label>
                <select id="select-tip" class="form-select" v-model="document_data.document_type" required>
                    <option value="" selected disabled>--Selecciona--</option>
                    <option v-for="(type, index) in options_types" :key="index" :value="type">{{ type.tip_nombre }}</option>
                </select>
            </div>
            <div class="my-2 col-12">
                <label class="form-label" for="input-codigo">Codigo</label>
                <input v-model="document_data.doc_codigo" type="text" id="input-codigo" class="form-control" readonly required>
            </div>
            <div class="my-2 col-12" v-if="document_data.doc_contenido && type_form === 'edit'">
                <label class="form-label">Documento Subido</label>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                        {{document_data.doc_contenido}}
                    </a>
                </div>
            </div>
            <div class="my-2 col-12">
                <label class="form-label" for="input-file">{{ document_data.doc_contenido ? 'Reemplazar' : 'Añadir'}} Contenido:</label>
                <input type="file" id="input-file" class="form-control" @change="setFile" :readonly="type_form === 'insert'">
            </div>
            <div class="my-2 d-flex justify-content-end">
                <button type="button" id="btn_close" class="btn btn-outline-secondary mx-1" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">{{ 'Agregar' }}</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['document_list', 'data_form'],
    data() {
        return {
            type_form: 'insert',
            options_types: [],
            options_processes: [],
            document_data: {
                doc_nombre: "",
                doc_codigo: "",
                doc_contenido: "",
                document_type: {},
                document_process: {},
            }
        }
    },
    watch: {
        data_form(newVal, oldVal) {
            this.resetValues()
            if (newVal !== null) {
                this.editEvent(newVal)
            }
        }
    },
    created() {
        this.getSelectOptions()
    },
    methods: {
        getSelectOptions() {
            Promise.all([axios.get(`/document/types/get`), axios.get(`/document/processes/get`)])
                .then(responses => {
                    const [typesResponse, processesResponse] = responses;
                    this.options_types = typesResponse.data.types;
                    this.options_processes = processesResponse.data.processes;
                })
                .catch(error => {
                    console.error(error.response);
                });
        },
        setFile(event) {
            this.document_data.doc_contenido = event.target.files[0];
        },
        submitForm() {
            const formData = new FormData();

            formData.append('doc_nombre', this.document_data.doc_nombre);
            formData.append('doc_codigo', this.document_data.doc_codigo);
            formData.append('doc_contenido', this.document_data.doc_contenido);
            formData.append('doc_id_tipo', this.document_data.document_type['tip_id']);
            formData.append('doc_id_proceso', this.document_data.document_process['pro_id']);

            const endpoint = this.type_form === 'insert' ? '/document/store' : `/document/update/${this.document_data.doc_id}`;

            axios.post(endpoint, formData)
                .then(res => {
                    if (res.data.status) {
                        this.$emit('refreshData')
                    }
                })
                .catch(error => {
                    console.log(error.response)
                }).finally(f => {
                    this.resetValues()
                    setTimeout(()=>{
                        document.getElementById("btn_close").click()
                    },200)
                })
        },
        generateDocumentCode() {
            const { document_process, document_type } = this.document_data;

            if ((document_process['pro_id'] && document_type['tip_id']) && (document_process['pro_id'] !== this.data_form?.doc_id_proceso || document_type['tip_id'] !== this.data_form?.doc_id_tipo)) {    

                const filter_record = this.document_list?.filter(obj =>
                    obj.doc_id_tipo === document_type['tip_id'] && obj.doc_id_proceso === document_process['pro_id']
                );

                const max_record = filter_record?.reduce((max, obj) => {
                    return this.getConsecutive(obj?.doc_codigo) > this.getConsecutive(max?.doc_codigo) ? obj : max;
                }, null);

                const last_consecutive = max_record ? this.getConsecutive(max_record.doc_codigo) : '1';

                const pro_prefijo = max_record ? max_record.document_process.pro_prefijo : document_process['pro_prefijo'];
                const tip_prefijo = max_record ? max_record.document_type.tip_prefijo : document_type['tip_prefijo'];


                this.document_data.doc_codigo = `${pro_prefijo}-${tip_prefijo}-${last_consecutive}`;
            }else{
                this.document_data.doc_codigo = this.data_form?.doc_codigo;
            }
        },
        getConsecutive(cod){
            const last_consecutive = cod?.match(/\d+$/);
            const next_consecutive = last_consecutive ? parseInt(last_consecutive) + 1 : null
            return next_consecutive;
        },
        editEvent(data_form){
            this.type_form = 'edit';
            this.document_data = {...data_form};
        },
        resetValues(){
            this.type_form = 'insert';
            this.document_data.doc_nombre = "";
            this.document_data.doc_codigo = "";
            this.document_data.doc_contenido = "";
            this.document_data.document_type = {};
            this.document_data.document_process = {};
            document.getElementById('input-file').value = '';
        }

    }
}
</script>

<style scoped></style>