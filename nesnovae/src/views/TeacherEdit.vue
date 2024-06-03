<template>
  <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
    <TeacherForm
        :id="id"
        @submit="onSubmit"
    />
  </Layout>
</template>

<script>
import { useStore } from 'vuex';

import { updateItem, addItem } from '@/store/teachers/selectors';
import Layout from '@/components/Layout/Layout';
import TeacherForm from '@/components/TeacherForm/TeacherForm.vue';
export default {
  name: 'TeacherEdit',
  props: {
    id: String,
  },
  components: {
    Layout,
    TeacherForm,
  },
  setup() {
    const store = useStore();
    return {
      onSubmit: ({ id, teacher, department }) => id ?
          updateItem(store, { id, teacher, department }) :
          addItem(store, { teacher, department }),
    };
  }
}
</script>

