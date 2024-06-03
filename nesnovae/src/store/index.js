import { createStore } from 'vuex'
import subjects from './subjects';
import subjectsfiltred from './subjectsfiltred';
import teachers from './teachers';
export default createStore({
  modules: {
    subjects,
    subjectsfiltred,
    teachers,
  },
  state: {},
  mutations: {},
  actions: {},
})
