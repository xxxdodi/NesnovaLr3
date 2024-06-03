<template>
  <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
    <SubjectFiltredForm @submit="onSubmit" :id="id"  />
  </Layout>
</template>

<script>
import { useStore } from 'vuex';

import { updateItem, addItem } from '@/store/subjectsfiltred/selectors';
import SubjectFiltredForm from '@/components/SubjectFiltredForm/SubjectFiltredForm.vue';
import Layout from '@/components/Layout/Layout';

export default {
  name: 'SubjectFiltredEdit',
  props: {
    id: String,
  },
  components: {
    Layout,
    SubjectFiltredForm,
  },
  setup() {
    const store = useStore();
    return {
      onSubmit: ({ id, subject, description, hours, teacher }) => id ?
          updateItem(store, { id, subject, description, hours, teacher }) :
          addItem(store, { subject, description, hours, teacher } )
    }
  }

}
</script>

