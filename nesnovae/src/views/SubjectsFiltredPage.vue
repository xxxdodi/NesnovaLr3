<template>
  <Layout title="Предметы (фильтр)">
    <SubjectFiltredList />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout';
import SubjectFiltredList from '@/components/SubjectFiltredList/SubjectFiltredList.vue';

export default {
  name: 'SubjectsFiltredPage',
  components: {
    Layout,
    SubjectFiltredList,
  }
}
</script>
