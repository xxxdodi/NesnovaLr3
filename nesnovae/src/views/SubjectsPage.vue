<template>
  <Layout title="Предметы">
    <SubjectList />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout';
import SubjectList from '@/components/SubjectList/SubjectList.vue';

export default {
  name: 'SubjectsPage',
  components: {
    Layout,
    SubjectList,
  }
}
</script>
