<template>
  <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
    <SubjectForm @submit="onSubmit" :id="id"  />
  </Layout>
</template>

<script>
import { useStore } from 'vuex';

import { updateItem, addItem } from '@/store/subjects/selectors';
import SubjectForm from '@/components/SubjectForm/SubjectForm.vue';
import Layout from '@/components/Layout/Layout';

export default {
  name: 'SubjectEdit',
  props: {
    id: String,
  },
  components: {
    Layout,
    SubjectForm,
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

