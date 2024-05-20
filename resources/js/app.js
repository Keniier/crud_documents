import './bootstrap';
import { createApp } from 'vue';
import DocumentIndex from './components/document/Index.vue';

const app = createApp({});

app.component('document-index', DocumentIndex);

app.mount('#app');
