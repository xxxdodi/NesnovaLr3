<template>
  <Layout title="Преподаватели">
    <TeacherList />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout';
import TeacherList from '@/components/TeacherList/TeacherList.vue';

export default {
  name: 'TeachersPage',
  components: {
    Layout,
    TeacherList,
  }
}
</script>
